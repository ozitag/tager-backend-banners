<?php

use Illuminate\Support\Facades\Route;

Route::get('/tager/market-boards/{alias}', \OZiTAG\Tager\Backend\Banners\Controllers\PublicController::class . '@banner');

Route::group(['prefix' => 'admin', 'middleware' => ['passport:administrators', 'auth:api']], function () {
    Route::get('/market-boards', \OZiTAG\Tager\Backend\Banners\Controllers\AdminController::class . '@index');
    Route::post('/market-boards', \OZiTAG\Tager\Backend\Banners\Controllers\AdminController::class . '@create');
    Route::get('/market-boards/{id}', \OZiTAG\Tager\Backend\Banners\Controllers\AdminController::class . '@view');
    Route::get('/market-boards/{alias}', \OZiTAG\Tager\Backend\Banners\Controllers\AdminController::class . '@viewByAlias');
    Route::put('/market-boards/{id}', \OZiTAG\Tager\Backend\Banners\Controllers\AdminController::class . '@update');
    Route::delete('/market-boards/{id}', \OZiTAG\Tager\Backend\Banners\Controllers\AdminController::class . '@delete');

    Route::get('/market-boards/{id}/items', \OZiTAG\Tager\Backend\Banners\Controllers\AdminController::class . '@listItems');
    Route::post('/market-boards/{id}/items', \OZiTAG\Tager\Backend\Banners\Controllers\AdminController::class . '@createItem');
    Route::get('/market-boards/items/{id}', \OZiTAG\Tager\Backend\Banners\Controllers\AdminController::class . '@viewItem');
    Route::put('/market-boards/items/{id}', \OZiTAG\Tager\Backend\Banners\Controllers\AdminController::class . '@updateItem');
    Route::delete('/market-boards/items/{id}', \OZiTAG\Tager\Backend\Banners\Controllers\AdminController::class . '@removeItem');
    Route::post('/market-boards/items/{id}/{direction}', \OZiTAG\Tager\Backend\Banners\Controllers\AdminController::class . '@moveItem')
        ->where('direction', 'up|down');
});
