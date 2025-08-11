@php
$keyGOOGLESEARCH = "AfXsb50qf2vbKIfIt9K4j3AdN6a8WHUaGmDdeHcdN0Q";
$titre = "Elfennel - Module des expériences";
@endphp


@extends('layouts.pure')


@section('title', 'Expériences')

@section('description', "Ce module gère les éxpériences professionnels au sein des organisations")


@section('content')
    <h1>Liste des expériences</h1>
	
	
	<form method="GET" action="{{ route('vaeexps.index') }}">
		<input type="text" name="q" value="{{ $q }}" placeholder="Texte libre (titre, description...)">

		<select name="organisation_id">
			<option value="">Tous clients</option>
			@foreach($organisations as $org)
				<option value="{{ $org->id }}" @selected($organisationId == $org->id)>{{ $org->lbl }}</option>
			@endforeach
		</select>

		<select name="competence_id">
			<option value="">Toutes compétences</option>
			@foreach($competences as $comp)
				<option value="{{ $comp->id }}" @selected($competenceId == $comp->id)>{{ $comp->nom }}</option>
			@endforeach
		</select>

		<button type="submit">Rechercher</button>
	</form>	
	
	
	<button id="TreeCmp_toggleAll" class="TreeCmp_expandBtn" onclick="TreeCmp_toggleAll()">Tout déplier</button>

	
	@auth
	  @if (Auth::user()->role === 'admin')
            <div class="cp_tooltip">
				<a class="cp_tooltip" href="{{ route('vaeexps.create') }}" >Ajouter une expérience</a>
                <span class="tooltiptext">Ajouter une expérience au sein d'une organisation</span>
            </div>

            <div class="cp_tooltip">
				<a class="cp_tooltip" href="{{ route('organisations.index') }}" >Organisations</a>
                <span class="tooltiptext">Voir les organisations</span>
            </div>
			
	  @endif   
	@endauth
    
	<ul class="TreeCmp_tree">
	@foreach($vaeexps as $exp)
		@php
			$grouped = $exp->realisations->groupBy(function($r) {
				return $r->client?->lbl ?? '_autres';
			});
			$totalCount = $exp->realisations->count();
		@endphp

		<li class="TreeCmp_node">
			<span class="TreeCmp_toggle" onclick="TreeCmp_toggle(this)">▶</span>
			<strong>{{ $exp->fonction }}</strong>
			chez 
			<a href="{{ route('organisations.show', $exp->organisation) }}">{{ $exp->organisation->lbl }}</a>
			({{ $exp->dd }} → {{ $exp->df }}) <span class="TreeCmp_count">[{{ $totalCount }}]</span>

			@auth
				@if (Auth::user()->role === 'admin')
					<a href="{{ route('realisations.create', ['vaeexp_id' => $exp->id]) }}">Ajouter une réalisation</a>
				@endif
			@endauth




			@if($totalCount > 0)
			<ul class="TreeCmp_children TreeCmp_hidden">
				@foreach($grouped as $client => $realisations)
					<li class="TreeCmp_node">
						<span class="TreeCmp_toggle" onclick="TreeCmp_toggle(this)">▶</span>
						@if($client !== '_autres')
							Réalisations pour <strong>{{ $client }}</strong>
						@else
							<em>Autres réalisations</em>
						@endif
						<span class="TreeCmp_count">[{{ $realisations->count() }}]</span>
						<ul class="TreeCmp_children TreeCmp_hidden">
							@foreach($realisations->sortBy('titre') as $rexp)
								<li>
									<a href="{{ route('realisations.show', $rexp) }}">
										{{ $rexp->titre }} [{{ $rexp->id }}]
									</a>
								</li>
							@endforeach
						</ul>
					</li>
				@endforeach
			</ul>
			@endif
		</li>
		<hr/>
	@endforeach
	</ul>
@endsection
