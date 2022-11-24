<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-3">
  <a class="navbar-brand mx-3" href="/">Home</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav me-auto">
      <li class="nav-item active">
        <a class="nav-link" href="/movies/all/1">My List</span></a>
      </li>
      
      <li class="nav-item">
        <a class="nav-link disabled" href="#">Logout</a>
      </li>
    </ul>
    <ul class="navbar-nav ms-auto mx-3">
      <li class="nav-item">
        <form class="search" method="GET" action="{{ route('search') }}" accept-charset="UTF-8">
      <input name="search" type="text" class="search" placeholder="Search By Title">
      <button type="submit" class="btn btn-secondary">
        <i class="fa fa-search">Search</i>
     </button>
    </form>
      </li>
    </ul>
  </div>
</nav>