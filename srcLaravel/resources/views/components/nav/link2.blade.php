@props(['active' => false])

<a {{ $attributes->merge([
        'class' => 'item'
    ]) }}
   aria-current="{{ $active ? 'page' : 'false' }}">
    {{ $slot }}
</a>