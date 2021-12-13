<?php

use Illuminate\Support\Facades\Route;
use OZiTAG\Tager\Backend\Banners\Admin\Banners\BannersController;
use OZiTAG\Tager\Backend\Banners\Admin\BannerZones\BannerZonesController;
use OZiTAG\Tager\Backend\Banners\Enums\TagerBannersScope;
use OZiTAG\Tager\Backend\Banners\Web\BannersController as WebBannersController;
use OZiTAG\Tager\Backend\Rbac\Facades\AccessControlMiddleware;

Route::group(['prefix' => 'admin/adv', 'middleware' => ['passport:administrators', 'auth:api']], function () {
    Route::get('/zones', [BannerZonesController::class, 'index']);

    Route::group(['middleware' => [AccessControlMiddleware::scopes(TagerBannersScope::View)]], function () {
        Route::get('/', [BannersController::class, 'index']);
        Route::get('/count', [BannersController::class, 'count']);
        Route::get('/{id}', [BannersController::class, 'view']);

        Route::post('/', [BannersController::class, 'store'])->middleware([
            AccessControlMiddleware::scopes(TagerBannersScope::Create)
        ]);

        Route::group(['middleware' => [AccessControlMiddleware::scopes(TagerBannersScope::Edit)]], function () {
            Route::post('/move/{id}/{direction}', [BannersController::class, 'move'])->where('direction', 'up|down');
            Route::put('/{id}', [BannersController::class, 'update']);
        });

        Route::delete('/{id}', [BannersController::class, 'delete'])->middleware([
            AccessControlMiddleware::scopes(TagerBannersScope::Delete)
        ]);
    });
});

Route::get('/tager/adv/{zone}', [WebBannersController::class, 'view']);
