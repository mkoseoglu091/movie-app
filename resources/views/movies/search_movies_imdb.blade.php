@section("title", "Movie Tracker")
@include('partials.header2')
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

  <div class="w-25 p-3">
    <table class="table">
    @foreach($viewData["movies"] as $movie) 
    <tr>
      <td style="width:25%;"><div><img class="img-fluid" style="object-fit:cover;" src="https://image.tmdb.org/t/p/w300/{{ $movie['details']['poster_path'] }}" alt="Movie Poster"></div></td>
      <td style="width:70%;"><ul class="list-unstyled">
        <li class="h6">{{ $movie["title"] }}</li>
        <li>{{ $movie["release_date"] }}</li>
        <li>{{ $movie["director"] }}</li>
      </ul></td>
      <td style="width:5%;"><ul class="list-unstyled">
        <li><button class="btn btn-dark" id="{{ 'dButton'.$loop->iteration }}" onclick="showdetails()">Show</a></li>
      </ul></td>

    @endforeach
    </table>

    @if($viewData["movies"]->count() > 0)
    {{ $viewData["movies"]->links('pagination::bootstrap-4') }}
    @endif

  </div>


  @foreach($viewData["movies"] as $movie) 
  <div class="w-75 p-3"  id="{{ 'detail'.$loop->iteration }}">
  <div class="card flex-row mx-3 bg-light">
    <img style="width:30%; height:100%;" class="card-img-lg-left img-responsive img-fluid mx-3 mb-3 mt-3" src="https://image.tmdb.org/t/p/w300/{{ $movie['details']['poster_path'] }}" alt="Movie Poster"/>
    <div class="card-body">
    <h5 class="card-title h1 h2-sm"> {{ $movie["title"] }}</h5>
      <p class="card-text"> Watched on: {{ $movie["watched_date"] }}
          <br><t>My Rating: @foreach(range(1, $movie["rating"]) as $x) &#11088; @endforeach {{ $movie["rating"] }}

          <br>Director: {{ $movie["director"]}}
          <br>
          
          Budget: ${{ number_format($movie["budget"], 2) }}
          <br>
          Watched in Cinemas: @if($movie["cinema"]) <span>&#10004;</span> @else <span>&#10060;</span> @endif
          <br>
          Watched with Friends: @if($movie["friends"]) <span>&#10004;</span> @else <span>&#10060;</span> @endif
          <br>
          @if($movie["comments"])
          Comments:
          <p>{{ $movie["comments"] }}</p>
          @endif

          <a href="{{ route('myList.single', $movie['id']) }}" class="btn btn-dark mb-1 mt-3">Details</a>
        
      </p>
      

    </div>
  </div>
  </div>

  @endforeach

</div>
@include('partials.footer')