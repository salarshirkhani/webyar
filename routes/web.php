<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dashboard\employee\AbsenceController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::prefix('dashboard')
    ->name('dashboard.')
    ->middleware('auth')
    ->namespace('Dashboard')
    ->group(function() {
        Route::get('', 'IndexController@get')->name('index');
        Route::prefix('admin')
            ->name('admin.')
            ->middleware('user_type:admin')
            ->namespace('Admin')
            ->group(function() {
                Route::get('', 'IndexController@get')->name('index');

            });

        Route::prefix('customer')
            ->name('customer.')
            ->middleware('user_type:customer')
            ->namespace('Customer')
            ->group(function() {
                Route::get('', 'IndexController@get')->name('index');

            });

        Route::prefix('employee')
            ->name('employee.')
            ->middleware('user_type:employee')
            ->namespace('Employee')
            ->group(function() {
                Route::get('', 'IndexController@get')->name('index');

     });
    });
Route::post('start-work/{id}',[AbsenceController::class,'start_work']);
Route::post('finish-work/{id}',[AbsenceController::class,'finish_work']);
