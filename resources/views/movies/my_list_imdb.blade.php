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
  <td style="width:10%;"><div><img class="img-fluid" style="object-fit:cover;" src="https://image.tmdb.org/t/p/w300/{{ $movie['image'] }}" alt="Movie Poster"></div></td>
  <td style="width:80%;"><ul class="list-unstyled">
    <li class="h6">{{ $movie["title"] }}</li>
    <li>{{ $movie["release_date"] }}</li>
    <li>{{ $movie["director"] }}</li>
  </ul></td>
  <td style="width:10%;"><ul class="list-unstyled">
    <li><a href="{{ route('myList.single', $movie['id']) }}" class="btn btn-dark mb-1">Details</a></li>
    <li><button class="btn btn-dark">Details2</a></li>
  </ul></td>

</tr>
@empty
<p>No Movie Found</p>
@endforelse
</table>

@if($viewData["movies"]->count() > 0)
{{ $viewData["movies"]->links('pagination::bootstrap-4') }}
@endif



</div>
<div class="w-50 p-3">
@forelse($viewData["movies"] as $movie) 
<p>Movie Details Here</p>
@empty
<p></p>
@endforelse
</div>



</div>
@include('partials.footer')