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
Route::get('/', 'App\Http\Controllers\MovieController@index')->name('home');

// my list
Route::get('/movies/all/','App\Http\Controllers\MovieController@AllMovies')->name('myList')->middleware('auth');

// my list filtered by date watched
Route::get('/movies/filter/1/', 'App\Http\Controllers\MovieController@FilterMoviesWatched')->name('getFilterWatched')->middleware('auth');
Route::post('/movies/filter/1/', 'App\Http\Controllers\MovieController@FilterMoviesWatched')->name('postFilterWatched')->middleware('auth');

// my list filtered by release date
Route::get('/movies/filter/2/', 'App\Http\Controllers\MovieController@FilterMoviesReleased')->name('getFilterReleased')->middleware('auth');
Route::post('/movies/filter/2/', 'App\Http\Controllers\MovieController@FilterMoviesReleased')->name('postFilterReleased')->middleware('auth');

// my list filtered by director
Route::get('/movies/filter/3/', 'App\Http\Controllers\MovieController@FilterMoviesDirector')->name('getFilterDirector')->middleware('auth');
Route::post('/movies/filter/3/', 'App\Http\Controllers\MovieController@FilterMoviesDirector')->name('postFilterDirector')->middleware('auth');

// my list filtered by all
Route::get('/movies/filter/4/', 'App\Http\Controllers\MovieController@FilterMoviesAll')->name('getFilterAll')->middleware('auth');
Route::post('/movies/filter/4/', 'App\Http\Controllers\MovieController@FilterMoviesAll')->name('postFilterAll')->middleware('auth');

// single movie details
Route::get('/movies/all/{id}','App\Http\Controllers\MovieController@SingleMovie')->name('myList.single')->middleware('auth');

// search routes
Route::get('/search','App\Http\Controllers\MovieController@search')->name('search');
Route::get('/searchID','App\Http\Controllers\MovieController@searchtmdb')->name('tmdb');

// movie details on search
Route::get('/movies/{id}','App\Http\Controllers\MovieController@ShowMovie')->name('single');

// add-delete-update movie
Route::post('/movies/add','App\Http\Controllers\MovieController@AddMovie')->name('movie.save')->middleware('auth');
Route::delete('/movies/delete/{id}', 'App\Http\Controllers\MovieController@DeleteMovie')->name('movie.delete')->middleware('auth');
Route::get('/movies/edit/{id}','App\Http\Controllers\MovieController@EditMovie')->name('movie.edit')->middleware('auth');
Route::post('/movies/update/{id}', 'App\Http\Controllers\MovieController@UpdateMovie')->name('movie.update')->middleware('auth');

// scenes
Route::get('/scenes/{id}', 'App\Http\Controllers\MovieController@ScenesList')->name('scenes.list')->middleware('auth');
Route::get('/scenes/add/{id}/', 'App\Http\Controllers\MovieController@ScenesAdd')->name('scene.add')->middleware('auth');
Route::post('/scenes/save/{id}/', 'App\Http\Controllers\MovieController@ScenesSave')->name('scene.save')->middleware('auth');
Route::delete('/scenes/delete/{id}/{scene_id}', 'App\Http\Controllers\MovieController@ScenesDelete')->name('scene.delete')->middleware('auth');
Route::get('/scenes/edit/{id}/{scene_id}', 'App\Http\Controllers\MovieController@ScenesEdit')->name('scene.edit')->middleware('auth');
Route::post('/scenes/update/s{id}/{scene_id}', 'App\Http\Controllers\MovieController@ScenesUpdate')->name('scene.update')->middleware('auth');

// User
Route::get('/settings', 'App\Http\Controllers\MovieController@Settings')->name('settings')->middleware('auth');
Route::get('/delete', 'App\Http\Controllers\MovieController@DeleteUser')->name('user.delete')->middleware('auth');
Route::get('/logout', 'App\Http\Controllers\Auth\LoginController@logout')->name('logout');


Auth::routes();


