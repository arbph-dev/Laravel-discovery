@php
	$keyGOOGLESEARCH = "AfXsb50qf2vbKIfIt9K4j3AdN6a8WHUaGmDdeHcdN0Q";
	$metaTitle = $realisation->titre;
	$metaDescription = Str::limit(strip_tags($realisation->description), 160);
	$metaKeywords = $realisation->competences->pluck('nom')->implode(', ');
	$metaImage = $realisation->images->first()?->url() ?? 'https://elfennel.fr/public/img/seo/default-image.jpg';
@endphp

@extends('layouts.pure')

@section('title', $metaTitle )

@section('description', "Module des réalisations,vue détail")

@section('content')

<!-- 
				<td>{{ $realisation->titre }}</td>
				<td>{{ Str::limit($realisation->description, 80) ?? '-' }}</td>
				<td>{{ Str::limit($realisation->resultat, 80) ?? '-' }}</td>
				<td>{{ Str::limit($realisation->conclusion, 80) ?? '-' }}</td>

--> 

    <h1>{{ $metaTitle }}</h1>
    <p><strong>description :</strong> {!! $realisation->description ?? '—' !!}</p>
    <p><strong>resultat :</strong> {{ $realisation->resultat ?? '—' }}</p>
    <p><strong>conclusion :</strong> {{ $realisation->conclusion }}</p>
	<p><strong>competences :</strong></p>
		<ul>
		@foreach($realisation->competences as $competence)
			<li>
				<a href="{{ route('competences.show', $competence) }}">
					{{ $competence->nom }}
				</a>
			</li>

		@endforeach
	</ul>


	@if($realisation->images->count())
		<div class="gallery">
			@foreach($realisation->images as $image)
			
					<a href="/public/{{ $image->path }}" target="_blank">
						<img src="/public/{{ $image->path }}" alt="{{ $image->filename }}" width="100">
					</a>	
			

			@endforeach
		</div>
	@endif


	@auth
		@if ( Auth::user()->isAdmin() )
			<a href="{{ route('realisations.edit', $realisation) }}">Modifier</a>
		@endif   
	@endauth
    
	
	
    <a href="{{ route('realisations.index') }}">Retour</a>

@endsection