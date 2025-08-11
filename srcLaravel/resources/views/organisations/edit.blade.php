@php
$keyGOOGLESEARCH = $keyGOOGLESEARCH ?? 'MONCODE';
$titre = $titre ?? 'Elfennel - page principale (template simple)';
@endphp

@extends('layouts.pure')

@section('title', 'Elfennel')

@section('description', "Module des organisations")

@section('content')

  <h1>Modifier {{ $organisation->nom }}</h1>
  <form action="{{ route('organisations.update', $organisation) }}" method="POST">
    @include('organisations._form')
  </form> 

@endsection
