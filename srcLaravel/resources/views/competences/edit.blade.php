@php
$keyGOOGLESEARCH = "AfXsb50qf2vbKIfIt9K4j3AdN6a8WHUaGmDdeHcdN0Q";
$titre = "Elfennel - Module des compétences"
@endphp

@extends('layouts.pure')

@section('title', 'Elfennel')

@section('description', "Module des compétences")

@section('content')

    <h1>Modifier la compétence</h1>
    @include('competences._form', [
        'route' => route('competences.update', $competence),
        'method' => 'PUT',
        'competence' => $competence
    ])


@endsection