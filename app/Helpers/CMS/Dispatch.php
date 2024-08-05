<?php

use App\Http\Controllers\Frontend\FormController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\LandingController;
use App\Http\Controllers\Frontend\NewsController;
use App\Models\CMS\Category;
use App\Models\CMS\Page;

function dispatchPage($page) {
    $templateTitle = $page->template->title;
    switch ($templateTitle) {
        case 'home':
            $controller = new HomeController($page);
            return app()->call([$controller, 'index']);
        case 'landing':
            $controller = new LandingController($page);
            return app()->call([$controller, 'index']);
        case 'news/index':
            $controller = new NewsController($page);
            return app()->call([$controller, 'index']);
        case 'form':
            $controller = new FormController($page);
            return app()->call([$controller, 'index']);
        default:
            abort(404); 
    }
}

function dispatchPageContact($page) {
    $controller = new FormController($page);
    return app()->call([$controller, 'store']);
}

function dispatchItemPage($itemSlug, $categoryId, Page $page)
{
    // Tìm danh mục cha theo ID
    $category = Category::where('id', $categoryId)->firstOrFail();
    
    // Tìm mục con theo slug
    $item = "App\Models{$category->item_class}"::where('slug', $itemSlug)->firstOrFail();

    // Trả về view hoặc xử lý logic tiếp theo
    $controller = new NewsController($page);
    return app()->call([$controller, 'detail'], ['item' => $item]);
}