<?php
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
Route::get('/404', function() {
    return view('404');
});
Route::get('/', function () {
    return view('index');
});
//-- Characters
Route::get   ('/api/character', 'CharacterController@index');
Route::get   ('/api/character/{id}', 'CharacterController@show');
Route::post  ('/api/character', 'CharacterController@store');
Route::delete('/api/character/{id}', 'CharacterController@destroy');
//-- Heros
Route::get('/api/hero', 'HeroController@index');
Route::get('/api/hero/{id}', 'HeroController@show');
//-- Others
Route::get('/api/explore/{id}', 'ExploreController@index');
Route::get('/api/fight/{id}', 'MatchController@index');
