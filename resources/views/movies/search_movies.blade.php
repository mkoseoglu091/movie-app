@section("title", "Movie Tracker")
@include('partials.header')
@include('partials.navbar')

<div class="wrap mb-3 mx-3">
<h2>{{ $viewData["Title"] }}</h2>
<p>Having difficulty finding your movie? Try searching by TMDB ID...</p>
   <form class="search" method="GET" action="{{ route('tmdb') }}" accept-charset="UTF-8">
      <input name="search" type="text" class="search" placeholder="Search By TMDB ID">
      <button type="submit" class="btn btn-dark">
        <i class="fa fa-search">Search</i>
     </button>
    </form>
</div>

<div class="row mx-0 px-0">

@foreach($viewData["movies"]["results"] as $movie) 
<div class="card text-white bg-secondary mb-3 mx-3" style="width: 18rem;">
    <img class="card-img-top mt-3" src="https://image.tmdb.org/t/p/w500/{{ $movie['poster_path'] }}" alt="Movie Poster">  
    <div class="card-body">
    <h5 class="card-title">{{ $movie["title"] }}</h5>
    <a href="{{ route('single', $movie['id']) }}" class="btn btn-dark">Details</a>
  </div>
</div>
@endforeach

</div>
@include('partials.footer')