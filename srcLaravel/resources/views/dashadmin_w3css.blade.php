
@extends('layouts.pure3')


@section('title', 'Tableau de bord')

@section('content')
    <header class="w3-container w3-teal">
        <h1>Info</h1>
    </header> 
	

		Version Laravel: {{ $laravelVersion }}<br/>
		Mode Debug: {{ $debugMode }}<br/>
		<br/>
		Environment : {{ $env }}<br/>
	
	<h1>Vues des utilisateurs</h1>
		Nombre d'utilisateurs : {{ $usersCount }}<br/>
		<br/>
	
	
		{!! $table !!}
	
@endsection