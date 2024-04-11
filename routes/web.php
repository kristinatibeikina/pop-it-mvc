<?php

use Src\Route;

Route::add('GET', '/hello', [Controller\Site::class, 'hello'])->middleware('auth');
Route::add(['GET', 'POST'], '/login', [Controller\Site::class, 'login']);
Route::add(['GET','POST'], '/logout', [Controller\Site::class, 'logout']);
Route::add(['GET', 'POST'], '/signup', [Controller\Site::class, 'signup'])->middleware('admin');
