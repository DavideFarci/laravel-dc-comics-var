@extends('layout.base')

@section('contents')
    <div class="container">
        @if (session('delete_success'))
        @php $comic = session('delete_success') @endphp
        <div class="alert alert-danger">
            La pasta "{{ $comic->series }}" è stata eliminata
            <form
                action="{{ route("comics.restore", ['comic' => $comic]) }}"
                    method="post"
                    class="d-inline-block"
                >
                @csrf
                <button class="btn btn-warning">Ripristina</button>
            </form>
        </div>
        @endif

        @if (session('restore_success'))
            @php $comic = session('restore_success') @endphp
            <div class="alert alert-success">
                La comic "{{ $comic->series }}" è stata ripristinata
            </div>
        @endif
        <div class="row row-cols-3">
            @foreach ($comics as $comic)
                <div class="col h-100 mb-3">
                    <div class="card h-100" style="background-color: rgb(204, 204, 204)">
                        <img style="width: 100%" src="{{ $comic->thumb }}" class="card-img-top" alt="...">
                        <div class="card-body">
                        <h5 class="card-title">{{ $comic->series}}</h5>
                        </div>
                        <ul class="list-group list-group-flush">
                        <li class="list-group-item" style="background-color: rgb(204, 204, 204)">€ {{ $comic->price}}</li>
                        <li class="list-group-item" style="background-color: rgb(204, 204, 204)">{{ $comic->title}}</li>
                        <li class="list-group-item" style="background-color: rgb(204, 204, 204)">{{ $comic->sale_date}}</li>
                        <li class="list-group-item" style="background-color: rgb(204, 204, 204)">{{ $comic->type}}</li>
                        </ul>
                        <div class="card-body">
                        <a class="btn btn-primary" href="{{ route('comics.show', ['comic' => $comic->id]) }}" class="card-link">Show</a>
                        <a class="btn btn-success" href="{{ route('comics.edit', ['comic' => $comic->id]) }}" class="card-link">Edit</a>
                        <form class="d-inline-block" method="POST" action="{{ route('comics.destroy', ['comic' => $comic->id]) }}">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger">Delete</button>
                        </form>
                        </div>
                    </div>
                    {{-- <div class="card h-100 mb-3" style="max-width: 540px;">
                        <div class="row g-0">
                          <div class="col-md-6">
                            <img style="object-fit: cover;" src="{{ $comic->thumb }}" class="img-fluid rounded-start h-100" alt="image">
                          </div>
                            <div style="height: 301px" class="col-md-6">
                                <div style="background-color: lightgray" class="card-body h-100">
                                <h5 class="card-title fs-6">{{ strtoupper($comic->series)}}</h5>
                                <p class="card-text">{{ strtoupper($comic->type)}}</p>
                                <p class="card-text">{{ $comic->sale_date}}</p>
                                <p class="card-text fs-bold">€ {{ $comic->price}}</p>
                                <p class="card-text">
                                    <a style="font-size: .7em" class="btn btn-primary" href="{{ route('comics.show', ['comic' => $comic->id]) }}" class="card-link">Show</a>
                                    <a style="font-size: .7em" class="btn btn-success" href="{{ route('comics.edit', ['comic' => $comic->id]) }}" class="card-link">Edit</a>
                                    <form class="d-inline-block" method="POST" action="{{ route('comics.destroy', ['comic' => $comic->id]) }}">
                                        @csrf
                                        @method('delete')
                                        <button style="font-size: .7em" class="btn btn-danger">Delete</button>
                                    </form>
                                </p>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                </div>
            @endforeach
        </div>
        {{ $comics->links() }}

    </div>
@endsection