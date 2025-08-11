@php
$keyGOOGLESEARCH = $keyGOOGLESEARCH ?? 'MONCODE';
$titre = $titre ?? 'Elfennel - page principale (template simple)';
@endphp

@extends('layouts.pure')

@section('title', 'Elfennel')

@section('description', "Module des organisations")

@section('content')

  <h1>{{ $organisation->lbl }}</h1>
	@auth
		@if (Auth::user()->role === 'admin')
		  <a href="{{ route('organisations.edit', $organisation) }}">Modifier</a>
		@endif  
	@endauth	 	
	
    <a href="{{ route('organisations.index') }}">Retour</a> 
    
    <p>{{ $organisation->description }}</p>

    <p>
        <strong>Ville :</strong> {{ $organisation->adville }} ({{ $organisation->addep }})
    </p>
    
    <p>
        <strong>APE :</strong> {{ $organisation->codeape }} – {{ $organisation->lblape }}
    </p>
      @if($organisation->urlweb)
        <p><a href="{{ $organisation->urlweb }}" target="_blank">Site web</a></p>
      @endif
      @if($organisation->urlreg)
        <p><a href="{{ $organisation->urlreg }}" target="_blank">Fiche registre</a></p>
      @endif
      @if($organisation->pich)
        <img src="{{ asset($organisation->pich) }}" alt="Image {{ $organisation->lbl }}" style="max-height:80px">
      @endif

	<h2>Expériences professionnelles</h2>

		@auth
			@if (Auth::user()->role === 'admin')
				<a href="{{ route('vaeexps.create', ['organisation_id' => $organisation->id]) }}">Ajouter une expérience pour {{ $organisation->lbl }}</a>
			@endif
		@endauth	

		@if($organisation->vaeexp->isEmpty())
			<p>Aucune expérience professionnelle associée.</p>
		@else
			<ul>
			@foreach($organisation->vaeexp as $exp)
				<li>
				<a href="{{ route('vaeexps.show', $exp) }}">
				
					<strong>{{ $exp->fonction }}</strong> 
					(du {{ $exp->dd }} au {{ $exp->df }}) – 
					<em>{{ $exp->description }}</em>
					
				</a>					
				</li>
			@endforeach
			</ul>
		@endif


@endsection
