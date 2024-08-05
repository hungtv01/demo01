<?php

namespace App\Models\CMS\Init;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InitRoute extends InitBase
{
    use HasFactory;


    public static function initLaravel($data)
    {
        $controller = parent::controller($data->title);

        $filePathSampleUse = filePathRouteApiUse();
        $filePathSampleResource = filePathRouteApiResource($data->categoryType->type);
        $filePathRouteWeb = filePathRouteApiItemSave();


        $sampleRouteUseContent = file_get_contents($filePathSampleUse);
        $sampleRouteResourceContent = file_get_contents($filePathSampleResource);
        $filePathRouteWebContent = file_get_contents($filePathRouteWeb);



        $sampleRouteUseContent = str_replace("SampleController", $controller, $sampleRouteUseContent);
        $sampleRouteResourceContent = str_replace("SampleController", $controller, $sampleRouteResourceContent);
        $sampleRouteResourceContent = str_replace("sample_url", slugify($data->title), $sampleRouteResourceContent);
        $sampleRouteResourceContent = str_replace("sample", slugify($data->title), $sampleRouteResourceContent);


        // Ghi nội dung vào file web.php sau dòng // const BREAKPOINT_USE = 'DO NOT DELETE OR MOVE';
        $posUse = strpos($filePathRouteWebContent, '// const BREAKPOINT_USE = \'DO NOT DELETE OR MOVE\';');
        if ($posUse !== false) {
            $newWebFile = substr_replace($filePathRouteWebContent, "\n" . $sampleRouteUseContent . "\n", $posUse, 0);
            file_put_contents($filePathRouteWeb, $newWebFile);
        }

        $filePathRouteWebContent = file_get_contents($filePathRouteWeb);

        // Ghi nội dung vào file web.php sau dòng // const BREAKPOINT_ROUTE = 'DO NOT DELETE OR MOVE';
        $posRoute = strpos($filePathRouteWebContent, '// const BREAKPOINT_ROUTE = \'DO NOT DELETE OR MOVE\';');
        if ($posRoute !== false) {
            $newWebFile = substr_replace($newWebFile, "\n" . $sampleRouteResourceContent . "\n", $posRoute, 0);
            file_put_contents($filePathRouteWeb, $newWebFile);
        }
        return true;
    }


    public static function initVue($title = 'Product Or News')
    {
        $content = '';
        $slugTitle = slugify($title);
        $component = parent::component($title);

        $filePathSample = filePathRouteVueItemSample();
        $pathSave = pathRouteVueItem() . $slugTitle . directorySeparator();
        $filePathSave = $pathSave . "main.js";

        if (!is_dir(pathRouteVueItem() . $slugTitle)) {
            mkdir(pathRouteVueItem() . $slugTitle, 0777, true);
        }
        $content = getContentFileAndReplaceArray($filePathSample, [
            'sample' => $slugTitle,
            'SampleIndex' => "{$component}Index",
            'SampleCreate' => "{$component}Create",
            'SampleEdit' => "{$component}Edit",
            'routeSample' => "route{$component}"
        ]);
        emptyAndWriteFile($filePathSave, $content);



        // Push route main.api
        $pathRouteSample = pathRouteVue() . "Sample" . directorySeparator();
        $pathRoutePushSave = pathRouteVue() . "main.js";

        $filePathSampleImport = $pathRouteSample . "RouterSampleImport.txt";
        $filePathSamplePush = $pathRouteSample . "RouterSamplePush.txt";

        $sampleRouteImportContent = file_get_contents($filePathSampleImport);
        $sampleRoutePushContent = file_get_contents($filePathSamplePush);
        $pathRoutePushSaveContent = file_get_contents($pathRoutePushSave);


        $sampleRouteImportContent = str_replace("routeSample", "route{$component}", $sampleRouteImportContent);
        $sampleRouteImportContent = str_replace("sample", $slugTitle, $sampleRouteImportContent);
        $sampleRoutePushContent = str_replace("routeSample", "route{$component}", $sampleRoutePushContent);



        // Ghi nội dung vào file web.php sau dòng // const BREAKPOINT_USE = 'DO NOT DELETE OR MOVE';
        $posUse = strpos($pathRoutePushSaveContent, '// CONST BREAKPOINT_IMPORT = true;');
        if ($posUse !== false) {
            $newWebFile = substr_replace($pathRoutePushSaveContent, "\n" . $sampleRouteImportContent . "\n", $posUse, 0);
            file_put_contents($pathRoutePushSave, $newWebFile);
        }


        $pathRoutePushSaveContent = file_get_contents($pathRoutePushSave);

        // Ghi nội dung vào file web.php sau dòng // const BREAKPOINT_ROUTE = 'DO NOT DELETE OR MOVE';
        $posRoute = strpos($pathRoutePushSaveContent, '// CONST BREAKPOINT_PUSH = true;');
        if ($posRoute !== false) {
            $newWebFile = substr_replace($newWebFile, "\n" . $sampleRoutePushContent . "\n", $posRoute, 0);
            file_put_contents($pathRoutePushSave, $newWebFile);
        }
        $pathRoutePushSaveContent = file_get_contents($pathRoutePushSave);
        return true;
    }

    public static function initComponentView($data) {
        $content = '';
        $slugTitle = slugify($data->title);
        $component = parent::component($data->title);

        $folderPathSample = pathComponentVueItem() . "Sample" . directorySeparator() . $data->categoryType->type . directorySeparator();

        $filePathIndexSample = $folderPathSample . "Index.txt";
        $filePathCreateSample = $folderPathSample . "Create.txt";
        $filePathEditSample = $folderPathSample . "Edit.txt";

        $filePathIndexSave = pathComponentVueItem() . $slugTitle . directorySeparator() . "Index.vue";
        $filePathCreateSave = pathComponentVueItem() . $slugTitle . directorySeparator() . "Create.vue";
        $filePathEditSave = pathComponentVueItem() . $slugTitle . directorySeparator() . "Edit.vue";


        if (!is_dir(pathComponentVueItem() . $slugTitle)) {
            mkdir(pathComponentVueItem() . $slugTitle, 0777, true);
        }

        $contentSampleIndex = getContentFileAndReplaceArray($filePathIndexSample, [
            'Sample' => $component,
            'sample' => $slugTitle,
        ]);
        emptyAndWriteFile($filePathIndexSave, $contentSampleIndex);


        $contentSampleCreate = getContentFileAndReplaceArray($filePathCreateSample, [
            'Sample' => $component,
            'sample' => $slugTitle,
        ]);
        emptyAndWriteFile($filePathCreateSave, $contentSampleCreate);


        $contentSampleEdit = getContentFileAndReplaceArray($filePathEditSample, [
            'Sample' => $component,
            'sample' => $slugTitle,
        ]);
        emptyAndWriteFile($filePathEditSave, $contentSampleEdit);
        return true;
    }
}
