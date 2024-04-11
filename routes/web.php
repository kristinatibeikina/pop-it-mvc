<?php

use Src\Route;

Route::add('GET', '/hello', [Controller\Site::class, 'hello'])->middleware('auth');
Route::add(['GET', 'POST'], '/login', [Controller\Site::class, 'login']);
Route::add(['GET','POST'], '/logout', [Controller\Site::class, 'logout']);
Route::add(['GET', 'POST'], '/signup', [Controller\Admin::class, 'signup'])->middleware('admin');
Route::add(['GET', 'POST'], '/counting', [Controller\Employees::class, 'counting'])->middleware('employees');
Route::add(['GET', 'POST'], '/addendum', [Controller\Employees::class, 'addendum'])->middleware('employees');
