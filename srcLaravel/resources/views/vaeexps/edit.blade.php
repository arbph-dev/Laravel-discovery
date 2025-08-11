@php
$keyGOOGLESEARCH = $keyGOOGLESEARCH ?? 'MONCODE';
$titre = $titre ?? 'Elfennel - page principale (template simple)';
@endphp


@extends('layouts.pure')

@section('title', 'Modifier expérience')

@section('content')
    <h1>Modifier l’expérience</h1>
    <form method="POST" action="{{ route('vaeexps.update', $vaeexp) }}">
        @include('vaeexps._form')
    </form>
@endsection
