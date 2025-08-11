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

		  <h1 class="cp_page_Titre1">Bienvenue chez Elfennel</h1>

		  <p class="cp_page_paragraphe">
			je vous accueille dans un espace dédié aux <strong>technologies qui me passionnent</strong> :
			<em>informatique, énergie et électrotechnique</em>.
		  </p>

		  <p class="cp_page_paragraphe">
			À travers des <strong>publications techniques et théoriques</strong>, nous partageons des solutions concrètes,
			des retours d’expérience et des méthodes éprouvées.
		  </p>

		  <p class="cp_page_paragraphe">
			Après <strong>7 années de formation</strong> en sciences industrielles, et plus de
			<strong>20 ans d'expérience terrain</strong> dans les secteurs
			<em>industriel, résidentiel, tertiaire et hospitalier</em>, j'ai acquis une vision assez globale
			du métier d'electrotechnicien , une expertise approfondie en maintenance et énergies.
		  </p>

		  <p class="cp_page_paragraphe">
			Mes compétences couvrent la <strong>maîtrise des énergies</strong>, la <strong>maintenance</strong>,
			l’<strong>efficacité énergétique</strong> et la <strong>sécurité des systèmes</strong>.
			
			je réalise actuellement ma vae
			<ul>
				<li><a href="{{ route('organisations.index') }}">Voir les organisations</a></li>
				<li><a href="{{ route('vaeexps.index') }}">Voir les expériences professionnelles</a></li>
				<li><a href="{{ route('realisations.index') }}">Voir les réalisations associées aux  expériences</a></li>
				<li><a href="{{ route('images.index') }}">Voir la galerie d'images</a></li>
				<li><a href="{{ route('competences.index') }}">Voir les compétences</a></li>
			</ul>
			
			
		  </p>



		  <p class="cp_page_signature">
			Merci de votre visite. Ensemble, construisons un avenir plus simple, plus efficace et plus durable.
		  </p>
		</section>

@endsection