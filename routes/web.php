<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WaktuSolatController;


Route::get('/', [WaktuSolatController::class, 'index'])->name('home');
Route::get('/api/prayer-times', [WaktuSolatController::class, 'getPrayerTimes'])->name('api.prayer-times');
Route::get('/api/zones', [WaktuSolatController::class, 'getZones'])->name('api.zones');