@extends('layouts.pure')

@section('title', 'Modifier une image')
@section('description', 'Formulaire pour modifier les données d’une image')

@section('content')
    <h1>Modifier l'image</h1>

    <form action="{{ route('images.update', $image) }}" method="POST">
        @include('images._form', ['image' => $image])
    </form>

    <a href="{{ route('images.show', $image) }}">Retour à l’image</a>
@endsection
