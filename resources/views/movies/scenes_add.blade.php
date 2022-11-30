@section('title', "Movie Tracker")
@include('partials.header')
@include('partials.navbar')
@include('partials.error')


<div class="card flex-row mx-3 bg-light">
  <img style="width:30%; height:100%;" class="card-img-lg-left img-responsive img-fluid mx-3 mb-3 mt-3" src="https://image.tmdb.org/t/p/w500/{{ $viewData['movie']['image'] }}" alt="Movie Poster"/>
  <div class="card-body">
  <h5 class="card-title h1 h2-sm"> {{ $viewData["movie"]["title"] }}</h5>
    <p class="card-text"> 
    <a href="{{ route('scenes.list', $viewData['movie']['id']) }}" class="btn btn-dark">Back</a>

    <form method="POST" action="{{ route('scene.save', ['id' => $viewData['movie']->id]) }}" enctype="multipart/form-data">
    @csrf
    <div class="col-md-4">
        <label for="hour">Hour: </label>
        <input class="form-control" name="hour" type="number" min="0" max="24" value="0">
    </div>
    <div class="col-md-4">
        <label for="minute">Minute: </label>
        <input class="form-control" name="minute" type="number" min="0" max="59" value="0">
    </div>
    <div class="col-md-4">
        <label for="second">Second: </label>
        <input class="form-control" name="second" type="number" min="0" max="59" value="0">
    </div>
        <br>
    <div class="col-md-4">
        <label for="comments">Comments: </label>
        <textarea name="comments" type="text" class="form-control"></textarea>
        <br>
        
        <label class="form-label" for="chooseFile">Select Screenshot: </label>
        <input type="file" name="file" class="form-control" id="chooseFile">

        <input type="hidden" name="user_id" value="{{ $viewData['movie']['user_id'] }}">
        <input type="hidden" name="movie_id" value="{{ $viewData['movie']['id'] }}">
    </div>
        <input type="submit" value="Add Scene" class="btn btn-primary mt-3"> 
        
    </form>    
    </p>
  
    

  </div>
</div>

@include('partials.footer')