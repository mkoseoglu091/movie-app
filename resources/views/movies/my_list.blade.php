@section("title", "Movie Tracker")
@include('partials.header')
@include('partials.navbar')

<div class="row mx-0 px-0">
<h2>{{ $viewData["Title"] }}</h2>
<div class="mb-3">
<p class="d-inline">Filter By: </p>
<a href="{{ route('getFilterWatched') }}" class="btn btn-dark">Date Watched</a>
<a href="{{ route('getFilterReleased') }}" class="btn btn-dark">Date Released</a>
<a href="{{ route('getFilterDirector') }}" class="btn btn-dark">Director</a>
<a href="{{ route('getFilterAll') }}" class="btn btn-dark">All</a>


</div>
@forelse($viewData["movies"] as $movie) 
<div class="card text-white bg-secondary mb-3 mx-3" style="width: 18rem;">
    <img class="card-img-top mt-3" src="https://image.tmdb.org/t/p/w300/{{ $movie['image'] }}" alt="Movie Poster">  
    <div class="card-body">
    <h5 class="card-title">{{ $movie["title"] }}</h5>
    <p class="card-text">Watched on: {{ $movie["watched_date"] }}</p>
    <a href="{{ route('myList.single', $movie['id']) }}" class="btn btn-dark">Details</a>
  </div>
</div>
@empty
<p>No Movie Found</p>
@endforelse

</div>
@include('partials.footer')