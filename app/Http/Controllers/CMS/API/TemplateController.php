<?php

namespace App\Http\Controllers\CMS\API;

use App\Http\Controllers\Controller;
use App\Models\CMS\Template;
use Illuminate\Http\Request;

class TemplateController extends Controller
{
    public function index(){
        try {
            $data = Template::get();
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
}
