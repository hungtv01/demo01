<?php

namespace App\Models\CMS\Init;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;

class InitView extends InitBase
{
    use HasFactory;

    public static function initViewSampleParentDesign($data){

        if (!empty($data)) {
            $module = parent::view($data['title']);
            $id = $data['id'];

            // Tạo file view mới
            Artisan::call("make:view frontend/modules/sample/{$module}_{$id}");

            // Đường dẫn tới file mẫu
            $newFile = resource_path("views/frontend/modules/sample/{$module}_{$id}.blade.php");

            // Kiểm tra xem file mẫu có tồn tại không
            if (File::exists($newFile)) {
                $newContent = <<<EOT
                @php
                    \$module = \App\Models\CMS\Module::getByID(__ID__);
                @endphp
                
                <section class="module-{{ \$module->id }}">
                    <h2 style="display: none">Add template section module below here</h2>
                </section>
                EOT;
                
                return File::put($newFile, $newContent);
            }
        }
        return false;
    }

    public static function updateViewSampleFilename($oldData, $newData)
    {
        $id = $oldData['id'];
        $newFileName = parent::view($newData['title']) . "_{$id}.blade.php";
        $oldFileName = parent::view($oldData['title']) . "_{$id}.blade.php";
        $newFilePath = resource_path("views/frontend/modules/sample/{$newFileName}");
        $oldFilePath = resource_path("views/frontend/modules/sample/{$oldFileName}");
        // Đổi tên file
        if (File::move($oldFilePath, $newFilePath)) {
            return $newFilePath;
        }
        return false;
    }

    public static function initViewParentModule($data){

        if (!empty($data)) {

            $module = parent::view($data->title_admin);
            $id = $data->id;
            // Tạo file view mới
            // Artisan::call("make:view frontend/modules/{$module}_{$id}");


            $design_title = parent::view($data->design->title);
            $design_id = $data->design->id;
            // Đường dẫn tới file mẫu
            $sampleFilePath = resource_path("views/frontend/modules/sample/{$design_title}_{$design_id}.blade.php");
            // Đường dẫn tới file view mới đã tạo
            $newFilePath = resource_path("views/frontend/modules/{$module}_{$id}.blade.php");

            // Kiểm tra xem file mẫu có tồn tại không
            if (File::exists($sampleFilePath)) {
                // Đọc nội dung từ file mẫu
                $content = File::get($sampleFilePath);
                // Thay thế chuỗi __ID__ bằng giá trị id

                $newContent = str_replace('__ID__', $id, $content);
                // Ghi nội dung đã thay thế vào file mới
                return File::put($newFilePath, $newContent);
            }

        }
        return false;
    }

    public static function updateViewFilename($oldData, $newData)
    {
        $id = $newData->id;
        $newFileName = parent::view($newData->title_admin) . "_{$id}.blade.php";
        $oldFileName = parent::view($oldData['title_admin']) . "_{$id}.blade.php";
        $newFilePath = resource_path("views/frontend/modules/{$newFileName}");
        $oldFilePath = resource_path("views/frontend/modules/{$oldFileName}");
        // Đổi tên file
        if (File::move($oldFilePath, $newFilePath)) {
            return $newFilePath;
        }
        return false;
    }
}


