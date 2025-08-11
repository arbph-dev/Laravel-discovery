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
    <form action="{{ route('password.update') }}" method="POST">
        @csrf
        <input name="token" type="hidden" value="{{ request('token') }}">
        <div>
            <label class="auth_form-label" for="email">Email</label>
            <input class="auth_form-field" id="email" name="email" readonly value="{{ request('email') }}">
        </div>
        <div>
            <label class="auth_form-label" for="password">Password</label>
            <input class="auth_form-field" id="password" name="password" type="password" value="{{ old('password') }}">
        </div>
        
        <div>
            
            <label class="auth_form-label" for="password_confirmation">Confirm Password</label>
            
            <input 
                class="auth_form-field"
                id="password_confirmation"
                name="password_confirmation"
                type="password"
                value="{{ old('password_confirmation') }}">

        </div>
        
        <input class="auth_form-submit" type="submit" value="Submit">
        
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
