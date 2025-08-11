@php
$keyGOOGLESEARCH = "KEY";
$titre = "Elfennel - Module des compétences"
@endphp

@extends('layouts.pure')

@section('title', 'Elfennel')

@section('description', "Module des compétences")

@section('content')

	<h1>Compétences</h1>
	@auth
		@if (Auth::user()->role === 'admin')
			<a href="{{ route('competences.create') }}">Ajouter une compétence</a>
		@endif   
	@endauth
	


	<table class="table table-bordered">
		<thead>
			<tr>
				<th>Nom</th>
				<th>Parent</th>
				<th>Codes</th>
				<th>Description</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
		@foreach($competences as $competence)
			<tr>
				<td>{{ $competence->nom }}</td>
				<td>{{ $competence->parent?->nom ?? '-' }}</td>
				<td>
					ROME: {{ $competence->code_rome ?? '-' }}<br>
					Formacode: {{ $competence->code_formacode ?? '-' }}<br>
					NSF: {{ $competence->code_nsf ?? '-' }}<br>
					RNCP: {{ $competence->code_rncp ?? '-' }}
				</td>
				<td>{{ Str::limit($competence->description, 80) }}</td>
				<td>
					<a href="{{ route('competences.show', $competence) }}" class="btn btn-sm btn-info">Voir</a>
					@auth
						@if (Auth::user()->role === 'admin')
							<a href="{{ route('competences.edit', $competence) }}">Modifier</a>
							<form action="{{ route('competences.destroy', $competence) }}" method="POST" style="display:inline-block;">
								@csrf
									@method('DELETE')
									<button onclick="return confirm('Supprimer cette compétence ?')">Supprimer</button>
							</form>
						@endif   
					@endauth					
					

				</td>
				<td>
					<ul>
						@foreach($competence->enfants as $enfant)
							<!-- <li>{{ $enfant->nom }}</li> -->
							<li>
								<a href="{{ route('competences.show', $enfant) }}">
									{{ $enfant->nom }}
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
