@php
$keyGOOGLESEARCH = "KEY";
$titre = "Elfennel - Module des compétences"
@endphp

@extends('layouts.pure')

@section('title', 'Elfennel')

@section('description', "Module des compétences")

@section('content')

    <h1>{{ $competence->nom }}</h1>
    <p><strong>Parent :</strong> {{ $competence->parent?->nom ?? '—' }}</p>
    <p><strong>Code ROME :</strong> {{ $competence->code_rome }}</p>
    <p><strong>Formacode :</strong> {{ $competence->code_formacode }}</p>
    <p><strong>NSF :</strong> {{ $competence->code_nsf }}</p>
    <p><strong>RNCP :</strong> {{ $competence->code_rncp }}</p>
    <p><strong>Description :</strong><br>{{ $competence->description }}</p>

	@auth
		@if (Auth::user()->role === 'admin')
			<a href="{{ route('competences.edit', $competence) }}">Modifier</a>
		@endif   
	@endauth
    
	
	
    <a href="{{ route('competences.index') }}">Retour</a>


@endsection
