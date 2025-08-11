@php
$keyGOOGLESEARCH = "AfXsb50qf2vbKIfIt9K4j3AdN6a8WHUaGmDdeHcdN0Q";
$titre = "Elfennel - page principale (template simple)"
@endphp




@extends('layouts.pure')

@section('title', 'Elfennel')

@section('description', "Script , documentation")

@section('content')



		<section class="cp_page_section">
		  <!-- 
		  <blockquote class="cp_page_citation">
			
		  </blockquote> -->

		  <h1 class="cp_page_Titre1">Liste des composants</h1>

		  <p class="cp_page_paragraphe">
			Composants en cours de réalisation : 
            
		  </p>

          <h2 class="cp_page_Titre2">Bloc eval</h2>
            <p class="cp_page_paragraphe">
                Permet d'executer du code js pour le supports de publication à venir.<br/>
                <x-nav.link2 href="/script-cmp-eval" :active="request()->is('script')">cmp-eval</x-nav.link2>
            </p>  


          <h2 class="cp_page_Titre2">Bloc Callout</h2>
            <p class="cp_page_paragraphe">
                Permet de mettre en évidence une partie des publications, pour le supports de publication à venir.<br/>
                <x-nav.link2 href="/script-cmp-callout" :active="request()->is('script-cmp-callout')">cmp-eval</x-nav.link2>
            </p>  

		</section>

@endsection