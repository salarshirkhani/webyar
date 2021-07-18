<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
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
        Route::get('',  'IndexController@get')->name('index');
        Route::prefix('admin')
            ->name('admin.')
            ->middleware(['user_type:admin'])
            ->namespace('Admin')
            ->group(function() {
                Route::get('',  'IndexController@get')->name('index');

                //Project PAGE 
                Route::post('project/create', ['uses' => 'ProjectController@CreatePost','as' => 'project.create']);
                Route::get('project/create', ['uses' => 'ProjectController@GetCreatePost','as' => 'project.create']);  
                Route::get('project/manage', 'ProjectController@GetManagePost')->name('project.manage');
                Route::get('deletepost/{id}','ProjectController@DeletePost')->name('project.deletepost');  
                Route::get('updatepost/{id}','ProjectController@GetEditPost')->name('project.updatepost');
                Route::post('updatepost/{id}','ProjectController@UpdatePost')->name('project.updatepost');               
 
               //PHASE PAGE 
                Route::post('phase/create/{id}', ['uses' => 'PhaseController@CreatePost','as' => 'phase.create']);
                Route::get('phase/create/{id}', ['uses' => 'PhaseController@GetCreatePost','as' => 'phase.create']);  
                Route::get('phase/manage/{id}', 'PhaseController@GetManagePost')->name('phase.manage');
                Route::get('deletephase/{id}','PhaseController@DeletePost')->name('phase.deletephase');  
                Route::get('updatephase/{id}','PhaseController@GetEditPost')->name('phase.updatephase');
                Route::post('updatephase/{id}','PhaseController@UpdatePost')->name('phase.updatephase');               
           
            });

        Route::prefix('customer')
            ->name('customer.')
            ->middleware(['user_type:customer'])
            ->namespace('Customer')
            ->group(function() {
                Route::get('',  'IndexController@get')->name('index');

            });

        Route::prefix('employee')
            ->name('employee.')
            ->middleware(['user_type:employee'])
            ->namespace('Employee')
            ->group(function() {
                Route::get('',  'IndexController@get')->name('index');

     });
    });