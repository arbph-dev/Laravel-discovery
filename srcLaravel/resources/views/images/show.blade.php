@extends('layouts.pure')

@section('title', 'Détail de l\'image')

@section('description', "Détail d'une image")

@section('content')
    <h1>Image #{{ $image->id }}</h1>

    <div>
        <img src="/public/{{ $image->path }}" alt="{{ $image->filename }}" style="max-width:400px;">
    </div>
    <ul>
        <li><strong>Nom du fichier :</strong> {{ $image->filename }}</li>
        <li><strong>Extension :</strong> {{ $image->ext }}</li>
        <li><strong>Chemin :</strong> {{ $image->path }}</li>
    </ul>

    <a href="{{ route('images.index') }}">Retour à la liste</a>

    @auth
        @if (Auth::user()->role === 'admin')
            <a href="{{ route('images.edit', $image) }}">Modifier</a>
        @endif
    @endauth
@endsection
