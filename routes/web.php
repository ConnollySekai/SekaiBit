<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Cache;

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

Route::get('/js/lang.js','LocaleController@localizeForJs');

Route::get('/', 'IndexController@index')->name('home');

Route::get('advertise', 'IndexController@advertise')->name('advertise');

Route::get('search', 'SearchController@index')->name('search.index');

Route::get('search/listing/tag', 'SearchController@searchListingByTag')->name('search.listing.tag');

Route::post('listing/store', 'ListingController@store')->name('listing.strore');

Route::post('listing/validate','ListingController@validateSteps')->name('listing.validate');

Route::get('search/tag', 'SearchController@searchTag')->name('search.tag');


Route::prefix('bluelogin')->group(function(){

    /* Authentication routes */
    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->middleware('registered')->name('register');

    Route::post('register', 'Auth\RegisterController@register')->name('register.post');

    Route::get('/','Auth\LoginController@showLoginForm')->name('login');

    Route::post('/', 'Auth\LoginController@login')->name('login.post');

    Route::middleware(['auth'])->group(function() {
        
        Route::post('logout', 'Auth\LoginController@logout')->name('logout');
    
        /* Listing routes */
        Route::get('listing', 'ListingController@index')->name('listing.index');

        Route::put('listing/update/{listing}', 'ListingController@update')->name('listing.update');

        Route::delete('listing/destroy/{listing}', 'ListingController@destroy')->name('listing.destroy');

        /* Tag routes */
        Route::get('tags', 'TagsController@index')->name('tag.index');

        Route::post('tags/store', 'TagsController@store')->name('tag.store');

        Route::delete('tags/destroy/{tag}', 'TagsController@destroy')->name('tag.destroy');
    });
});
