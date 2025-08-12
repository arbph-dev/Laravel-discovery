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
        <li><strong>Dimension :</strong> {{ $image->w }} / {{ $image->w }}</li>
        <li><strong>Extension :</strong> {{ $image->ext }}</li>
        <li><strong>Texte alternatif :</strong> {{ $image->alt }}</li>
        <li><strong>Description :</strong> {{ $image->description }}</li>
    </ul>

<h2>Réalisation associée</h2>
    @if( $image->realisations->isEmpty() )
        <p>Aucune réalisation associée.</p>
    @else
        <ul>
        @foreach( $image->realisations as $real )
            <li>
            <a href="{{ route('realisations.show', $real) }}">
            
                <strong>{{ $real->titre }}</strong> 
            
            </a>					
            </li>
        @endforeach
        </ul>
    @endif

    @auth
        @if (Auth::user()->isAdmin() )
            <a href="{{ route('images.edit', $image) }}">Modifier</a>
        @endif
    @endauth
    <a href="{{ route('images.index') }}">Retour à la liste</a>


@endsection