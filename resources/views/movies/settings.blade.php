@section("title", "Movie Tracker")
@include('partials.header')
@include('partials.navbar')
@include('partials.error')
@if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
@endif

<div class="row mx-0 px-0">
    <h2>{{ $viewData["Title"] }}</h2>
    <p>Would you like to delete this user?</p>
    <div>
        <a href="{{ route('user.delete') }}" class="btn btn-danger">DELETE</a>
    </div>
    <div>
    <br>
    <h3>Import</h3>
        <p>You can import movies from a CSV file, the expected format is: <br>Date(YYYY-MM-DD), Title, Watched in Cinemas(TRUE / FALSE), Watched Alone (TRUE / FALSE)</p>
        <form method="POST" action="{{ route('import') }}" enctype="multipart/form-data">
        @csrf
        <label class="form-label" for="chooseFile">Select CSV file: </label>
        <input type="file" name="file" class="form-control" id="chooseFile">

        <input type="submit" value="Import" class="btn btn-primary mt-3"> 
        
        </form>    
    </div>
</div>
@include('partials.footer')