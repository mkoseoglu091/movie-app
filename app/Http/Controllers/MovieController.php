<?php

// https://api.themoviedb.org/3/search/movie?api_key=7fcfa4a3af3449014f16b1ff41de256e&query=the+avengers
// API key = 7fcfa4a3af3449014f16b1ff41de256e
// get title of movie, add to query, API will return an array of movies, either grab first one, or show all for user to add
// fetch required info, ask user for rest of info, add to database
// to grab poster path: https://image.tmdb.org/t/p/w500/   +   poster path (RYMX2wcKCBAr24UyPD7xwmjaTn.jpg)

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Scene;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;


class MovieController extends Controller {

    // get popular movies from TMDB
    function index() {
        $popularMovies = Http::get('https://api.themoviedb.org/3/movie/now_playing?api_key=7fcfa4a3af3449014f16b1ff41de256e')->json();
        $viewData = array();
        $viewData['Title'] = 'Now Playing';
        $viewData['movies'] = $popularMovies;

        //var_dump($popularMovies);

        return view('movies.home_page')->with("viewData",$viewData);
    }

    function search(Request $request) {
        $movie = $request->input('search');
        $foundMovies = Http::get('https://api.themoviedb.org/3/search/movie?api_key=7fcfa4a3af3449014f16b1ff41de256e&query='.$movie)->json();
        $viewData = array();
        $viewData['Title'] = 'Search Result';
        $viewData['movies'] = $foundMovies;

        return view('movies.search_movies')->with("viewData",$viewData);
    }

    function searchtmdb(Request $request) {
        $movie = $request->input('search');
        $viewData['movies'] = array();

        $mov = Http::get('https://api.themoviedb.org/3/movie/'.$movie.'?api_key=7fcfa4a3af3449014f16b1ff41de256e')->json();
        if(!isset($mov["poster_path"])){
            $viewData["movie"] = null;
        } else {
            $viewData['movie'] = $mov;

        }

        $viewData['Title'] = 'Search Result';

        return view('movies.search_movies_by_id')->with("viewData",$viewData);
    }

    function AllMovies($user_id) {

        if(Auth::check()){
            $user_id = Auth::id();
        }

        //Initialize View data
        $viewData = array();
        $viewData['Title'] = 'Watched Movies';
        //$viewData['movies'] = Movie::all();
        $viewData['movies'] = User::findorFail($user_id)->movie->sortBy('watched_date');
        $viewData['user_id'] = $user_id;

        return view('movies.my_list')
            ->with("viewData",$viewData);
    }


    function FilterMoviesWatched(Request $request, $user_id) {

        if(Auth::check()){
            $user_id = Auth::id();
        }

        $viewData = array();
        $viewData['Title'] = 'Movies By Date Watched';

        if(Auth::check()){
            $user_id = Auth::id();
        }

        $movies = array();
        $movies = User::findorFail($user_id)->movie->sortBy('watched_date')->toArray();
        $viewData['user_id'] = $user_id;

        // filter if from date exists
        if($request->input('from') !== null){
            $filtered = array_filter($movies, function($movie) use($request){ return $movie["watched_date"] > $request->input('from'); });
            $movies = $filtered;
        }

        // filter if to date exists
        if($request->input('to') !== null){
            $filtered = array_filter($movies, function($movie) use($request){ return $movie["watched_date"] < $request->input('to'); });
            $movies = $filtered;
        }

        $viewData['movies'] = $movies;

        return view('movies.my_list_filter')
            ->with("viewData",$viewData);
    }

    function FilterMoviesReleased(Request $request, $user_id) {

        if(Auth::check()){
            $user_id = Auth::id();
        }

        $viewData = array();
        $viewData['Title'] = 'Movies By Date Released';

        $movies = array();
        $movies = User::findorFail($user_id)->movie->sortBy('watched_date')->toArray();
        $viewData['user_id'] = $user_id;

        // filter if from date exists
        if($request->input('from') !== null){
            $filtered = array_filter($movies, function($movie) use($request){ return $movie["release_date"] > $request->input('from'); });
            $movies = $filtered;
        }

        // filter if to date exists
        if($request->input('to') !== null){
            $filtered = array_filter($movies, function($movie) use($request){ return $movie["release_date"] < $request->input('to'); });
            $movies = $filtered;
        }

        $viewData['movies'] = $movies;

        return view('movies.my_list_filter')
            ->with("viewData",$viewData);
    }

    function FilterMoviesAll(Request $request, $user_id) {

        if(Auth::check()){
            $user_id = Auth::id();
        }

        $viewData = array();
        $viewData['Title'] = 'Movies By Director';

        $movies = array();
        $movies = User::findorFail($user_id)->movie->sortBy('watched_date')->toArray();
        $viewData['user_id'] = $user_id;

        // filter if from date exists
        if($request->input('release_from') !== null){
            $filtered = array_filter($movies, function($movie) use($request){ return $movie["release_date"] > $request->input('release_from'); });
            $movies = $filtered;
            $viewData['release_from'] = $request->input('release_from');
        } else {
            $viewData['release_from'] = "";
        }

        // filter if to date exists
        if($request->input('release_to') !== null){
            $filtered = array_filter($movies, function($movie) use($request){ return $movie["release_date"] < $request->input('release_to'); });
            $movies = $filtered;
            $viewData['release_to'] = $request->input('release_to');
        } else {
            $viewData['release_to'] = "";
        }

        // filter if from date exists
        if($request->input('watch_from') !== null){
            $filtered = array_filter($movies, function($movie) use($request){ return $movie["watched_date"] > $request->input('watch_from'); });
            $movies = $filtered;
            $viewData['watch_from'] = $request->input('watch_from');
        } else {
            $viewData['watch_from'] = "";
        }

        // filter if to date exists
        if($request->input('watch_to') !== null){
            $filtered = array_filter($movies, function($movie) use($request){ return $movie["watched_date"] < $request->input('watch_to'); });
            $movies = $filtered;
            $viewData['watch_to'] = $request->input('watch_to');
        } else {
            $viewData['watch_to'] = "";
        }

        // filter if from date exists
        if($request->input('director') !== null){
            $filtered = array_filter($movies, function($movie) use($request){ return str_contains(strtolower($movie["director"]), strtolower($request->input('director'))); });
            $movies = $filtered;
        }

        // director options
        $directors = array();

        foreach ($movies as $m){
            $directors[] = $m['director'];
        }

        $director_freq = array_count_values($directors);
        $viewData['director_freq'] = $director_freq;

        $viewData['movies'] = $movies;

        return view('movies.my_list_filter_all')
            ->with("viewData",$viewData);
    }

    function FilterMoviesDirector(Request $request, $user_id) {

        if(Auth::check()){
            $user_id = Auth::id();
        }
        $movies = array();

        $viewData = array();
        $viewData['Title'] = 'Movies By Director';

        $movies = array();
        $movies = User::findorFail($user_id)->movie->sortBy('watched_date')->toArray();
        $viewData['user_id'] = $user_id;

        // filter if from date exists
        if($request->input('director') !== null){
            $filtered = array_filter($movies, function($movie) use($request){ return str_contains(strtolower($movie["director"]), strtolower($request->input('director'))); });
            $movies = $filtered;
        }

        // director options
        $directors = array();

        foreach ($movies as $m){
            $directors[] = $m['director'];
        }

        $director_freq = array_count_values($directors);
        $viewData['director_freq'] = $director_freq;

        $viewData['movies'] = $movies;

        return view('movies.my_list_filter_director')
            ->with("viewData",$viewData);
    }

    function DeleteMovie($user_id, $id) {

        if(Auth::check()){
            $user_id = Auth::id();
        }

        Movie::destroy($id);

        $viewData = array();
        $viewData['Title'] = 'Watched Movies';
        //$viewData['movies'] = Movie::all();
        $viewData['movies'] = User::findorFail($user_id)->movie;
        $viewData['user_id'] = $user_id;

        return redirect('/movies/all/'.$user_id)->with("viewData",$viewData);
    }

    function SingleMovie($user_id, $id)  {

        if(Auth::check()){
            $user_id = Auth::id();
        }

        //Grab the course from the database
        $movie = Movie::where('user_id', '=', $user_id)->where('id', '=', $id)->firstorFail();

        //Initialize View data
        $viewData = array();
        $viewData['Title'] = $movie->title;
        $viewData['movie'] = $movie;
        $viewData['user_id'] = $user_id;
        $viewData['id'] = $id;
        $viewData['movieData'] = Http::get('https://api.themoviedb.org/3/movie/'.$movie->tmdb_id.'?api_key=7fcfa4a3af3449014f16b1ff41de256e')->json();
        
        $credits = Http::get('https://api.themoviedb.org/3/movie/'.$movie->tmdb_id.'/credits?api_key=7fcfa4a3af3449014f16b1ff41de256e')->json();
        $cast = $credits["cast"];
        $highlight = array_slice($cast, 0, 8);
        $viewData['actors'] = $highlight;

        return view('movies.my_list_single')
            ->with('viewData',$viewData);
    }

    function EditMovie($user_id, $id)  {

        if(Auth::check()){
            $user_id = Auth::id();
        }

        //Grab the course from the database
        $movie = Movie::where('user_id', '=', $user_id)->where('id', '=', $id)->firstorFail();

        //Initialize View data
        $viewData = array();
        $viewData['Title'] = $movie->title;
        $viewData['movie'] = $movie;
        $viewData['user_id'] = $user_id;
        $viewData['id'] = $id;
        $viewData['movieData'] = Http::get('https://api.themoviedb.org/3/movie/'.$movie->tmdb_id.'?api_key=7fcfa4a3af3449014f16b1ff41de256e')->json();
        
        $credits = Http::get('https://api.themoviedb.org/3/movie/'.$movie->tmdb_id.'/credits?api_key=7fcfa4a3af3449014f16b1ff41de256e')->json();
        $cast = $credits["cast"];
        $highlight = array_slice($cast, 0, 8);
        $viewData['actors'] = $highlight;


        return view('movies.my_list_single_edit')
            ->with('viewData',$viewData);
    }

    function ShowMovie($id){
        $movie = Http::get('https://api.themoviedb.org/3/movie/'.$id.'?api_key=7fcfa4a3af3449014f16b1ff41de256e')->json();
        $credits = Http::get('https://api.themoviedb.org/3/movie/'.$id.'/credits?api_key=7fcfa4a3af3449014f16b1ff41de256e')->json();
        
        $cast = $credits["cast"];
        $highlight = array_slice($cast, 0, 8);

        $crew = $credits["crew"];

        foreach($crew as $c){
            if($c["job"] === "Director"){
                $director = $c["name"];
            }
        }
        
        $viewData = array();
        $viewData['Title'] = 'Search Result';
        $viewData['movie'] = $movie;
        $viewData['actors'] = $highlight;
        $viewData['director'] = $director;

        return view('movies.search_movies_single')->with('viewData', $viewData);
    }

    function AddMovie(Request $request){

        // validate request
        // only watched date is required, rest are taken from existing movie data
        // user does not have to provide a rating or comment
        $request->validate([
            "watched_date" => "required",
        ]);

        $newMovie = new Movie();
        $newMovie->user_id = Auth::check() ? Auth::id() : $request->input('user_id');
        $newMovie->tmdb_id = $request->input('tmdb_id');
        $newMovie->title = $request->input('title');
        $newMovie->image = $request->input('image');
        $newMovie->release_date = $request->input('release_date');
        $newMovie->genre = $request->input('genre');
        $newMovie->director = $request->input('director');
        $newMovie->actors = ''; // can be gathered from tmdb_id if required
        $newMovie->watched_date = $request->input('watched_date');
        $newMovie->rating = $request->input('rating');
        $newMovie->comments = $request->input('comments') ? $request->input('comments') : '';
        $newMovie->tmdb_rating = $request->input('tmdb_rating');
        $newMovie->cinema = $request->has('cinema');
        $newMovie->friends = $request->has('friends');

        $newMovie->save();

        return back()->with('message', 'Success!!');
    }

    function UpdateMovie(Request $request, $user_id, $id) {

        if(Auth::check()){
            $user_id = Auth::id();
        }
    
        $request->validate([
            "watched_date" => "required",
        ]);

        $newMovie = Movie::where('user_id', '=', $user_id)->where('id', '=', $id)->firstorFail();

        $newMovie->watched_date = $request->input('watched_date');
        $newMovie->rating = $request->input('rating');
        $newMovie->comments = $request->input('comments') ? $request->input('comments') : '';
        $newMovie->cinema = $request->has('cinema');
        $newMovie->friends = $request->has('friends');

        $newMovie->save();

        // return to all movies
        $viewData = array();
        $viewData['Title'] = 'Watched Movies';
        //$viewData['movies'] = Movie::all();
        $viewData['movies'] = User::findorFail($user_id)->movie;
        $viewData['user_id'] = $user_id;

        return redirect('/movies/all/'.$user_id)->with("viewData",$viewData);
    }

    function ScenesList($user_id, $id) {

        if(Auth::check()){
            $user_id = Auth::id();
        }

        $movie = Movie::where('user_id', '=', $user_id)->where('id', '=', $id)->firstorFail();
        $scenes = array();
        $scenes = $movie->scene->sortBy('time');

        $viewData['Title'] = 'Saved Scenes';
        $viewData['movie'] = $movie;
        $viewData['scenes'] = $scenes;
        $viewData['user_id'] = $user_id;
        
        return view('movies.scenes_list')->with('viewData', $viewData);
    }

    function ScenesAdd($user_id, $id) {

        if(Auth::check()){
            $user_id = Auth::id();
        }

        $movie = Movie::where('user_id', '=', $user_id)->where('id', '=', $id)->firstorFail();

        $viewData['Title'] = 'Add Scene';
        $viewData['movie'] = $movie;
        $viewData['user_id'] = $user_id;
        
        return view('movies.scenes_add')->with('viewData', $viewData);

    }

    function ScenesEdit($user_id, $id, $scene_id) {

        if(Auth::check()){
            $user_id = Auth::id();
        }

        $scene = Scene::findorFail($scene_id);
        $movie = Movie::where('user_id', '=', $user_id)->where('id', '=', $id)->firstorFail();

        $viewData['Title'] = 'Edit Scene';
        $viewData['movie'] = $movie;
        $viewData['scene'] = $scene;
        $time = explode(':', $scene['time']);
        $viewData['hour'] = $time[0];
        $viewData['minute'] = $time[1];
        $viewData['second'] = $time[2];
        $viewData['user_id'] = $user_id;
        
        return view('movies.scenes_edit')->with('viewData', $viewData);

    }
    
    function ScenesSave(Request $request, $user_id, $id) {

        if(Auth::check()){
            $user_id = Auth::id();
        }

        $request->validate([
            "file" => "mimes:jpeg,png,jpg|max:50",
        ]);

        $scene = new Scene();
        $scene->user_id = $user_id;
        $scene->movie_id = $id;
        $scene->comments = $request->input('comments') ? $request->input('comments') : '';
        
        // format time
        $time = $request->input('hour') . ':' . $request->input('minute') . ':' . $request->input('second');
        $scene->time = $time;

        // screenshot
        if($request->hasFile('file')){
                $path = $request->file('file')->getRealPath();

                /* $thumb = Image::make($path)->resize(100, 100, function ($constraint) {
                    $constraint->aspectRatio(); //maintain image ratio
                }); */

                $extension = $request->file('file')->extension();
                $content = file_get_contents($path);
                $base64 = base64_encode($content);
                $scene->screenshot = $base64;
                $scene->extension = $extension; 
        } else {
            $scene->screenshot = "";
            $scene->extension = "";
        }

        
        $scene->save();

        // return to all scenes

        $movie = Movie::where('user_id', '=', $user_id)->where('id', '=', $id)->firstorFail();
        $scenes = array();
        $scenes = $movie->scene;

        $viewData['Title'] = 'Saved Scenes';
        $viewData['movie'] = $movie;
        $viewData['scenes'] = $scenes;
        $viewData['user_id'] = $user_id;
        
        return view('movies.scenes_list')->with('viewData', $viewData);
    }

    function ScenesUpdate(Request $request, $user_id, $id, $scene_id) {

        if(Auth::check()){
            $user_id = Auth::id();
        }

        $scene = Scene::findorFail($scene_id);

        $scene->comments = $request->input('comments') ? $request->input('comments') : '';
        
        // format time
        $time = $request->input('hour') . ':' . $request->input('minute') . ':' . $request->input('second');
        $scene->time = $time;
        
        $scene->save();

        // return to all scenes

        $movie = Movie::where('user_id', '=', $user_id)->where('id', '=', $id)->firstorFail();
        $scenes = array();
        $scenes = $movie->scene;

        $viewData['Title'] = 'Saved Scenes';
        $viewData['movie'] = $movie;
        $viewData['scenes'] = $scenes;
        $viewData['user_id'] = $user_id;
        
        return view('movies.scenes_list')->with('viewData', $viewData);
    }


    function ScenesDelete($user_id, $id, $scene_id) {

        if(Auth::check()){
            $user_id = Auth::id();
        }

        Scene::destroy($scene_id);

        $movie = Movie::where('user_id', '=', $user_id)->where('id', '=', $id)->firstorFail();
        $scenes = array();
        $scenes = $movie->scene;

        $viewData['Title'] = 'Saved Scenes';
        $viewData['movie'] = $movie;
        $viewData['scenes'] = $scenes;
        $viewData['user_id'] = $user_id;
        
        return redirect('/scenes/'.$user_id.'/'.$id)->with('viewData', $viewData);
    }


}


?>