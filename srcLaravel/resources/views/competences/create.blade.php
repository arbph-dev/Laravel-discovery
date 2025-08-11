@php
$keyGOOGLESEARCH = "KEY";
$titre = "Elfennel - Module des compétences"
@endphp

@extends('layouts.pure')

@section('title', 'Elfennel')

@section('description', "Module des compétences")

@section('content')

    <h1>Nouvelle compétence</h1>
    @include('competences._form', ['route' => route('competences.store'), 'method' => 'POST', 'competence' => new \App\Models\Competence()])



@endsection
