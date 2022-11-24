<?php

use Illuminate\Support\Facades\Route;
class Auth extends Illuminate\Support\Facades\Auth {}


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

// home
Route::get('/', 'App\Http\Controllers\MovieController@index');

// my list
Route::get('/movies/all/{user_id}','App\Http\Controllers\MovieController@AllMovies');

// my list filtered by date watched
Route::get('/movies/filter/1/{user_id}', 'App\Http\Controllers\MovieController@FilterMoviesWatched');
Route::post('/movies/filter/1/{user_id}', 'App\Http\Controllers\MovieController@FilterMoviesWatched');

// my list filtered by release date
Route::get('/movies/filter/2/{user_id}', 'App\Http\Controllers\MovieController@FilterMoviesReleased');
Route::post('/movies/filter/2/{user_id}', 'App\Http\Controllers\MovieController@FilterMoviesReleased');

// my list filtered by director
Route::get('/movies/filter/3/{user_id}', 'App\Http\Controllers\MovieController@FilterMoviesDirector');
Route::post('/movies/filter/3/{user_id}', 'App\Http\Controllers\MovieController@FilterMoviesDirector');

// my list filtered by all
Route::get('/movies/filter/4/{user_id}', 'App\Http\Controllers\MovieController@FilterMoviesAll');
Route::post('/movies/filter/4/{user_id}', 'App\Http\Controllers\MovieController@FilterMoviesAll');

// single movie details
Route::get('/movies/{user_id}/{id}','App\Http\Controllers\MovieController@SingleMovie');

// search routes
Route::get('/search','App\Http\Controllers\MovieController@search')->name('search');
Route::get('/searchID','App\Http\Controllers\MovieController@searchtmdb')->name('tmdb');

// movie details on search
Route::get('/movies/{id}','App\Http\Controllers\MovieController@ShowMovie');

// add-delete-update movie
Route::post('/movies/add','App\Http\Controllers\MovieController@AddMovie');
Route::delete('/movies/delete/{user_id}/{id}', 'App\Http\Controllers\MovieController@DeleteMovie');
Route::get('/movies/edit/{user_id}/{id}','App\Http\Controllers\MovieController@EditMovie')->name('movie.edit');
Route::post('/movies/update/{user_id}/{id}', 'App\Http\Controllers\MovieController@UpdateMovie')->name('movie.update');

// scenes
Route::get('/scenes/{user_id}/{id}', 'App\Http\Controllers\MovieController@ScenesList')->name('scenes.list');
Route::get('/scenes/add/{user_id}/{id}/', 'App\Http\Controllers\MovieController@ScenesAdd');
Route::post('/scenes/save/{user_id}/{id}/', 'App\Http\Controllers\MovieController@ScenesSave')->name('scene.save');
Route::delete('/scenes/delete/{user_id}/{id}/{scene_id}', 'App\Http\Controllers\MovieController@ScenesDelete');
Route::get('/scenes/edit/{user_id}/{id}/{scene_id}', 'App\Http\Controllers\MovieController@ScenesEdit');
Route::post('/scenes/update/{user_id}/{id}/{scene_id}', 'App\Http\Controllers\MovieController@ScenesUpdate')->name('scene.update');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
