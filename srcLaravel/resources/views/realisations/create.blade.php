@php
$keyGOOGLESEARCH = "AfXsb50qf2vbKIfIt9K4j3AdN6a8WHUaGmDdeHcdN0Q";
$titre = "Elfennel - Module des réalisation"
@endphp

@extends('layouts.pure')

@section('title', $titre)

@section('description', 'création d un enregistrement')

@section('content')

    <h1>Nouvelle réalisation</h1>
    @include('realisations._form', ['route' => route('realisations.store'), 'method' => 'POST', 'realisation' => new \App\Models\Realisation()])


@endsection