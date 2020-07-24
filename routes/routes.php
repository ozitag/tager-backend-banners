<?php

use Illuminate\Support\Facades\Route;
use OZiTAG\Tager\Backend\Banners\Controllers\AdminController;
use OZiTAG\Tager\Backend\Banners\Controllers\PublicController;

Route::get('/tager/market-boards/{alias}', [PublicController::class, 'banner']);

Route::group(['prefix' => 'admin', 'middleware' => ['passport:administrators', 'auth:api']], function () {
    Route::get('/market-boards', [AdminController::class, 'index']);
    Route::post('/market-boards', [AdminController::class, 'create']);
    Route::get('/market-boards/{id}', [AdminController::class, 'view']);
    Route::get('/market-boards/{alias}', [AdminController::class, 'viewByAlias']);
    Route::put('/market-boards/{id}', [AdminController::class, 'update']);
    Route::delete('/market-boards/{id}', [AdminController::class, 'delete']);

    Route::get('/market-boards/{id}/items', [AdminController::class, 'listItems']);
    Route::post('/market-boards/{id}/items', [AdminController::class, 'createItem']);
    Route::get('/market-boards/items/{id}', [AdminController::class, 'viewItem']);
    Route::put('/market-boards/items/{id}', [AdminController::class, 'updateItem']);
    Route::delete('/market-boards/items/{id}', [AdminController::class, 'removeItem']);
    Route::post('/market-boards/items/{id}/{direction}', [AdminController::class, 'moveItem'])
        ->where('direction', 'up|down');
});
