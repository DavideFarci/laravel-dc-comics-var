@extends('layout.base')

@section('contents')
    <h1>{{ $comic->series}}</h1>
    <span>{{ $comic->sale_date}}</span> -
    <span>{{ $comic->type}}</span>
    <p class="text-white">{{ $comic->description}}</p>
    <img src="{{ $comic->thumb }}" alt="">
@endsection