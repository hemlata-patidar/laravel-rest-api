<?php

use Illuminate\Support\Facades\Route;

// Import API controllers with correct namespaces
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\RolesController;
use App\Http\Controllers\API\PermissionsController;
use App\Http\Controllers\API\AccountsController;
use App\Http\Controllers\API\AccountLocationsController;
use App\Http\Controllers\API\CafesController;

/*
|--------------------------------------------------------------------------
| API Health Check
|--------------------------------------------------------------------------
*/
Route::get('/test', function () {
    return response()->json([
        'success' => true,
        'message' => 'API is working'
    ]);
});

/*
|--------------------------------------------------------------------------
| Users CRUD
|--------------------------------------------------------------------------
*/
Route::prefix('users')->group(function () {
    Route::get('/', [UserController::class, 'index']);
    Route::get('{id}', [UserController::class, 'show']);
    Route::post('/', [UserController::class, 'store']);
    Route::put('{id}', [UserController::class, 'update']);
    Route::delete('{id}', [UserController::class, 'destroy']);
});

/*
|--------------------------------------------------------------------------
| Roles CRUD
|--------------------------------------------------------------------------
*/
Route::prefix('roles')->group(function () {
    Route::get('/', [RolesController::class, 'index']);
    Route::get('{id}', [RolesController::class, 'show']);
    Route::post('/', [RolesController::class, 'store']);
    Route::put('{id}', [RolesController::class, 'update']);
    Route::delete('{id}', [RolesController::class, 'destroy']);
});

/*
|--------------------------------------------------------------------------
| Permissions CRUD
|--------------------------------------------------------------------------
*/
Route::prefix('permissions')->group(function () {
    Route::get('/', [PermissionsController::class, 'index']);
    Route::get('{id}', [PermissionsController::class, 'show']);
    Route::post('/', [PermissionsController::class, 'store']);
    Route::put('{id}', [PermissionsController::class, 'update']);
    Route::delete('{id}', [PermissionsController::class, 'destroy']);
});

/*
|--------------------------------------------------------------------------
| Accounts CRUD
|--------------------------------------------------------------------------
*/
Route::prefix('accounts')->group(function () {
    Route::get('/', [AccountsController::class, 'index']);
    Route::get('{id}', [AccountsController::class, 'show']);
    Route::post('/', [AccountsController::class, 'store']);
    Route::put('{id}', [AccountsController::class, 'update']);
    Route::delete('{id}', [AccountsController::class, 'destroy']);
});

/*
|--------------------------------------------------------------------------
| Account Locations CRUD
|--------------------------------------------------------------------------
| URL: /api/accounts/{account}/locations
*/
Route::prefix('accounts/{account}')->group(function () {
    Route::get('locations', [AccountLocationsController::class, 'index']);
    Route::get('locations/{id}', [AccountLocationsController::class, 'show']);
    Route::post('locations', [AccountLocationsController::class, 'store']);
    Route::put('locations/{id}', [AccountLocationsController::class, 'update']);
    Route::delete('locations/{id}', [AccountLocationsController::class, 'destroy']);
});

/*
|--------------------------------------------------------------------------
| Cafes CRUD
|--------------------------------------------------------------------------
| URL: /api/locations/{location}/cafes
*/
Route::prefix('locations/{location}')->group(function () {
    Route::get('cafes', [CafesController::class, 'index']);
    Route::get('cafes/{id}', [CafesController::class, 'show']);
    Route::post('cafes', [CafesController::class, 'store']);
    Route::put('cafes/{id}', [CafesController::class, 'update']);
    Route::delete('cafes/{id}', [CafesController::class, 'destroy']);
});
