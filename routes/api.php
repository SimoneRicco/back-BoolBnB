<?php

use App\Http\Controllers\Api\ApartmentController;
use App\Http\Controllers\Api\ImageController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AddressController;
use App\Http\Controllers\Api\viewController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::get('apartments', [ApartmentController::class, 'index'])->name('api.apartments.index'); // {nomeSito}/api/apartments
Route::get('apartments/{apartment}', [ApartmentController::class, 'show'])->name('api.apartments.show');
Route::get('users/', [UserController::class, 'index'])->name('api.users.index');
Route::get('images', [ImageController::class, 'index'])->name('api.images.index');
Route::get('addresses', [AddressController::class, 'index'])->name('api.addresses.index');
Route::get('views', [ViewController::class, 'index'])->name('api.views.index');
