<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\viewController;
use App\Http\Controllers\Api\ImageController;
use App\Http\Controllers\Api\AddressController;
use App\Http\Controllers\Api\MessageController;
use App\Http\Controllers\Api\UtilityController;
use App\Http\Controllers\Api\ApartmentController;



Route::get('apartments', [ApartmentController::class, 'index'])->name('api.apartments.index');
Route::get('apartments/{apartment}', [ApartmentController::class, 'show'])->name('api.apartments.show');
Route::get('users/', [UserController::class, 'index'])->name('api.users.index');
Route::post('messages/', [MessageController::class, 'store'])->name('api.messages.store');
Route::get('images', [ImageController::class, 'index'])->name('api.images.index');
Route::get('addresses', [AddressController::class, 'index'])->name('api.addresses.index');
Route::get('views', [ViewController::class, 'index'])->name('api.views.index');
Route::get('utilities', [UtilityController::class, 'index'])->name('api.utilities.index');


