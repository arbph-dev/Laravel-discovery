@props(['active' => false])

<a {{ $attributes->merge([
        'class' => ($active ? 'w3-white' : 'w3-black') . ' w3-bar-item w3-button'
    ]) }}
   aria-current="{{ $active ? 'page' : 'false' }}">
    {{ $slot }}
</a>
