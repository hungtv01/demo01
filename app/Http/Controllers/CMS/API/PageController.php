<?php

namespace App\Http\Controllers\CMS\API;

use App\Http\Controllers\Controller;
use App\Models\CMS\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    protected $mySelf;
    public function __construct(Page $mySelf)
    {
        $this->mySelf = $mySelf;
    }
    /**
     * Display a listing of the resource.
     */
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $params = $request->all();
            $data = $this->mySelf->getAll($params);
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
        try {
            $data = $request->all();
            if(isset($data['title']) and $this->mySelf::where('title', $data['title'])->first()){
                return response()->json([
                    'success' => false, 
                    'message' => "Đã tồn tại trang."
                ]);
            }
            $data = $this->mySelf::create($data);
            return response()->json([
                'success' => true, 
                'data' => $data, 
                'message' => "Đã tạo trang."
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
            $data = $this->mySelf::findOrFail($id);
            if (!$data) {
                return response()->json([
                    'success' => false,
                    'message' => 'Không tìm thấy trang.',
                ], 404);
            }
            return response()->json([
                'success' => true,
                'data' => $data,
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
            // Tìm category theo id
            $design = $this->mySelf::findOrFail($id);
    
            if (!$design) {
                return response()->json([
                    'success' => false,
                    'message' => 'Không tìm thấy trang',
                ], 404);
            }
            $design->fill($data);
            $design->save();
    
            return response()->json([
                'success' => true,
                'data' => $design,
                'message' => 'Đã cập nhật trang.',
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
                    'message' => 'Đã xoá trang.'
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Không tìm thấy trang.',
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
