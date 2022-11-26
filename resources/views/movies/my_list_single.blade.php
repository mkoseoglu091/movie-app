@section('title', "Movie Tracker")
@include('partials.header')
@include('partials.navbar')

<div class="card flex-row mx-3 bg-light">
  <img style="width:30%; height:100%;" class="card-img-lg-left img-responsive img-fluid mx-3 mb-3 mt-3" src="https://image.tmdb.org/t/p/w500/{{ $viewData['movie']['image'] }}" alt="Movie Poster"/>
  <div class="card-body">
  <h5 class="card-title h1 h2-sm"> {{ $viewData["movie"]["title"] }}</h5>
    <p class="card-text"> Watched on: {{ $viewData["movie"]["watched_date"] }}
        <br><t>My Rating: @foreach(range(1, $viewData["movie"]["rating"]) as $x) &#11088; @endforeach

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
    <a href="{{ '/movies/edit/'.$viewData['id'] }}" style="float:left;" class="btn btn-primary">Edit</a>
    
    <form class="mx-3" style="float:left;" action = "{{ '/movies/delete/'.$viewData['movie']['id'] }}" method="POST">
      @csrf
      @method('DELETE')
      <button class="btn btn-danger">Delete</button>
    </form>
    

  </div>
</div>

@include('partials.footer')