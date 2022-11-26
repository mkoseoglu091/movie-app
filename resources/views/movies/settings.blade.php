@section("title", "Movie Tracker")
@include('partials.header')
@include('partials.navbar')

<div class="row mx-0 px-0">
<h2>{{ $viewData["Title"] }}</h2>
<p>Would you like to delete this user?</p>
<div>
<a href="/delete" class="btn btn-danger">DELETE</a>
</div>
</div>
@include('partials.footer')