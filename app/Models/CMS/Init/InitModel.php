<?php

namespace App\Models\CMS\Init;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Artisan;

class InitModel extends InitBase
{
    use HasFactory;
    public static function init($data, $isChild = false)
    {
        $modelName = parent::model($data->title, $isChild);
        $pathMakeMode = 'CMS/' . ($isChild ? 'item/' : 'category/') . $modelName;
        Artisan::call('make:model ' . $pathMakeMode);
        return $pathMakeMode;
    }
    public static function initRelationship($data, $parentId = 0, $isChild = false){
        $content = '';
        $model = parent::model($data->title, $isChild);
        $table = parent::table($data->title, $isChild);
        $modelChild = parent::model($data->title, true);

        $fullPathSample = $isChild ? pathModelItemSample($data->categoryType->type) : pathModelCategorySample();
        $fullPathSave = ($isChild ? pathModelItemSave() : pathModelCategorySave()) . $model . '.php';

        if($isChild){
            $content = getContentFileAndReplaceArray($fullPathSample, ['SampleModel' => $model, 'SampleTable' => $table, 'SampleParentId' => $parentId]);
        }else{
            $content = getContentFileAndReplaceArray($fullPathSample, ['SampleModelItem' => $modelChild, 'SampleUseModelItem' => $modelChild, 'SampleParentId' => $parentId, 'SampleModel' => $model]);
        }
        return emptyAndWriteFile($fullPathSave, $content);
    }
}
