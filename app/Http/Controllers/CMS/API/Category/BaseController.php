<?php

namespace App\Http\Controllers\CMS\API\Category;

use App\Http\Controllers\Controller;
use App\Models\CMS\Category;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    protected $mySelf;

    public function __construct(Category $mySelf)
    {
        $this->mySelf = $mySelf;
    }

    public function index(Request $request){
        try {
            $param = $request->all();
            $data = $this->mySelf->getAll([], $param);
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
    public function store(Request $request, $typeCategoryID, $typeCategory)
    {
        try {
            $data = $request->all();
            if($this->mySelf->isExist($data['title']) and $this->mySelf->isMany($typeCategory)){
                return response()->json([
                    'success' => false, 
                    'message' => "Đã tồn tại danh mục"
                ]);
            }
            $data['category_type_id'] = $typeCategoryID;
            $data = $this->mySelf->storeCategory($data);
            return response()->json([
                'success' => true, 
                'data' => $data, 
                'message' => "Đã tạo danh mục"
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false, 
                'message' => $th->getMessage(), 
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            // Tìm category theo id
            $category = $this->mySelf::findOrFail($id);
    
            if (!$category) {
                return response()->json([
                    'success' => false,
                    'message' => 'Không tìm thấy danh mục',
                ], 404);
            }
    
            return response()->json([
                'success' => true,
                'data' => $category,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $data = $request->all();
            $category = Category::findOrFail($id);
    
            if (!$category) {
                return response()->json([
                    'success' => false,
                    'message' => 'Không tìm thấy danh mục',
                ], 404);
            }

            // Cập nhật thông tin category
            $category->fill($data);
            $category->save();
    
            return response()->json([
                'success' => true,
                'data' => $category,
                'message' => 'Cập nhật danh mục thành công',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $data = $this->mySelf::findOrFail($id);
            $deleted = $data->delete();
            if ($deleted) {
                return response()->json([
                    'success' => true,
                    'message' => 'Đã xoá danh mục'
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Danh mục không tìm thấy hoặc không thể xoá'
                ], 404);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
