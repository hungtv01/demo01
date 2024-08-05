<?php

namespace App\Models\CMS;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Page extends Model
{
    use HasFactory;
    protected $table = 'cms_pages';
    protected $guarded = [];

    protected $casts = [
        'modules' => 'array', // Định nghĩa cột data là dạng mảng (array)
    ];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Page::class, 'parent_id');
    }

    public function childrens(): HasMany
    {
        return $this->hasMany(Page::class, 'parent_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'handle_id');
    }

    public function seo(): BelongsTo
    {
        return $this->belongsTo(SEO::class, 'seo_id');
    }

    public function template(): BelongsTo
    {
        return $this->belongsTo(Template::class, 'template_id');
    }


    public function getAll($cond){
        $query = Page::query();
        // Nếu có điều kiện title được truyền vào từ bên ngoài
        if (isset($cond['title'])) {
            $query->where('title', 'like', '%' . $cond['title'] . '%');
        }

        $query->with('template');
        $query->with('category');

        // Sắp xếp theo cột 'order'
        $query->orderBy('order');
    
        // Phân trang kết quả với số lượng bản ghi mỗi trang là 5
        return $query->paginate(5);
    }
}
