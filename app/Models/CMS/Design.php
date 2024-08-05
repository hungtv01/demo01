<?php

namespace App\Models\CMS;

use App\Models\CMS\Init\InitView;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Design extends Model
{
    use HasFactory;
    protected $table = 'cms_designs';
    protected $guarded = [];
    protected $casts = [
        'data' => 'array', // Định nghĩa cột data là dạng mảng (array)
    ];
    
    public function getAll($cond){
        $query = Design::query();
        // Nếu có điều kiện title được truyền vào từ bên ngoài
        if (isset($cond['title'])) {
            $query->where('title', 'like', '%' . $cond['title'] . '%');
        }
    
        // Phân trang kết quả với số lượng bản ghi mỗi trang là 5
        return $query->paginate(5);
    }


    public function storeDesign($data){
        $data = Design::create($data);
        if($data){
            InitView::initViewSampleParentDesign($data);
        }
        return $data;
    }

    public function updateDesign($oldData, $newData){
        $tmp = $oldData->replicate();
        $tmp->id = $oldData->id;
        $oldData->fill($newData);
        $oldData->save();
        if($oldData and $newData['type'] == 'module'){
            InitView::updateViewSampleFilename($tmp->toArray(), $newData);
        }
        return $oldData;
    }
}
