<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;

Route::get('/users', [UserController::class, 'index']);
Route::get('/users/user/{id}', [UserController::class, 'show']);
Route::post('/users', [UserController::class, 'store']);
Route::put('/users/update/{id}', [UserController::class, 'update']);
Route::delete('/users/destroy/{id}', [UserController::class, 'destroy']);

