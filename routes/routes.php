<?php

use Illuminate\Support\Facades\Route;

Route::get('/tager/banners/{alias}', \OZiTAG\Tager\Backend\Banners\Controllers\PublicController::class . '@banner');

Route::group(['prefix' => 'admin', 'middleware' => ['passport:administrators', 'auth:api']], function () {
    Route::get('/banners', \OZiTAG\Tager\Backend\Banners\Controllers\AdminController::class . '@index');
    Route::post('/banners', \OZiTAG\Tager\Backend\Banners\Controllers\AdminController::class . '@create');
    Route::get('/banners/{id}', \OZiTAG\Tager\Backend\Banners\Controllers\AdminController::class . '@view');
    Route::put('/banners/{id}', \OZiTAG\Tager\Backend\Banners\Controllers\AdminController::class . '@update');
    Route::delete('/banners/{id}', \OZiTAG\Tager\Backend\Banners\Controllers\AdminController::class . '@delete');
});
