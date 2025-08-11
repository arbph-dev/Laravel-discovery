@php
$keyGOOGLESEARCH = "AfXsb50qf2vbKIfIt9K4j3AdN6a8WHUaGmDdeHcdN0Q";
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