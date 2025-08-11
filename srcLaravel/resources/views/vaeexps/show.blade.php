@php
$keyGOOGLESEARCH = $keyGOOGLESEARCH ?? 'MONCODE';
$titre = $titre ?? 'Elfennel - page principale (template simple)';
@endphp


@extends('layouts.pure')

@section('title', $vaeexp->fonction)
@section('description', "Module des expériences,vue détail")

@section('content')
    <h1>{{ $vaeexp->fonction }}</h1>
	
	@if($vaeexp->organisation->pich)
		<img src="{{ asset($vaeexp->organisation->pich) }}" alt="Image {{ $vaeexp->organisation->lbl }}" style="width:200px">
	@else
		<h2>{{ $vaeexp->organisation->lbl }}</h2>
	@endif	
    <p>Du {{ $vaeexp->dd }} au {{ $vaeexp->df }} ({{ $vaeexp->duree }})</p>
    <p>{{ $vaeexp->description }}</p>
	
	
	<h2>Réalisations dans l'expérience</h2>

		@auth
			@if (Auth::user()->role === 'admin')
				<a href="{{ route('realisations.create', ['vaeexp_id' => $vaeexp->id]) }}">
			Ajouter une réalisation , {{ $vaeexp->fonction }} , pour {{ $vaeexp->organisation->lbl }}
			</a>
			@endif
		@endauth
	
		@if($vaeexp->realisations->isEmpty())
			<p>Aucune réalisation associée.</p>
		@else
			<ul>
			@foreach($vaeexp->realisations as $real)
				<li>
				<a href="{{ route('realisations.show', $real) }}">
				
					<strong>{{ $real->titre }}</strong> 
				
				</a>					
				</li>
			@endforeach
			</ul>
		@endif
		
	
@endsection
