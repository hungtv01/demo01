<?php
use Illuminate\Support\Facades\File;

function getAllFilePath($pathFromRootToFolder = ''){
    // $pathToFolder = 'folderParent/folderChild'
    if(!empty($pathFromRootToFolder)){
        $folder = implode('\\', explode('/', $pathFromRootToFolder)) . '\\';
        return File::files(base_path() . $folder);
    }
    return [];
}

function checkFileExists($pathToFolder, $fileNameFullExt){
    $files = getAllFilePath($pathToFolder);
    if(!empty($files)){
        foreach($files as $file){
            $onlyFileNameFullExtArr = explode('\\', $file);
            $onlyFileNameFullExt = $onlyFileNameFullExtArr[count($onlyFileNameFullExtArr) - 1];
            $onlyFileNameWithoutTimeArr = explode('_', $onlyFileNameFullExt);
            unset($onlyFileNameWithoutTimeArr['0'], $onlyFileNameWithoutTimeArr['1'], $onlyFileNameWithoutTimeArr['2'], $onlyFileNameWithoutTimeArr['3']);
            $onlyFileNameWithoutTime = implode('_', $onlyFileNameWithoutTimeArr);
            if($fileNameFullExt == $onlyFileNameWithoutTime){
                return true;
            }
        }
    }
    return false;
}