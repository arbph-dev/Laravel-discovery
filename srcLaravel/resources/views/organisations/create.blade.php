@php
$keyGOOGLESEARCH = $keyGOOGLESEARCH ?? 'MONCODE';
$titre = $titre ?? 'Elfennel - page principale (template simple)';
@endphp

@extends('layouts.pure')

@section('title', 'Elfennel')

@section('description', "Module des organisations")

@section('content')

  <h1>Nouvelle organisation</h1>
  <form action="{{ route('organisations.store') }}" method="POST">
    @include('organisations._form')
  </form> 

@endsection
