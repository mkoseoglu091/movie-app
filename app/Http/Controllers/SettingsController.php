<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Scene;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;


class SettingsController extends Controller {
    // show settings page
    function Settings(){
        $viewData['Title'] = 'User Settings';

        return view('movies.settings')->with('viewData', $viewData);
    }

    // delete user
    function DeleteUser(){
        $user_id = Auth::id();
        User::destroy($user_id);
        Auth::logout();

        return redirect()->route('home');

    }

    // import movie data from csv
    function Import(Request $request) {

        $user_id = Auth::id();

        ini_set('max_execution_time', 600);

        $request->validate([
            "file" => "mimes:csv",
        ]);

        // csv
        if($request->hasFile('file')){
                $path = $request->file('file')->getRealPath();
                $message = "Success...<br>";
                $notAdded = 0;
                // $extension = $request->file('file')->extension();

                if (($open = fopen($path, "r")) !== FALSE) {

                    while (($data = fgetcsv($open, 1000, ",")) !== FALSE) {
                        $watched_date = date('Y-m-d', strtotime($data[0]));
                        $title = $data[1];
                        $cinema = strtoupper($data[2]) == "TRUE" ? true : false;
                        $friends = strtoupper($data[3]) == "TRUE" ? false : true; // sinan thought of this as alone: true/false, I thought of it as withFriends: true/false so its the opposite
                        if(trim($title) != "" && strtotime($watched_date)){
                            $foundMovies = Http::get('https://api.themoviedb.org/3/search/movie?api_key=7fcfa4a3af3449014f16b1ff41de256e&query='.$title)->json()['results'];
                            if (count($foundMovies) == 0){
                                if ($notAdded == 0){
                                    $message .= "The following movies were not found: <br>";
                                }
                                $message .= '- ';
                                $message .= $title;
                                $message .= '<br>';
                                $notAdded += 1;
                                continue;
                            } else {
                                $foundMovie = $foundMovies[0];
                            }
                            $movie = Http::get('https://api.themoviedb.org/3/movie/'.$foundMovie['id'].'?api_key=7fcfa4a3af3449014f16b1ff41de256e')->json();
                            $credits = Http::get('https://api.themoviedb.org/3/movie/'.$foundMovie['id'].'/credits?api_key=7fcfa4a3af3449014f16b1ff41de256e')->json();
                            
                            $crew = $credits["crew"];

                            foreach($crew as $c){
                                if($c["job"] === "Director"){
                                    $director = $c["name"];
                                }
                            }


                            $newMovie = new Movie();
                            $newMovie->user_id = $user_id;
                            $newMovie->tmdb_id = $movie['id'];
                            $newMovie->title = $movie['title'];
                            $newMovie->image = $movie['poster_path'] ? $movie['poster_path'] : '';
                            $newMovie->release_date = $movie['release_date'];;
                            $newMovie->genre = implode('|', array_map(function($x) {return $x['name'];}, $movie['genres']));
                            $newMovie->director = $director;
                            $newMovie->actors = ''; // can be gathered from tmdb_id if required
                            $newMovie->watched_date = $watched_date;
                            $newMovie->rating = 5;
                            $newMovie->comments = '';
                            $newMovie->tmdb_rating = $movie['vote_average'];
                            $newMovie->cinema = $cinema;
                            $newMovie->friends = $friends;

                            $newMovie->save();
                        }
                    }
                    fclose($open);
                }
        }
        $message .= '<br>Please double check the added movies. The app adds the first movie found with provided title as keyword...';
        //ini_set('max_execution_time', 60);
        return back()->with('message', $message);
    }
}

?>