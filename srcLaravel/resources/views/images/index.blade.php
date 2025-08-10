@php
$keyGOOGLESEARCH = "KEY";
$titre = "Elfennel - Module des images"
@endphp

@extends('layouts.pure')

@section('title', 'Elfennel')

@section('description', "Module des images")

@section('content')

	<h1>Liste des images</h1>

  @auth
      @if (Auth::user()->role === 'admin')
      <a href="{{ route('images.create') }}">Ajouter une image</a>
      @endif   
  @endauth

	

	<table>
		<thead>
			<tr>
				<th>ID</th>
				<th>Image</th>
				<th>Nom</th>
				<th>Extension</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($images as $image)
			<tr>
				<td>{{ $image->id }}</td>
				<td>
					<a href="/public/{{ $image->path }}" target="_blank">
						<img src="/public/{{ $image->path }}" alt="{{ $image->filename }}" width="100">
					</a>			
				
					<!-- <img src="./public/{{ $image->path}}" alt="{{ $image->filename }}" width="100"> -->
				</td>
				<td>{{ $image->filename }}</td>
				<td>{{ $image->ext }}</td>
				<td>
					<a href="{{ route('images.show', $image) }}">Voir</a> 
					
					
					@auth
						@if (Auth::user()->role === 'admin')
							<a href="{{ route('images.edit', $image) }}">Modifier</a>
						@endif   
					@endauth
					
					
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>

	{{ $images->links() }} {{-- Pagination --}}
@endsection





