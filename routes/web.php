<?php

use Illuminate\Support\Facades\Route;

use App\Http\Middleware\StewardMiddleware;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\EditorMiddleware;

use App\Http\Controllers\ManageUserRightsController;
use App\Http\Controllers\BlogController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/manage-user-rights/{user}', [ManageUserRightsController::class, 'index'])->name('manage-user-rights.index')
->middleware(StewardMiddleware::class);
Route::post('/store-user-rights/{user}', [ManageUserRightsController::class, 'store'])->name('manage-user-rights.store')
->middleware(StewardMiddleware::class);

Route::get('/blog/create', [BlogController::class, 'create'])->name('blog.create')->middleware(EditorMiddleware::class);
Route::post('/blog/store', [BlogController::class, 'store'])->name('blog.store')->middleware(EditorMiddleware::class);
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{blog}', [BlogController::class, 'show'])->name('blog.show');
Route::get('/blog/edit/{blog}', [BlogController::class, 'edit'])->name('blog.edit')
->middleware(EditorMiddleware::class);
Route::post('/blog/update/{blog}', [BlogController::class, 'update'])->name('blog.update')
->middleware(EditorMiddleware::class);

Route::delete('/blog/delete/{blog}', [BlogController::class, 'delete'])->name('blog.delete')
->middleware(AdminMiddleware::class);
