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

<div class="w-50 p-3">
<table class="table">
@forelse($viewData["movies"] as $movie) 
<tr>
  <td style="width:10%;"><img class="img-fluid" src="https://image.tmdb.org/t/p/w300/{{ $movie['image'] }}" alt="Movie Poster"></td>
  <td style="width:80%;"><ul class="list-unstyled">
    <li class="h6">{{ $movie["title"] }}</li>
    <li>{{ $movie["release_date"] }}</li>
    <li>{{ $movie["director"] }}</li>
  </ul></td>
  <td style="width:10%;"><a href="{{ route('myList.single', $movie['id']) }}" class="btn btn-dark">Details</a></td>
</tr>
@empty
<p>No Movie Found</p>
@endforelse
</table>
</div>

</div>
@include('partials.footer')