@php
$keyGOOGLESEARCH = "AfXsb50qf2vbKIfIt9K4j3AdN6a8WHUaGmDdeHcdN0Q";
$titre = "Module des organisations";
@endphp

@extends('layouts.pure')

@section('title', $titre )

@section('description', $titre )

@section('content')

  <h1>Organisations</h1>
	@auth
	  @if (Auth::user()->role === 'admin')
            <div class="cp_tooltip">
				<a class="cp_tooltip" href="{{ route('organisations.create') }}" >Ajouter une organisation</a>
                <span class="tooltiptext">Ajouter une organisation, employeur ou client</span>
            </div>

            <div class="cp_tooltip">
				<a class="cp_tooltip" href="{{ route('vaeexps.index') }}" >Expériences professionnelles</a>
                <span class="tooltiptext">Voir les expériences professionnelles</span>
            </div>
	  @endif   
	@endauth
	
	<br/>
	
	<table>
		<thead>
			<tr>
				<th>Organisation</th>
				<th>Localisation</th>
				<th>Activité</th>
				<th>Expériences</th>
			</tr>
		</thead>
		<tbody>

		@foreach($organisations as $org)
			<tr>
				<td>
					<div class="cp_tooltipTitle">
						<a href="{{ route('organisations.show', $org) }}">
							@if($org->pich)
								<img src="{{ asset($org->pich) }}" alt="Image {{ $org->lbl }}" style="width:100px">
							@else
								<h2>{{ $org->lbl }}</h2>
							@endif								
						</a>
						<span class="tooltiptext">Voir le détail de l'organisation</span>
					</div> 					
				</td>

				<td>
					<strong>{{ $org->adville }}</strong> ({{ $org->addep }})
				</td>
				
				<td style="width:400px">
					<strong>APE :</strong> {{ $org->codeape }} 
					<br/>
					{{ $org->lblape }}
				</td>
				
				<td>
				@if($org->vaeexp->isNotEmpty())
					<ul>
						@foreach($org->vaeexp as $exp)
							<li>
								<a href="{{ route('vaeexps.show', $exp) }}">
									{{ $exp->fonction }}
								</a> - {{ $exp->getDureeAttribute() }} mois
							</li>
						@endforeach
					</ul>
				@endif	
				</td>
				
			</tr>	

		@endforeach

		</tbody>
	</table>

@endsection
