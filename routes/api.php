<?php


\Illuminate\Support\Facades\Route::get('index',[\App\Http\Controllers\Api\TestApiController::class,'index']);
\Illuminate\Support\Facades\Route::post('store',[\App\Http\Controllers\Api\TestApiController::class,'store']);
\Illuminate\Support\Facades\Route::delete('destroy',[\App\Http\Controllers\Api\TestApiController::class,'destroy']);
Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Users
    Route::apiResource('users', 'UsersApiController');

    // Category
    Route::apiResource('categories', 'CategoryApiController');

    // Sub Category
    Route::apiResource('sub-categories', 'SubCategoryApiController');

    // Product
    Route::apiResource('products', 'ProductApiController');

    // Order
    Route::apiResource('orders', 'OrderApiController');

    // Payment
    Route::apiResource('payments', 'PaymentApiController');

    // Location
    Route::apiResource('locations', 'LocationApiController');

    // Yetkazib Berish
    Route::apiResource('yetkazib-berishes', 'YetkazibBerishApiController');

    // About
    Route::apiResource('abouts', 'AboutApiController');

    // Contact
    Route::apiResource('contacts', 'ContactApiController');
});
