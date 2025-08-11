@php
$keyGOOGLESEARCH = "AfXsb50qf2vbKIfIt9K4j3AdN6a8WHUaGmDdeHcdN0Q";
$titre = "Elfennel - page principale (template simple)"
@endphp




@extends('layouts.pure')

@section('title', 'Elfennel')

@section('description', "L'efficacité naît de la simplicité. Ce sont les solutions les plus simples qui fonctionnent durablement.")

@section('content')


		<section class="cp_page_section">
		  <!-- 
		  <blockquote class="cp_page_citation">
			
		  </blockquote> -->

		  <h1 class="cp_page_Titre1">Dashboard {{ Auth::user()->name }}</h1>

		  <p class="cp_page_paragraphe">
			Bienvenue sur votre page d'Accueil.
			<br/>
            Modules : <x-nav.link2 href="/organisations" :active="request()->is('organisations')">Organisations</x-nav.link2>

		  </p>



		</section>

@endsection