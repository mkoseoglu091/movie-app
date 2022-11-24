@section('title', "Movie Tracker")
@include('partials.header')
@include('partials.navbar')
@include('partials.error')
@if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
@endif

<div class="card flex-row mx-3 bg-light">
  <img style="width:30%; height:100%;" class="card-img-lg-left img-responsive img-fluid mx-3 mb-3 mt-3" src="https://image.tmdb.org/t/p/w500/{{ $viewData['movie']['poster_path'] }}" alt="Movie Poster"/>
  
  <div class="card-body">
  <h5 class="card-title h1 h2-sm"> {{ $viewData["movie"]["title"] }}</h5>
    <p class="card-text">
        Genres: <ul>
            @foreach($viewData["movie"]["genres"] as $genre)
            <li>{{ $genre["name"] }}</li>
            @endforeach
            </ul>
        Rating: @foreach(range(1, $viewData["movie"]["vote_average"]) as $x) &#11088; @endforeach {{ $viewData["movie"]["vote_average"]}}
        <br>Budget: ${{ number_format($viewData["movie"]["budget"], 2) }}
        <br>Director: {{ $viewData["director"] }} 
        <br>
        <div class="row mx-0 px-0">
        @foreach($viewData["actors"] as $actor) 
        <div class="card text-white bg-secondary mx-1 mb-1" style="width: 10rem;">
            <img class="card-img-top mt-3" src="https://image.tmdb.org/t/p/w500/{{ $actor['profile_path'] }}" alt="Actor Photo">  
            <div class="card-body">
                <h5 class="card-title">{{ $actor["name"] }}</h5>
            </div>
        </div>
        @endforeach
        </div>
    </p>
    
  </div>
  @auth
  <div class="mx-3 mt-5">
  <form method="POST" action="/movies/add">
    @csrf
        <label for="watched_date">When did you watch this movie?</label>
        <input class="form-control" name="watched_date" type="date">
        <br>
        <label for="rating" class="form-label">How would you rate this movie?</label>
        
        <input name="rating" type="range" class="form-control-range" min="0" max="10" step="1" value="5" id="formControlRange" onChange="document.getElementById('rangeval').innerText = document.getElementById('formControlRange').value">
        <span id="rangeval">5</span>

        <br>
        <label for="comments">Would you like to add any comments?</label>
        <textarea name="comments" type="text" class="form-control"></textarea>
        <br>
        <label class="form-check-label" for="cinema">Viewed in Cinemas?</label>
        <input class="form-check-input" type="checkbox" name="cinema">
        
        <label class="form-check-label" for="friends">Viewed with Friends?</label>
        <input class="form-check-input" type="checkbox" name="friends">
        
        <input type="hidden" name="tmdb_id" value="{{ $viewData['movie']['id'] }}">
        <input type="hidden" name="user_id" value="1">
        <input type="hidden" name="title" value="{{ $viewData['movie']['title'] }}">
        <input type="hidden" name="image" value="{{ $viewData['movie']['poster_path'] }}">
        <input type="hidden" name="tmdb_rating" value="{{ $viewData['movie']['vote_average'] }}">

        <input type="hidden" name="release_date" value="{{ $viewData['movie']['release_date'] }}">
        <input type="hidden" name="genre" value="{{ implode('|', array_map(function($x) {return $x['name'];}, $viewData['movie']['genres'])) }}">
        <input type="hidden" name="director" value="{{ $viewData['director'] }}">


        <input type="submit" value="Add Movie" class="btn btn-dark mt-3"> 
        
    </form>
  </div>
  @endauth
</div>


@include('partials.footer')