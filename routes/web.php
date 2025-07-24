<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;

Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);

Route::post('/contact', [ContactController::class, 'sendEmail'])->name('contact.send');
