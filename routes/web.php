<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;

Route::get('/', function () {
    return view('welcome');
});


Route::view('/registration', 'registration')->name('registration');
Route::post('/register', [RegistrationController::class, 'register'])->name('register');

Route::get('/thankyou', function () {
    return view('thankyou', ['name' => request()->query('name')]);
})->name('thankyou');