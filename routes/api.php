<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\HomeController;


Route::prefix('/v2')->namespace('App\Http\Controllers\Api')->group(function(){
     Route::apiResource('books', HomeController::class);
     Route::get('details/books/{id}', [HomeController::class, 'detailsBooks']);
     Route::get('category/books/{id}', [HomeController::class, 'categoryBooks']);
});


