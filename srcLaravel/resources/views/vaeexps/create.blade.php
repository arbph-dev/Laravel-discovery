@php
$keyGOOGLESEARCH = $keyGOOGLESEARCH ?? 'MONCODE';
$titre = $titre ?? 'Elfennel - page principale (template simple)';
@endphp


@extends('layouts.pure')

@section('title', 'Nouvelle expérience')

@section('content')
    <h1>Créer une expérience</h1>
    <form method="POST" action="{{ route('vaeexps.store') }}">
        @include('vaeexps._form', ['organisationId' => request('organisation_id')])
    </form>

@endsection
