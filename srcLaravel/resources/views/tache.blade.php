@php
    $keyGOOGLESEARCH = "AfXsb50qf2vbKIfIt9K4j3AdN6a8WHUaGmDdeHcdN0Q";
    $titre = "Elfennel - Tâches"
@endphp


@extends('layouts.pure')

@section('title', 'Tache v0.1')

@section('description', 'On repasse par les templates plutot que les composants')

@section('content')


@foreach ($car as $x => $y)

    <p>data {{ $x}} : {{ $y }}</p>

@endforeach

@endsection