@php
$keyGOOGLESEARCH = "KEY";
$titre = "Elfennel - page principale (template simple)"
@endphp




@extends('layouts.pure')

@section('title', 'Elfennel')

@section('description', "Composant js , Bloc eval")

@section('content')


		<section class="cp_page_section">
            <input id="card-bt3" name="card-bt3" type="button" value="Lire"/>
          
            <hr>

            <div id="CALLOUT_2" class="cp_callout">
                
                <div id="CALLOUT_2_TITRE" class="titre">
                <span>Limite des CWS +</span>
                </div>

                <div id="CALLOUT_2_CONTENT" class="content">
                Les missiles hypersoniques posent un défi considérable. À des vitesses supérieures à Mach 5, les CWS conventionnels, qui sont conçus pour traiter des menaces plus lentes et proches, sont moins susceptibles de réussir l'interception. Même avec des canons à grande cadence de tir, la rapidité de ces missiles dépasse généralement les capacités des CWS actuels, car le temps d'engagement est extrêmement limité.<br/>
                Le missile parcourt environ 17 mètres entre deux tirs du CWS à Mach 5.
                Le CWS effectuera 60 tirs pendant le temps où le missile parcourt 1 km soit 0,6 seconde.
                </div>

            </div>



		</section>

@endsection
