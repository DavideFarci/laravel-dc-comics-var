<header>
    <nav class="navbar navbar-expand-lg bg-body-dark mb-4">
        <div class="container-fluid">
          <a class="text-light navbar-brand" href="{{ route('comics.index')}}">Comics</a>
          {{-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button> --}}
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="text-light nav-link active" aria-current="page" href="{{ route('comics.index')}}">Home</a>
              </li>
              <li class="nav-item">
                <a class="text-light nav-link" href="{{ route('comics.create')}}">New</a>
              </li>
              <li class="nav-item">
                <a class="text-light nav-link" href="{{ route('comics.trashed')}}">Bin</a>
              </li>
            </ul>
          </div>
        </div>
    </nav>
</header>