<?php

use App\Http\Controllers\EventsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use PHPUnit\Event\EventCollection;

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

// get all events
Route::get('/all-events', [EventsController::class, 'allEvents'])->name('allEvents');
// get single event
Route::get('/event/{id}', [EventsController::class, 'getEvents'])->name('getEvents');
// create event
Route::post('/create-event', [EventsController::class, 'createEvent'])->name('createEvent');
// update event
Route::put('/update-event/{id}', [EventsController::class, 'updateEvent'])->name('updateEvent');
// delete event
Route::delete('/delete-event/{id}', [EventsController::class, 'deleteEvent'])->name('deleteEvent');

