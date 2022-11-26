@section("title", "Movie Tracker")
@include('partials.header')
@include('partials.navbar')

<div class="row mx-0 px-0">
<h2>{{ $viewData["Title"] }}</h2>
<div class="mb-3">
<a href="{{ '/movies/all/' }}" class="btn btn-danger">Reset Filters</a>
</div>
<div>
<form method="POST" action="?">
    @csrf
        <label for="from">From: </label>
        <input class="form-control w-25" name="from" type="date">
        <br>

        <label for="to" class="form-label">To: </label>
        <input class="form-control w-25" name="to" type="date">
        <br>

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
    <a href="{{ url('/movies/all/'.$movie['id']) }}" class="btn btn-dark">Details</a>
  </div>
</div>
@empty
<p>No Movie Found</p>
@endforelse

</div>
@include('partials.footer')