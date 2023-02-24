<?php

use App\Http\Controllers\CustomerController;

Route::group(["prefix" => "Customer"], function () {
    Route::get('/', [CustomerController::class, 'getList']);
    Route::get('/{id}', [CustomerController::class, 'getDetail']);
    Route::post('/', [CustomerController::class, 'addCustomer']);
    Route::patch('/{id}', [CustomerController::class, 'updateCustomer']);
    Route::delete('/{id}', [CustomerController::class, 'deleteCustomer']);
});


Route::get('/', [CustomerController::class, 'index']);

Route::get('/token', function () {
    return csrf_token(); 
});