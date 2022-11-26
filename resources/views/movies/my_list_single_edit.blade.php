@section('title', "Movie Tracker")
@include('partials.header')
@include('partials.navbar')

<div class="card flex-row mx-3 bg-light">
  <img style="width:30%; height:100%;" class="card-img-lg-left img-responsive img-fluid mx-3 mb-3 mt-3" src="https://image.tmdb.org/t/p/w500/{{ $viewData['movie']['image'] }}" alt="Movie Poster"/>
  <div class="card-body">
  <h5 class="card-title h1 h2-sm"> {{ $viewData["movie"]["title"] }}</h5>
    <p class="card-text"> Watched on: {{ $viewData["movie"]["watched_date"] }}
        <br><t>My Rating: @foreach(range(1, $viewData["movie"]["rating"]) as $x) &#11088; @endforeach {{ $viewData["movie"]["rating"] }}

        <br>Director: {{ $viewData["movie"]["director"]}}
        <br>
        Genres: <ul>
            @foreach($viewData["movieData"]["genres"] as $genre)
            <li>{{ $genre["name"] }}</li>
            @endforeach
            </ul>
        Budget: ${{ number_format($viewData["movieData"]["budget"], 2) }}
        <br>
        Watched in Cinemas: @if($viewData["movie"]["cinema"]) <span>&#10004;</span> @else <span>&#10060;</span> @endif
        <br>
        Watched with Friends: @if($viewData["movie"]["friends"]) <span>&#10004;</span> @else <span>&#10060;</span> @endif

        <br>
        @if($viewData["movie"]["comments"])
        Comments:
        <p>{{ $viewData["movie"]["comments"] }}</p>
        @endif

        <a href="{{ '/scenes/'.$viewData['movie']['id'] }} " class="btn btn-dark mb-3 mt-3">Saved Scenes</a>

        
        <div class="row mx-0 px-0">
        @foreach($viewData["actors"] as $actor) 
        <div class="card text-white bg-secondary mx-1 mb-1" style="width: 10rem;">
            <img class="card-img-top mt-3" src="https://image.tmdb.org/t/p/w500/{{ $actor['profile_path'] }}" alt="Actor Photo">  
            <div class="card-body">
                <h5 class="card-text">{{ $actor["name"] }}</h5>
            </div>
        </div>
        @endforeach
        </div>

        
    </p>
    <!--<a href="{{ url('/movies/'.$viewData["movie"]["tmdb_id"]) }} " class="btn btn-dark">Go To Movie's Page</a>-->
    
    

  </div>
  <div class="mx-3 mt-5">
  <form method="POST" action="{{ route('movie.update', ['id' => $viewData['movie']->id] )}}">
    @csrf
        <label for="watched_date">When did you watch this movie?</label>
        <input class="form-control" name="watched_date" type="date" value="{{ $viewData['movie']['watched_date'] }}">
        <br>
        <label for="rating" class="form-label">How would you rate this movie?</label>
        
        <input name="rating" type="range" class="form-control-range" min="0" max="10" step="1" value="{{ $viewData['movie']['rating'] }}" id="formControlRange" onChange="document.getElementById('rangeval').innerText = document.getElementById('formControlRange').value">
        <span id="rangeval">{{ $viewData['movie']['rating'] }}</span>

        <br>
        <label for="comments">Would you like to add any comments?</label>
        <textarea name="comments" type="text" class="form-control" value="{{ $viewData['movie']['comments'] }}" ></textarea>
      
        <label class="form-check-label" for="cinema">Viewed in Cinemas?</label>
        @if($viewData['movie']['cinema'])
        <input class="form-check-input" type="checkbox" checked name="cinema">
        @else
        <input class="form-check-input" type="checkbox" name="cinema">
        @endif

        <label class="form-check-label" for="friends">Viewed with Friends?</label>
        @if($viewData['movie']['friends'])
        <input class="form-check-input" type="checkbox" checked name="friends">
        @else
        <input class="form-check-input" type="checkbox" name="friends">
        @endif

        <input type="submit" value="Edit Movie" class="btn btn-primary"> 
        
    </form>
  </div>
</div>

@include('partials.footer')