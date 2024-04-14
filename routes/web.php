<?php

use Src\Route;

Route::add('GET', '/hello', [Controller\Site::class, 'hello'])->middleware('auth');
Route::add(['GET', 'POST'], '/login', [Controller\Site::class, 'login']);
Route::add(['GET','POST'], '/logout', [Controller\Site::class, 'logout']);
Route::add(['GET', 'POST'], '/signup', [Controller\Admin::class, 'signup'])->middleware('admin');
Route::add(['GET'], '/counting', [Controller\Employees::class, 'counting','square'])->middleware('employees');
Route::add(['GET', 'POST'], '/addendum', [Controller\Employees::class, 'addendum'])->middleware('employees');
Route::add(['GET', 'POST'], '/room', [Controller\Employees::class, 'room'])->middleware('employees');
Route::add(['GET'], '/cv', [Controller\Employees::class, 'cv'])->middleware('employees');
Route::add(['GET'], '/img', [Controller\Employees::class, 'img'])->middleware('employees');
Route::add(['GET','POST'], '/search', [Controller\Employees::class, 'search'])->middleware('employees');