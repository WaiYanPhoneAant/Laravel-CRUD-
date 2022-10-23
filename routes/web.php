<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;



Route::redirect('/','customer/create')->name('post#home');
Route::get('customer/create',[PostController::class,'creat'])->name('post#create');
Route::post('post/create',[PostController::class,'postCreate'])->name('postcreate');
Route::get('post/delete/{id}/',[PostController::class,'PostDelete'])->name('post#delete');
Route::get('post/updatePage/{id}',[PostController::class,'updatePage'])->name('update#page');
Route::get('post/editpage/{id}',[PostController::class,'editpage'])->name('editpage');
Route::post('post/update',[PostController::class,'update'])->name('post#update');


