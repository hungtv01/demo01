<?php

namespace App\Http\Controllers\CMS\API\Category;

use App\Http\Controllers\Controller;
use App\Models\CMS\Category;
use Illuminate\Http\Request;

class GlobalController extends Controller
{
    const FOGEIGN_KEY_CATEGORY_TYPES_TABLE = 'category_type_id';
    const TYPE_ID = 6;
    const TYPE= 'global';

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $params = $request->all();
            $data = Category::getAll([self::FOGEIGN_KEY_CATEGORY_TYPES_TABLE =>  self::TYPE_ID], $params);
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
    public function store(Request $request, $typeCategoryID = self::TYPE_ID, $typeCategory = self::TYPE)
    {
        return parent::store($request, $typeCategoryID, $typeCategory);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return parent::show($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return parent::update($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return parent::destroy($id);
    }
}
