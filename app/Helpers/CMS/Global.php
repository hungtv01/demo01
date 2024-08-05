<?php

function getExtraFormFrontend($page){
    $handle_category = $page->category()->first();
    if($handle_category){
        $design = $handle_category->design()->first();
        if($design){
            return $design->data;
        }
    }
    return NULL;
}

