@php
$keyGOOGLESEARCH = "KEY";
$titre = "Elfennel - Module des réalisation"
@endphp

@extends('layouts.pure')

@section('title', 'Elfennel')

@section('description', 'modification d un enregistrement')

@section('content')

    <h1>Modifier la réalisation</h1>
    @include('realisations._form', [
        'route' => route('realisations.update', $realisation),
        'method' => 'PUT',
        'realisation' => $realisation
    ])



@endsection
