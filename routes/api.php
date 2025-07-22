<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// get all users
Route::get('/users', [UsersController::class, 'getUsers'])->name('getUsers');
//get single user
Route::get('/user/{id}', [UsersController::class, 'getUser'])->name('getUser');
// create single user
Route::post('/create', [UsersController::class, 'createUser'])->name('createUser');
// user update
Route::put('/update/{id}', [UsersController::class, 'updateUser'])->name('updateUser');
// user delete
Route::delete('/delete/{id}', [UsersController::class, 'deleteUser'])->name('deleteUser');
