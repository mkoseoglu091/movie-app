@section("title", "Movie Tracker")
@include('partials.header')
@include('partials.navbar')

<div class="row mx-0 px-0">
<h2>{{ $viewData["Title"] }}</h2>
<div class="mb-3">
<a href="{{ '/movies/all/'.$viewData['user_id'] }}" class="btn btn-danger">Reset Filters</a>
</div>
<div>
<form method="POST" action="?">
    @csrf
    <div class="row w-75">
        <div class="col-md-4">
        <h4>Release Date</h4>
        <label for="release_from">From: </label>
        <input class="form-control w-75" name="release_from" type="date">
        <br>

        <label for="release_to" class="form-label">To: </label>
        <input class="form-control w-75" name="release_to" type="date">
        <br>
        </div>

        <div class="col-md-4">
        <h4>Watch Date</h4>
        <label for="watch_from">From: </label>
        <input class="form-control w-75" name="watch_from" type="date">
        <br>

        <label for="watch_to" class="form-label">To: </label>
        <input class="form-control w-75" name="watch_to" type="date">
        <br>
        </div>

        <div class="col-md-4">
        <h4>Director</h4>
        <label for="director" class="form-label">To: </label>
        <input class="form-control w-75" name="director" type="text">
        <br>
        </div>
    </div>

        <input type="submit" value="Filter" class="btn btn-dark mb-3 mt-3"> 
        
    </form>
  <h2>Filter Results</h2>
</div>
@forelse($viewData["movies"] as $movie) 
<div class="card text-white bg-secondary mb-3 mx-3" style="width: 18rem;">
    <img class="card-img-top mt-3" src="https://image.tmdb.org/t/p/w500/{{ $movie['image'] }}" alt="Movie Poster">  
    <div class="card-body">
    <h5 class="card-title">{{ $movie["title"] }}</h5>
    <p class="card-text">Watched on: {{ $movie["watched_date"] }}</p>
    <a href="{{ url('/movies/'.$viewData['user_id'].'/'.$movie['id']) }}" class="btn btn-dark">Details</a>
  </div>
</div>
@empty
<p>No Movie Found</p>
@endforelse

</div>
@include('partials.footer')