<?php

namespace App\Models\CMS\Init;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Artisan;

class InitController extends InitBase
{
    use HasFactory;
    public static function init($data)
    {
        $content = '';
        $controller = parent::controller($data->title);
        $model = parent::model($data->title, true);
        $mail = parent::mail($data->title);

        $fullPathSample = pathControllerItemSample($data->categoryType->type);
        $fullPathSave = pathControllerItemSave() . $controller . '.php';

        $arrayReplace = [
            'ItemSample' => $model, 
            'SampleController' => $controller, 
            'ItemSample' => $model
        ];
        if($data->categoryType->type == 'form'){
            $arrayReplace['SampleMail'] = $mail;
        }
        $content = getContentFileAndReplaceArray($fullPathSample, $arrayReplace);
        return emptyAndWriteFile($fullPathSave, $content);
    }


}
