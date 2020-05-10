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

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/login', 'AuthTwitchController@login')->name('login');
Route::get('/logout', 'HomeController@logout')->name('logout');

/**
 * ROUT FOR TWITCH AUTH
 */
Route::get('/twitch/auth', 'AuthTwitchController@callback')->name('twitch.callback');

/**
 * ROUTE FOR OVERLAY
 */
Route::get('/twitch/overlay/{id}/{overlay_code}', 'OverlayController@overlay')->name('twitch.overlay.view');
Route::get('/twitch/overlay/', 'OverlayController@INDEX')->name('twitch.overlay');
Route::get('/twitch/overlay/generate', 'OverlayController@generateOverlay')->name('twitch.overlay.url');
Route::get('/twitch/overlay/faker', 'OverlayController@OverlayFaker')->name('twitch.overlay.faker');
