<?php

use Illuminate\Support\Facades\Route;

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

                Route::resource('slider-items', 'SliderItemController')->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
          
                Route::post('news/create', ['uses' => 'PostController@CreatePost','as' => 'news.create' ]);
                Route::get('news/create', ['uses' => 'PostController@GetCreatePost','as' => 'news.create']); 
                
                Route::get('news/manage', 'PostController@GetManagePost')->name('news.manage');
                Route::get('deletepost/{id}','PostController@DeletePost')->name('news.deletepost');  
                Route::get('updatepost/{id}','PostController@GetEditPost')->name('news.updatepost');
                Route::post('updatepost/{id}','PostController@UpdatePost')->name('news.updatepost');

                Route::post('product/create', ['uses' => 'ProductController@CreatePost','as' => 'product.create' ]);
                Route::get('product/create', ['uses' => 'ProductController@GetCreatePost','as' => 'product.create']); 
                Route::get('product/manage', 'ProductController@GetManagePost')->name('product.manage');
                Route::get('deleteproduct/{id}','ProductController@DeletePost')->name('product.deleteproduct');  
                Route::get('updateproduct/{id}','ProductController@GetEditPost')->name('product.updateproduct');
                Route::post('updateproduct/{id}','ProductController@UpdatePost')->name('product.updateproduct');      
 
                //Category Controller 
                Route::resource("categories", "CategoryController");
           
            });

        Route::prefix('customer')
            ->name('customer.')
            ->middleware('user_type:buyer')
            ->namespace('Customer')
            ->group(function() {
                Route::get('', 'IndexController@get')->name('index');
                Route::get('search', 'SearchController@search')->name('search');

            });

        Route::prefix('owner')
            ->name('owner.')
            ->middleware('user_type:seller')
            ->namespace('Owner')
            ->group(function() {
                Route::get('', 'IndexController@get')->name('index');

     });
    });