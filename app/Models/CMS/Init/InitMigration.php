<?php

namespace App\Models\CMS\Init;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

class InitMigration extends InitBase
{
    use HasFactory;
    public static function init($data, $isChild = false)
    {
        $table = parent::table($data->title, $isChild);
        $cms_table = $table;
        $migrationPath = '/database/migrations/CMS/Item/';
        
        if (!checkFileExists($migrationPath, "create_{$cms_table}_table.php")) {
            // Tạo migration mới
            $migrationName = "create_{$cms_table}_table";
            Artisan::call("make:migration", ['name' => $migrationName]);
    
            // Lấy danh sách các file migration
            $files = File::files(database_path('migrations'));
            $lastFile = end($files);
    
            // Di chuyển file migration đến đường dẫn mới
            File::ensureDirectoryExists(base_path($migrationPath));
            File::move($lastFile->getPathname(), base_path($migrationPath . $lastFile->getFilename()));
    
            // Lấy nội dung mẫu và thay thế
            $content = getContentFileAndReplaceArray(pathMigrationItemSample($data->categoryType->type), ['SampleTable' => $cms_table]);
    
            // Ghi nội dung mới vào file migration
            emptyAndWriteFile(base_path($migrationPath . $lastFile->getFilename()), $content);

            // Chạy migration từ đường dẫn mới
            Artisan::call('migrate', [
                '--path' => $migrationPath . $lastFile->getFilename()
            ]);
    
            return $cms_table;
        }
        return false;
    }
}
