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
    <form action="{{ route('password.email') }}" method="POST">
        @csrf
        <div>
            <label class="auth_form-label" for="email">Email</label>
            <input class="auth_form-field" id="email" name="email" value="{{ old('email') }}">
        </div>
        <input class="auth_form-submit" type="submit" value="Submit">
        <div>
            <a class="auth_form-link" href="{{ route('login') }}">Back to login.</a>
        </div>
        @foreach ($errors->all() as $error)
        <div class="auth_form-error">
            <p>{{ $error }}</p>
        </div>
        @endforeach
    </form>
    <!-- end main slot -->

    <x-slot:footer>
        <x-nav.simplefooter/>
    </x-slot>

</x-landpage.auth>
