<?php

namespace App\Models\CMS;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CategoryType extends Model
{
    use HasFactory;
    protected $table = 'cms_category_types';
    
    public function categories(): HasMany
    {
        return $this->hasMany(Category::class, 'category_type_id');
    }
}
