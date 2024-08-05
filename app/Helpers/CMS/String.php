<?php

function getContentFileAndReplaceArray($fullPathExt, $arrayReplace = []){
    $content = file_get_contents($fullPathExt, true);
    if($arrayReplace){
        foreach($arrayReplace as $search => $replace){
            if($replace){
                $content = str_replace($search, $replace, $content);
            }
        }
    }
    return $content;
}
function emptyAndWriteFile($fullPathExt, $content)
{
    $f = fopen($fullPathExt, "w+");
    fwrite($f, $content);
    return fclose($f);
}


function slugify($string) {
    // Chuyển đổi chuỗi thành chữ thường và hỗ trợ UTF-8
    $slug = mb_strtolower($string, 'UTF-8');
    
    // Loại bỏ các ký tự không phải chữ cái, số, khoảng trắng và dấu gạch ngang
    $slug = preg_replace('/[^\p{L}\p{N}\s-]/u', '', $slug);
    
    // Thay thế khoảng trắng bằng dấu gạch ngang
    $slug = str_replace(' ', '-', $slug);
    
    // Loại bỏ các dấu gạch ngang liên tiếp
    $slug = preg_replace('/(-)+/', '-', $slug);
    
    // Loại bỏ các dấu gạch ngang ở đầu và cuối chuỗi
    $slug = trim($slug, '-');
    
    return $slug;
}

function removeNonAscii($string) {
    return iconv('UTF-8', 'ASCII//IGNORE', $string);
}

function createAbbreviation($title) {
    // Tách tên thành các từ
    $words = explode('-', $title); // Tách dựa trên dấu gạch ngang

    // Tạo viết tắt bằng cách lấy ký tự đầu của mỗi từ
    $abbreviation = '';
    foreach ($words as $word) {
        $abbreviation .= substr($word, 0, 1); // Lấy ký tự đầu tiên của mỗi từ
    }

    return strtolower($abbreviation); // Chuyển đổi thành chữ thường
}

function linkCollection($collection){
    if($collection->category() and $collection->slug){
        $category = slugify($collection->category()->title);
        return $collection->slug . "-" . $category . $collection->category()->id;
    }
    return "";
}