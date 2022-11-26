@section('title', "Movie Tracker")
@include('partials.header')
@include('partials.navbar')


<div class="card flex-row mx-3 bg-light">
  <img style="width:30%; height:100%;" class="card-img-lg-left img-responsive img-fluid mx-3 mb-3 mt-3" src="https://image.tmdb.org/t/p/w500/{{ $viewData['movie']['image'] }}" alt="Movie Poster"/>
  <div class="card-body">
  <h5 class="card-title h1 h2-sm"> {{ $viewData["movie"]["title"] }}</h5>
    <p class="card-text"> 
        <a href="{{ '/movies/all/'.$viewData['movie']['id'] }}" class="btn btn-dark">Return</a>
        <a href="{{ '/scenes/add/'.$viewData['movie']['id'] }}" class="btn btn-dark">Add Scene</a>
        


        <div class="row mx-0 px-0">
        @forelse($viewData["scenes"] as $scene) 
        <div class="card text-white bg-secondary mx-1 mb-1" style="width: 16rem;">

        

            <img class="card-img-top mt-3" src="{{ $scene['screenshot'] != '' ? 'data:image/'.$scene['extension'].';base64, '.$scene['screenshot'] : '/scene.jpg' }}" alt="Scene Screenshot">  
            <div class="card-body">
                <h5 class="card-text">{{ $scene["time"] }}</h5>
                <p class="mb-1">{{ $scene['comments'] }}</p>
                <br>
                <a href="{{ '/scenes/edit/'.$viewData['movie']['id'].'/'.$scene['id'] }}" class="btn btn-primary">Edit</a>
                
                <form class="" style="float:right;" action = "{{ '/scenes/delete/'.$viewData['movie']['id'].'/'.$scene['id'] }}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button style="float:right;" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
        @empty
        <p class="h5 card-text mx-0 px-0">No Scenes Saved</p>
        @endforelse
        </div>      
    </p>
  
    

  </div>
</div>

@include('partials.footer')