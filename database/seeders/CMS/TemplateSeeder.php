<?php

namespace Database\Seeders\CMS;

use App\Models\CMS\Template;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id' => 1,
                'title' => 'default',
                'desc' => 'Trang mặc định',
            ],
            [
                'id' => 2,
                'title' => 'empty',
                'desc' => 'Trang rỗng',
            ],
            [
                'id' => 3,
                'title' => 'home',
                'desc' => 'Trang chủ',
            ],
            [
                'id' => 4,
                'title' => 'landing',
                'desc' => 'Trang landing',
            ],
            [
                'id' => 5,
                'title' => 'form',
                'desc' => 'Trang liên hệ',
            ],
            [
                'id' => 6,
                'title' => 'news/index',
                'desc' => 'Trang danh sách một thực thể như : Bài viết , Sản phẩm , ...',
            ],
            [
                'id' => 7,
                'title' => 'news/detail',
                'desc' => 'Trang chi tiết một thực thể như : Bài viết , Sản phẩm , ...',
            ],
            [
                'id' => 8,
                'title' => 'search',
                'desc' => 'Trang kết quả tìm kiếm',
            ],

        ];
        collect($data)->each(function ($template) { Template::create($template); });
    }
}
