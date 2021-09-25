<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1'], function () {
    Route::post('auth/login', 'AuthController@login')->name('login');

    Route::group(['prefix' => 'auth', 'middleware' => 'auth:api'], function () {
        Route::post('logout', 'AuthController@logout')->name('logout');
        Route::post('refresh-token', 'AuthController@refreshToken')->name('refreshToken');
        Route::post('me', 'AuthController@me')->name('me');
    });

    Route::middleware('auth:api')->group(function () {
        Route::apiResource('users', 'UsersController');
        Route::apiResource('employees', 'EmployeesController');
        Route::apiResource('employees.addresses', 'AddressesController');
        Route::apiResource('employees.salaries', 'EmployeesSalariesHistoricController')->only(['index', 'store', 'destroy']);
    });
});

Route::fallback(function() {
    return response()->json([
        'error' => 'Endpoint ' . url()->current() . ' not found!'
    ], 404);
});

