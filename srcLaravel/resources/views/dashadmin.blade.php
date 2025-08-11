
@extends('layouts.pure3')


@section('title', 'Tableau de bord')

@section('content')
	<div class="w3-panel">
		<div class="w3-card  w3-pale-green">
			<p>
				
				Version Laravel: {{ $laravelVersion }}<br/>

				Mode Debug: {{ $debugMode }}<br/>

				Environment : {{ $env }}<br/>

			</p>
		</div> 
	</div>	
	
	<div class="w3-container">
	
		<h1>Vues des utilisateurs</h1>
	
		Nombre d'utilisateurs : {{ $usersCount }}<br/>
		<br/>
	
	
		{!! $table !!}

	</div>

@endsection