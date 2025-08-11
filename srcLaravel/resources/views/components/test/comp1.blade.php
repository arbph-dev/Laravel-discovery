@props(['color' => 'gray'])

<h2 style="color:{{ $color }};">{{ $slot }}</h2>
<p>La couleur : {{ $color }}</p>
