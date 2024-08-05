<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CMS\Module;
use App\Models\CMS\Page;

class HomeController extends Controller
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
        return view('frontend.templates.home', compact('page', 'modules'));
    }
}
