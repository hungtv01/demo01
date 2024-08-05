<?php

namespace App\Models\CMS;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageModule extends Model
{
    use HasFactory;
    protected $table = 'cms_page_modules';
    protected $guarded = [];
}
