@php
    $titre = "Authentification - Register"
@endphp


<x-landpage.auth :titre="$titre" >
    <x-slot:style>
        <link rel="stylesheet" href="./public/build/assets/simple_style.css" />	    
    </x-slot>

    <x-slot:header>
        <x-nav.nullheader/>
    </x-slot>

    <!-- main slot -->
    <form action="{{ route('register.store') }}" method="POST">
    @csrf
        <div>
            <label class="auth_form-label" for="name">Name</label>
            <input class="auth_form-field" id="name" name="name" value="{{ old('name') }}">
        </div>            

        <div>
            <label class="auth_form-label" for="email">Email</label>
            <input class="auth_form-field" id="email" name="email" value="{{ old('email') }}">
        </div>

        <div>
            <label class="auth_form-label" for="password">Password</label>
            <input class="auth_form-field" id="password" name="password" type="password" value="{{ old('password') }}">
        </div>

        <div>
            <label class="auth_form-label" for="password_confirmation">Confirm </label>
            <input class="auth_form-field" id="password_confirmation" name="password_confirmation" type="password" value="{{ old('password_confirmation') }}">
        </div>

        <div>                
            <input class="auth_form-submit" type="submit" value="Submit">
        </div>                
        <div>
            <a href="{{ route('login') }}">Back to login.</a>
        </div>

        <div class="error" id="login-form-error">
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
