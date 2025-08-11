@php
$keyGOOGLESEARCH = "KEY";
$titre = "Elfennel - Module des réalisation"
@endphp

@extends('layouts.pure')

@section('title', $titre)

@section('description', $titre )

@section('content')

	<h1>Réalisations</h1>
	@auth
		@if (Auth::user()->role === 'admin')
			<a href="{{ route('realisations.create') }}">Ajouter une réalisation</a>
		@endif   
	@endauth
	


	<table class="table table-bordered">
		<thead>
			<tr>
				<th>titre</th>
				<th>description</th>
				<th>resultat</th>
				<th>conclusion</th>
				<th>competences</th>
			</tr>
		</thead>
		<tbody>
		@foreach($realisations as $realisation)
			<tr>
				<td>
					<a href="{{ route('realisations.show', $realisation) }}" >{{ $realisation->titre }}</a>					
					<br>
					{{ $realisation->vaeexp->fonction }} ( {{ $realisation->vaeexp->organisation->lbl }} )
				</td>
				
				<td>{{ Str::limit($realisation->description, 80) ?? '-' }}</td>
				<td>{{ Str::limit($realisation->resultat, 80) ?? '-' }}</td>
				<td>{{ Str::limit($realisation->conclusion, 80) ?? '-' }}</td>
				

				<td>
					<ul>
						@foreach($realisation->competences as $competence)
							<li>
								<a href="{{ route('competences.show', $competence) }}">
									{{ $competence->nom }}
								</a>
							</li>

						@endforeach
					</ul>
				</td>
			</tr>
		@endforeach
		</tbody>
	</table>


@endsection
