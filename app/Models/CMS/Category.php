<?php

namespace App\Models\CMS;

use App\Models\CMS\Init\InitController;
use App\Models\CMS\Init\InitMail;
use App\Models\CMS\Init\InitMigration;
use App\Models\CMS\Init\InitModel;
use App\Models\CMS\Init\InitRoute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'cms_categories';
    protected $guarded = [];
    
    public function categoryType(): BelongsTo
    {
        return $this->belongsTo(CategoryType::class, 'category_type_id');
    }

    public function items()
    {
        $item_model = "App\Models{$this->item_class}";
        if(class_exists($item_model)){
            return "App\Models{$this->item_class}"::get();
        }
    }

    public function design(): BelongsTo
    {
        return $this->belongsTo(Design::class, 'design_id');
    }


    public static function storeCategory($data)
    {
        $data = Category::create($data);
        // Create Migrate Table && Model && Relationship Fake Child
        InitMigration::init($data, true);
        $item_class = InitModel::init($data, true);
        InitModel::initRelationship($data, $data->id, true);

        // Create Model && Relationship Fake Parent
        InitModel::init($data, false);
        InitModel::initRelationship($data, $data->category_type_id, false);


        // Create Mail If Category Type Form
        if($data->categoryType->type == 'form'){
            InitMail::initMail($data);
            InitMail::initMailView($data);
        }

        // Create Controller API
        InitController::init($data);

        // Create Route Fake API
        InitRoute::initLaravel($data);

        // Create Component View
        InitRoute::initComponentView($data);

        // Create Route and Import Main Route Vue
        InitRoute::initVue($data->title);



        // Update Child Class To Category
        $item_class = "\\" . str_replace("/", "\\", $item_class);
        $data->update(['item_class' => $item_class]);
        return $data;
    }

    public static function updateCategory()
    {

    }

    public static function destroyCategoryWithItem(Request $request)
    {
        // $id = $request->id;
        // $category = Category::findOrFail($id);
        // $items = $category->items();
        Schema::dropIfExists('tableName');
    }

    public static function getAll($defaultCond = [], $cond)
    {
        $query = Category::query();
        // Thêm điều kiện loại và tiêu đề vào câu truy vấn
        $query->where($defaultCond);
        // Nếu có điều kiện title được truyền vào từ bên ngoài
        if (isset($cond['title'])) {
            $query->where('title', 'like', '%' . $cond['title'] . '%');
        }
        if(isset($cond['category_type_id'])){
            $query->where('category_type_id', $cond['category_type_id']);
        }
        // Kiểm tra nếu cần phân trang
        if (isset($cond['paginate'])) {
            // Phân trang kết quả với số lượng bản ghi mỗi trang là 5
            return $query->paginate(5);
        } else {
            // Trả về tất cả kết quả
            return $query->get();
        }
    }

    public function isExist($title){
        return self::where('title', $title)->first();
    }
    public function isMany($typeCategory){
        $categoryType = CategoryType::where('type', $typeCategory)->first();
        return $categoryType->is_many;
    }
    public function isList($typeCategory){
        $categoryType = CategoryType::where('type', $typeCategory)->first();
        return $categoryType->is_list;
    }
}
