<?php

use Illuminate\Support\Facades\Route;

Route::get('/tager/banners/{alias}', \OZiTAG\Tager\Backend\Banners\Controllers\PublicController::class . '@banner');

Route::group(['prefix' => 'admin', 'middleware' => ['passport:administrators', 'auth:api']], function () {
    Route::get('/banners', \OZiTAG\Tager\Backend\Banners\Controllers\AdminController::class . '@index');
    Route::post('/banners', \OZiTAG\Tager\Backend\Banners\Controllers\AdminController::class . '@create');
    Route::get('/banners/{id}', \OZiTAG\Tager\Backend\Banners\Controllers\AdminController::class . '@view');
    Route::get('/banners/{alias}', \OZiTAG\Tager\Backend\Banners\Controllers\AdminController::class . '@viewByAlias');
    Route::put('/banners/{id}', \OZiTAG\Tager\Backend\Banners\Controllers\AdminController::class . '@update');
    Route::delete('/banners/{id}', \OZiTAG\Tager\Backend\Banners\Controllers\AdminController::class . '@delete');

    Route::get('/banners/{id}/items', \OZiTAG\Tager\Backend\Banners\Controllers\AdminController::class . '@listItems');
    Route::post('/banners/{id}/items', \OZiTAG\Tager\Backend\Banners\Controllers\AdminController::class . '@createItem');
    Route::get('/banners/items/{id}', \OZiTAG\Tager\Backend\Banners\Controllers\AdminController::class . '@viewItem');
    Route::put('/banners/items/{id}', \OZiTAG\Tager\Backend\Banners\Controllers\AdminController::class . '@updateItem');
    Route::delete('/banners/items/{id}', \OZiTAG\Tager\Backend\Banners\Controllers\AdminController::class . '@removeItem');
    Route::post('/banners/items/{id}/{direction}', \OZiTAG\Tager\Backend\Banners\Controllers\AdminController::class . '@moveItem')
        ->where('direction', 'up|down');
});
