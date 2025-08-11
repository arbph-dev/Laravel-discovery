@php
$keyGOOGLESEARCH = "AfXsb50qf2vbKIfIt9K4j3AdN6a8WHUaGmDdeHcdN0Q";
$titre = "Elfennel - page principale (template simple)"
@endphp




@extends('layouts.pure')

@section('title', 'Elfennel')

@section('description', "Composant js , Bloc eval")

@section('content')


		<section class="cp_page_section">
          <!-- Bloc Eval -->
          <div id="CODEVAL_1" class="cp_codeval">

              <div id="CODEVAL_1_TITRE" class="titre">Eval 1</div>

              <div id="CODEVAL_1_SCRIPTCODE" class="scriptcode">
                  <textarea rows="20" cols="40" placeholder="Entrez votre code JavaScript ici...">const u=12&#13;&#10;const r=20&#13;&#10;const i=u/r&#13;&#10;const z = 'Courant '+ i +' A'&#13;&#10;z&#13;&#10;</textarea>
                 <!--  <button id="executeButton1" name="executeButton1">Exécuter</button> -->
                  <button id="executeButton" name="executeButton" onclick="evaluateCode(1)">Exécuter</button>
              </div>

              <div id="CODEVAL_1_RESULT" class="result">

              </div>

          </div>
		</section>

@endsection