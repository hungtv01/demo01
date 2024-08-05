<?php

namespace App\Http\Controllers\CMS\API;

use App\Http\Controllers\Controller;
use App\Models\CMS\CategoryType;
use Illuminate\Http\Request;

class CategoryTypeController extends Controller
{

    protected $mySelf;

    public function __construct(CategoryType $mySelf)
    {
        $this->mySelf = $mySelf;
    }

    public function index(Request $request){
        try {
            $data = $this->mySelf::with('categories')->get();
            return response()->json([
                'success' => true,
                'data' => $data,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'data' => null,
                'message' => $th->getMessage()
            ], 500);
        }
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
