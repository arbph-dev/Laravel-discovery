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
    <form action="{{ route('login.store') }}" method="POST">
        @csrf
        <div>
            <label class="auth_form-label" for="email">Email</label>
            <input class="auth_form-field" id="email" name="email"/>
        </div>
        <div>
            <label class="auth_form-label" for="password">Password</label>
            <input class="auth_form-field" id="password" name="password" type="password"/>
        </div>
        <div>                
            <input class="auth_form-submit" type="submit" value="Login"/>
        </div>                
        <div>
            <a class="auth_form-link" href="{{ route('register') }}">Creéer un compte.</a>
        </div>
        <div>                    
            <a class="auth_form-link" href="{{ route('password.request') }}">Mot de passe oublié</a>
        </div>

        <div class="auth_form-error" id="login-form-error">

        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach                
            
        </div>
    </form>
    <!-- end main slot -->

    <x-slot:footer>
        <x-nav.simplefooter/>
    </x-slot>

</x-landpage.auth>
