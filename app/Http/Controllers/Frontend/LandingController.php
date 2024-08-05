<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CMS\Module;
use App\Models\CMS\Page;
use Illuminate\Http\Request;

class LandingController extends Controller
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
        return view('frontend.templates.landing', compact('modules', 'page'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
