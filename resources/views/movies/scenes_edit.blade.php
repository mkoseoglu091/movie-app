@section('title', "Movie Tracker")
@include('partials.header')
@include('partials.navbar')
@include('partials.error')


<div class="card flex-row mx-3 bg-light">
  <img style="width:30%; height:100%;" class="card-img-lg-left img-responsive img-fluid mx-3 mb-3 mt-3" src="https://image.tmdb.org/t/p/w300/{{ $viewData['movie']['image'] }}" alt="Movie Poster"/>
  <div class="card-body">
  <h5 class="card-title h1 h2-sm"> {{ $viewData["movie"]["title"] }}</h5>
    <p class="card-text"> 
    <a href="{{ route('scenes.list', $viewData['movie']['id']) }}" class="btn btn-dark">Back</a>

    <form method="POST" action="{{ route('scene.update', ['id' => $viewData['movie']->id, 'scene_id' => $viewData['scene']->id]) }}" enctype="multipart/form-data">
    @csrf
    <div class="col-md-4">
        <label for="hour">Hour: </label>
        <input class="form-control" name="hour" type="number" min="0" max="24" value="{{ $viewData['hour'] }}">
    </div>
    <div class="col-md-4">
        <label for="minute">Minute: </label>
        <input class="form-control" name="minute" type="number" min="0" max="59" value="{{ $viewData['minute'] }}">
    </div>
    <div class="col-md-4">
        <label for="second">Second: </label>
        <input class="form-control" name="second" type="number" min="0" max="59" value="{{ $viewData['second'] }}">
    </div>
        <br>
    <div class="col-md-4">
        <label for="comments">Comments: </label>
        <textarea name="comments" type="text" class="form-control">{{ $viewData['scene']['comments'] }}</textarea>
        <br>
        
    </div>
        <input type="submit" value="Edit Scene" class="btn btn-primary mt-3"> 
        
    </form>    
    </p>
  
    

  </div>
</div>

@include('partials.footer')