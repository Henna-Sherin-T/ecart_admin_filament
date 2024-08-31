<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Home;
use App\Livewire\Register;
use App\Livewire\Login;

Route::get('/', Home::class)->name('home');
Route::get('/register', Register::class)->name('register');
Route::get ('/login', Login::class)->name('login');
