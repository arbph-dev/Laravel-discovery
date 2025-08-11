
@extends('layouts.pure2')


@section('title', 'Tableau de bord')

@section('content')

	<h1 class="text-3xl font-bold underline bg-cyan-500 px-8">Info</h1>

		Version Laravel: {{ $laravelVersion }}<br/>
		Mode Debug: {{ $debugMode }}<br/>
		<br/>
		Environment : {{ $env }}<br/>
	
	<h1>Vues des utilisateurs</h1>
		Nombre d'utilisateurs : {{ $usersCount }}<br/>
		<br/>
	
	
		{!! $table !!}
	
@endsection