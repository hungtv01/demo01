<?php

namespace App\Models\CMS;

use App\Models\CMS\Init\InitView;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Module extends Model
{
    use HasFactory;
    protected $table = 'cms_modules';
    protected $guarded = [];
    protected $casts = [
        'data' => 'array', // Định nghĩa cột data là dạng mảng (array)
    ];

    public function design(): BelongsTo
    {
        return $this->belongsTo(Design::class, 'design_id');
    }

    public static function getByID($id){
        return Module::find($id);
    }

    public function getAll($cond){
        $query = Module::query();
        // Nếu có điều kiện title được truyền vào từ bên ngoài
        if (isset($cond['title'])) {
            $query->where('title_admin', 'like', '%' . $cond['title'] . '%');
        }

        $query->with('design');
    
        // Phân trang kết quả với số lượng bản ghi mỗi trang là 5
        return $query->paginate(5);
    }


    public function storeModule($data){
        $data = Module::create($data);
        $data = Module::where('id', $data->id)->with('design')->first();
        if($data){
            InitView::initViewParentModule($data);
        }
        return $data;
    }

    public function updateModule($oldData, $newData){
        $tmp = $oldData->replicate();
        $oldData->fill($newData);
        $oldData->save();
        $newData = Module::where('id', $newData['id'])->with('design')->first();
        if($oldData){
            InitView::updateViewFilename($tmp->toArray(), $newData);
        }
        return $oldData;
    }
}
