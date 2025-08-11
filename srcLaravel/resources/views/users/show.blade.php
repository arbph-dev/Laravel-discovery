
@extends('layouts.pure2')


@section('title', 'Vue utilisateur')



@section('content')
	
	<h1>Vues d'un utilisateur</h1>
			
			<b>nom</b> : {{ $user->name }}<br/>
			<b>email</b> : {{ $user->email }}<br/>
			<b>rôle</b> : {{ $user->role }}<br/>
			<b>type</b> : {{ $user->provider_type }}<br/>

@endsection
