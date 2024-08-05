<?php

function directorySeparator(){
    return DIRECTORY_SEPARATOR;
}
function pathMigration() {
    return base_path(
        directorySeparator() . 
        'database' . 
        directorySeparator() . 
        'migrations' . 
        directorySeparator() .
        'CMS' . 
        directorySeparator()
    );
}

function pathMigrationCategorySample() {
    return (
        pathMigration() . 
        'Sample' . 
        directorySeparator() . 
        'SampleMigrateCategory.txt'
    );
}

function pathMigrationItemSample($type = 'collection') {
    $fileMigrateSample = 'SampleMigrateItemCollection.txt';
    switch ($type) {
        case 'collection':
            break;
        case 'asset':
            $fileMigrateSample = 'SampleMigrateItemAsset.txt';
            break;
        case 'classification':
            $fileMigrateSample = 'SampleMigrateItemClassification.txt';
            break;
        case 'form':
            $fileMigrateSample = 'SampleMigrateItemForm.txt';
            break;
        case 'global':
            $fileMigrateSample = 'SampleMigrateItemGlobal.txt';
            break;
        case 'navigation':
            $fileMigrateSample = 'SampleMigrateItemNavigation.txt';
            break;
        default:
            $fileMigrateSample = 'SampleMigrateItemOther.txt';
            break;
    }
    return (
        pathMigration() . 
        'Sample' . 
        directorySeparator() . 
        $fileMigrateSample
    );
}

function pathModel() {
    return app_path(
        directorySeparator() . 
        'Models' . 
        directorySeparator() . 
        'CMS' . 
        directorySeparator()
    );
}

function pathModelCategorySample() {
    return (
        pathModel() . 
        'Sample' . 
        directorySeparator() . 
        'SampleModelCategory.txt'
    );
}

function pathModelItemSample($type) {
    $fileModelSample = 'SampleModelItem.txt';
    switch ($type) {
        case 'form':
            $fileModelSample = 'SampleModelItemForm.txt';
            break;
        default:
            $fileModelSample = 'SampleModelItem.txt';
            break;
    }
    return (
        pathModel() . 
        'Sample' . 
        directorySeparator() . 
        $fileModelSample
    );
}

function pathModelCategorySave() {
    return (
        pathModel() . 
        'category' . 
        directorySeparator()
    );
}

function pathModelItemSave() {
    return (
        pathModel() . 
        'item' . 
        directorySeparator()
    );
}



function pathController() {
    return app_path(
        directorySeparator() . 
        'Http' . 
        directorySeparator() . 
        'Controllers' . 
        directorySeparator() . 
        'CMS' . 
        directorySeparator() . 
        'API' . 
        directorySeparator()
    );
}

function pathMail() {
    return app_path(
        directorySeparator() . 
        'Mail' . 
        directorySeparator() . 
        'CMS' . 
        directorySeparator()
    );
}

function pathControllerItemSample($type) {
    $fileControllerSample = 'SampleControllerItem.txt';
    switch ($type) {
        case 'form':
            $fileControllerSample = 'SampleControllerItemForm.txt';
            break;
        default:
            $fileControllerSample = 'SampleControllerItem.txt';
            break;
    }
    return (
        pathController() . 
        'Sample' . 
        directorySeparator() . 
        $fileControllerSample
    );
}

function pathMailItemSample() {
    return (
        pathMail() . 
        'Sample' . 
        directorySeparator() . 
        'SampleMail.txt'
    );
}

function pathMailItemViewSample() {
    return (
        resource_path('views/cms/mail/sample/SampleMail.blade.php')
    );
}

function pathMailItemSave() {
    return (
        pathMail()
    );
}

function pathMailItemViewSave() {
    return (
        resource_path('views/cms/mail/')
    );
}

function pathControllerItemSave() {
    return (
        pathController() . 
        'Item' . 
        directorySeparator()
    );
}


function pathRouteLaravel() {
    return base_path('routes') . directorySeparator();
}

function filePathRouteApiUse() {
    return (
        pathRouteLaravel() . 
        'Sample' .
        directorySeparator() . 
        'SampleRouteApiUse.txt'
    );
}
function filePathRouteApiResource($type) {
    $fileRouteSample = 'SampleRouteApiResource.txt';
    switch ($type) {
        case 'form':
            $fileRouteSample = 'SampleRouteApiResourceForm.txt';
            break;
        default:
            $fileRouteSample = 'SampleRouteApiResource.txt';
            break;
    }
    return (
        pathRouteLaravel() . 
        'Sample' .
        directorySeparator() . 
        $fileRouteSample
    );
}

function filePathRouteApiItemSave() {
    return (
        pathRouteLaravel() .
        'web_cms.php'
    );
}



function pathRouteVue() {
    return base_path('resources/cms/router') . directorySeparator();
}

function pathRouteVueItem() {
    return pathRouteVue() . "item" . directorySeparator();
}

function filePathRouteVueItemSample() {
    return pathRouteVueItem() . "Sample" . directorySeparator() . "main.txt";
}

function pathComponentVue() {
    return base_path('resources/cms/components') . directorySeparator();
}


function pathComponentVueItem() {
    return pathComponentVue() . "item" . directorySeparator();
}