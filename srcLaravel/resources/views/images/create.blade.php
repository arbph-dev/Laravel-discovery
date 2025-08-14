@extends('layouts.pure')

@section('title', 'Ajouter une image')
@section('description', 'Formulaire pour ajouter une image avec altitude correcte pour SEO')

@section('content')
    <h1>Ajouter une image</h1>

    <form action="{{ route('images.store') }}" method="POST" enctype="multipart/form-data">
        @include('images._form')
    </form>

    <a href="{{ route('images.index') }}">Retour à la liste des images</a>
@endsection
