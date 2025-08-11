@php
    $titre = "Authentification - Login"
@endphp


<x-landpage.auth :titre="$titre" >
    <x-slot:style>
        <link rel="stylesheet" href="./public/build/assets/simple_style.css" />	    
    </x-slot>

    <x-slot:header>
        <x-nav.nullheader/>
    </x-slot>

    <!-- main slot -->
    @if (session('status') == 'verification-link-sent')
        <div>
            Un nouveau lien de vérification a été envoyé à votre adresse e-mail.
        </div>
    @endif
    
    <div>
        <h3>Vérification de l'adresse e-mail</h3>
        <p>Vous devez vérifier votre adresse e-mail pour accéder à cette page.</p>
    </div>
    
    <form method="POST" action="{{ route('verification.send') }}">
        @csrf
        <button class="auth_form-submit" type="submit">Renvoyer l'e-mail de vérification</button>
    </form>
    <!-- end main slot -->

    <x-slot:footer>
        <x-nav.simplefooter/>
    </x-slot>

</x-landpage.auth>
