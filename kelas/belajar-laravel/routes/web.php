<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/menu', function () {
    return view('menu');
})->name('menu');

Route::get('/order', function () {
    return view('order');
})->name('order');

Route::get('/kontak', function () {
    return view('kontak');
})->name('kontak');

Route::get('/chat', function () {
    return view('chat');
})->name('chat');

?>