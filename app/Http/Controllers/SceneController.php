<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Scene;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;


class SceneController extends Controller {

    // View list of saved scenes
    function ScenesList($id) {

        $user_id = Auth::id();

        $movie = Movie::where('user_id', '=', $user_id)->where('id', '=', $id)->firstorFail();
        $scenes = array();
        $scenes = $movie->scene->sortBy('time');

        $viewData['Title'] = 'Saved Scenes';
        $viewData['movie'] = $movie;
        $viewData['scenes'] = $scenes;
        $viewData['user_id'] = $user_id;
        
        return view('movies.scenes_list')->with('viewData', $viewData);
    }

    // Scene add form
    function ScenesAdd($id) {

        $user_id = Auth::id();

        $movie = Movie::where('user_id', '=', $user_id)->where('id', '=', $id)->firstorFail();

        $viewData['Title'] = 'Add Scene';
        $viewData['movie'] = $movie;
        $viewData['user_id'] = $user_id;
        
        return view('movies.scenes_add')->with('viewData', $viewData);

    }

    // Scene edit form
    function ScenesEdit($id, $scene_id) {

        $user_id = Auth::id();

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
    
    // save added scene after form
    function ScenesSave(Request $request, $id) {

        $user_id = Auth::id();

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

        return redirect()->route('scenes.list', $id);
    }

    // update scene details
    function ScenesUpdate(Request $request, $id, $scene_id) {
        $scene = Scene::findorFail($scene_id);

        $scene->comments = $request->input('comments') ? $request->input('comments') : '';
        
        // format time
        $time = $request->input('hour') . ':' . $request->input('minute') . ':' . $request->input('second');
        $scene->time = $time;
        
        $scene->save();

        return redirect()->route('scenes.list', $id);
    }

    // delete scene
    function ScenesDelete($id, $scene_id) {
        Scene::destroy($scene_id);

        return redirect()->route('scenes.list', $id);
    }
}

?>