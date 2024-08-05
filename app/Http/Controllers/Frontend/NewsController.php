<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CMS\Category;
use App\Models\CMS\Module;
use App\Models\CMS\Page;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    protected $page;
    public function __construct(Page $page)
    {
        $this->page = $page;
    }
    public function index()
    {
        $page = $this->page;
        $modules = Module::whereIn('id', $page->modules)->get();
        $category = Category::find($page->handle_id);
        $data = $category->items();
        return view('frontend.templates.news.index', compact('page', 'modules', 'category', 'data'));
    }
    public function detail($item){
        $category = $item->category();
        return view('frontend.templates.news.detail', compact('item', 'category'));

    }
}
