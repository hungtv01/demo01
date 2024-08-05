<?php

namespace App\Models\CMS\Init;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class InitBase extends Model
{
    use HasFactory;
    protected static function table($title, $isChild = false)
    {
        if($isChild){
            return 'cms_item_' . Str::lower(Str::snake($title)) . 's';
        }
        return Str::lower(Str::snake($title)) . 's';
    }

    protected static function model($value, $isChild = false)
    {
        if($isChild){
            return 'Item' . Str::ucfirst(Str::camel($value));
        }
        return Str::ucfirst(Str::camel($value));
    }

    protected static function controller($value)
    {
        return Str::ucfirst(Str::camel($value)) . "Controller";
    }

    protected static function mail($value)
    {
        return Str::ucfirst(Str::camel($value));
    }

    protected static function slug($value){
        return slugify($value);
    }


    protected static function component($value)
    {
        return Str::ucfirst(Str::camel($value));
    }

    protected static function view($value){
        return Str::ucfirst(Str::camel($value));
    }
    
}
