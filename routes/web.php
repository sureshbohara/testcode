<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\AuthorController;
use App\Http\Controllers\Admin\BooksController;
use App\Http\Controllers\HomeController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::prefix('/admin')->namespace('App\Http\Controllers\Admin')->group(function(){
    Route::match(['get', 'post'], '/', [AdminController::class, 'adminLogin'])->name('admin.login');
    Route::match(['get', 'post'], '/forgot-password', [AdminController::class, 'adminForgotPwd'])->name('admin.forgot.pwd');
    Route::middleware(['admin'])->group(function () {
        Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('logout', [AdminController::class, 'adminLogout'])->name('admin.logout');
        Route::match(['GET','POST'],'account/delete',[AdminController::class,'accountDelete'])->name('account.delete');
        Route::match(['GET','POST'],'update/password',[AdminController::class,'updatePassword'])->name('update.password');
       Route::match(['GET','POST'],'update',[AdminController::class,'updateAdminDetails'])->name('update.details'); 
       Route::get('profile',[AdminController::class,'adminProfile'])->name('profile');

       // admin users route
        Route::resource('users', AdminController::class);


        Route::resource('category', CategoryController::class, ['except' => 'show']);
        Route::post('status/category', [CategoryController::class,'categoryStatus'])->name('status.category');
        Route::post('change/category/{id}', [CategoryController::class,'changeTypeCategory'])->name('category.change');

        Route::resource('author', AuthorController::class, ['except' => 'show']);
        Route::post('status/author', [AuthorController::class,'authorStatus'])->name('status.author');

        Route::resource('books', BooksController::class, ['except' => 'show']);
        Route::post('status/books', [BooksController::class,'booksStatus'])->name('status.books');
        Route::post('change/books/{id}', [BooksController::class,'changeTypebooks'])->name('books.change');




  });
});


 Route::get('/', [HomeController::class,'index'])->name('front.home');
 Route::get('/listing', [HomeController::class, 'category'])->name('category');
 Route::get('/category/{slug}', [HomeController::class, 'categoryBooks'])->name('category.books');
 Route::get('/listing/author/{name}', [HomeController::class, 'authorByBooks'])->name('category.author');
 Route::get('/search', [HomeController::class, 'searchItem'])->name('search.items');

 Route::get('/books/{slug}', [HomeController::class, 'booksDetails'])->name('books.details');



