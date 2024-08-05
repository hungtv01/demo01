<?php

namespace App\Models\CMS\Init;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InitComponent extends InitBase
{
    use HasFactory;

    public static function init($title = 'Product Or News')
    {
        $content = '';
        $lowerTitle = strtolower($title);
        $component = parent::component($title);

        $filePathSample = filePathRouteVueItemSample();
        $pathSave = pathRouteVueItem() . $lowerTitle . directorySeparator();
        $filePathSave = $pathSave . "main.js";

        if (!is_dir(pathRouteVueItem() . $lowerTitle)) {
            mkdir(pathRouteVueItem() . $lowerTitle, 0777, true);
        }
        $content = getContentFileAndReplaceArray($filePathSample, [
            'sample' => $lowerTitle,
            'SampleIndex' => "{$component}Index",
            'SampleCreate' => "{$component}Create",
            'SampleEdit' => "{$component}Edit",
            'routeSample' => "route{$component}"
        ]);
        emptyAndWriteFile($filePathSave, $content);
        return true;
    }
}
