<?php

use App\Http\Controllers\infoController;
use Illuminate\Support\Facades\Route;

Route::get('/', [infoController::class,'show'])->name('home');
// Route::post('/form',"infoController@index")->name('submit');
Route::post('/form', [infoController::class,'index'])->name('save');
Route:: post('/print',[infoController::class, 'print'])->name('print');
//delete
Route::delete('/delete/{id}',[infoController::class,'destroy'])->name('delete');
//edit
Route::get('/edit/{id}',[infoController::class,'edit'])->name('edit');
Route::patch('update/{id}',[infoController::class,'update'])->name('update');