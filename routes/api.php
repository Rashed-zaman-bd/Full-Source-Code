<?php

use Illuminate\Http\Request;
use PHPUnit\Event\EventCollection;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\BookingsController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//member registration
Route::post('/registration', [AuthController::class, 'userRegistration'])->name('userRegistration');





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

// get all bookings
Route::get('/all-bookings', [BookingsController::class, 'allBookings'])->name('allBookings');
// get booking
Route::get('/booking/{id}', [BookingsController::class, 'getBooking'])->name('getBooking');
// create booking
Route::post('/create-booking', [BookingsController::class, 'createBooking'])->name('createBooking');
// update booking
Route::put('/update-booking/{id}', [BookingsController::class, 'updateBooking'])->name('updateBooking');
// delete booking
Route::delete('/delete-booking/{id}', [BookingsController::class, 'deleteBooking'])->name('deleteBooking');
