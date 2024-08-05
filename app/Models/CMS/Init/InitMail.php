<?php

namespace App\Models\CMS\Init;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Artisan;

class InitMail extends InitBase
{
    use HasFactory;
    public static function initMail($data){
        $mail = parent::mail($data->title);
        $mailSlug = parent::slug($data->title);


        $fullPathSample = pathMailItemSample($data->categoryType->type);
        $fullPathSave = pathMailItemSave() . $mail . '.php';

        $content = getContentFileAndReplaceArray($fullPathSample, ['SampleMail' => $mail, 'Sample Mail' => $mail, 'sample-mail' => $mailSlug]);
        return emptyAndWriteFile($fullPathSave, $content);
    }

    public static function initMailView($data){
        $view = parent::slug($data->title);

        $fullPathSample = pathMailItemViewSample();
        $fullPathSave = pathMailItemViewSave() . $view . ".blade.php";

        $content = getContentFileAndReplaceArray($fullPathSample);
        return emptyAndWriteFile($fullPathSave, $content);

    }
}
