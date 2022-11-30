@section("title", "Movie Tracker")
@include('partials.header')
@include('partials.navbar')

<div class="row mx-0 px-0">
<h2>{{ $viewData["Title"] }}</h2>
<div class="mb-3">
<a href="{{ route('myList') }}" class="btn btn-danger">Reset Filters</a>
</div>
<div>
<form method="POST" action="?">
    @csrf
        <label for="director" class="form-label">To: </label>
        <input class="form-control w-25" name="director" type="text">
        <br>

        <input type="submit" value="Filter" class="btn btn-dark mb-3 mt-3"> 
        
    </form>
  <h2>Filter Results</h2>
  
  @if(count($viewData['director_freq']) > 1)
  <div class="mb-3">
    @foreach($viewData['director_freq'] as $key => $value)
    <form style="float:left;" class="form-inline mb-3 mx-1" action="?" method="POST">
      @csrf
      <input class="form-control w-25" name="director" type="hidden" value="{{ $key }}">
      <button type="submit" class="btn btn-dark" value="{{ $key }}">{{ $key }}</button>
    </form>
    @endforeach
</div>
  @endif
</div>
@forelse($viewData["movies"] as $movie) 
<div class="card text-white bg-secondary mb-3 mx-3" style="width: 18rem;">
    <img class="card-img-top mt-3" src="https://image.tmdb.org/t/p/w500/{{ $movie['image'] }}" alt="Movie Poster">  
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