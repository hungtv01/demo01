<?php

namespace App\Http\Controllers\CMS\API;

use App\Http\Controllers\Controller;
use App\Models\CMS\Init\InitView;
use App\Models\CMS\Module;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    protected $mySelf;
    public function __construct(Module $mySelf)
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
        $data = $request->all();
        try {
            $data = $request->all();
            if(isset($data['title_admin']) and $this->mySelf::where('title_admin', $data['title_admin'])->first()){
                return response()->json([
                    'success' => false, 
                    'message' => "Đã tồn tại module."
                ]);
            }
            $data = $this->mySelf->storeModule($data);
            return response()->json([
                'success' => true, 
                'data' => $data, 
                'message' => "Đã tạo module."
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
                    'message' => 'Không tìm thấy module.',
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
            $module = $this->mySelf::findOrFail($id);
    
            if (!$module) {
                return response()->json([
                    'success' => false,
                    'message' => 'Không tìm thấy module.',
                ], 404);
            }
            $module = $this->mySelf->updateModule($module, $data);
    
            return response()->json([
                'success' => true,
                'data' => $module,
                'message' => 'Đã cập nhật module.',
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
                    'message' => 'Đã xoá module.'
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Không tìm thấy module.',
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
