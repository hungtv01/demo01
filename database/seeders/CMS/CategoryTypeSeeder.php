<?php

namespace Database\Seeders\CMS;

use App\Models\CMS\CategoryType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id' => 1,
                'title' => 'Collections',
                'desc' => 'Bao gồm Trang , Landing , Bài viết , Sản phẩm, ...',
                'type' => 'collection',
                'is_many' => true,
                'is_list' => true,
            ],
            [
                'id' => 2,
                'title' => 'Assets',
                'desc' => 'Bao gồm các nội dung: Hình ảnh, Tài liệu, ...',
                'type' => 'asset',
            ],
            [
                'id' => 3,
                'title' => 'Forms',
                'desc' => 'Bao gồm các thực thể tiếp nhận dữ liệu từ người dùng cuối : Form Contact, Form Register Member, ...',
                'type' => 'form',
                'is_many' => true,
                'is_list' => true,
            ],
            [
                'id' => 4,
                'title' => 'Navigations',
                'desc' => 'Bao gồm các thực thể chuyển hướng : Menu, Nav ...',
                'type' => 'navigation',
                'is_many' => true,
            ],
            [
                'id' => 5,
                'title' => 'Classifications',
                'desc' => 'Bao gồm các thực thể phân loại : Tags, ...',
                'type' => 'classification',
                'is_many' => true,
                'is_list' => true,
            ],
            [
                'id' => 6,
                'title' => 'Globals',
                'desc' => 'Bao gồm các thông tin liên quan và được sử dụng rộng rãi : Info Company, Info Representative, ...',
                'type' => 'global',
                'is_many' => true,
            ],
            // [
            //     'id' => 8,
            //     'title' => 'Others',
            //     'desc' => 'Các thực thể khác : List User, List Role ...',
            //     'type' => 'other',
            //     'is_many' => true,
            //     'is_list' => true,
            // ],
        ];
        collect($data)->each(function ($item) { CategoryType::create($item); });
    }
}
