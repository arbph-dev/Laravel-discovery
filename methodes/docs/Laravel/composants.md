
```html
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>@yield('title', 'Site')</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="{{ asset('public/build/assets/app.css') }}">

</head>
<body>
  <header>
    <div class="header-left">Site</div>
    <div class="header-center">
      <nav>
        <a href="/">Accueil</a>
        <a href="/about">À propos</a>
        <a href="/contact">Contact</a>
      </nav>
    </div>
    <div class="header-right">
      <button>Recherche</button>
      <button>Connexion</button>
    </div>
  </header>

  <main>
    @yield('content')
  </main>

  <footer>
    &copy; {{ date('Y') }} Site. Tous droits réservés.
  </footer>

  <script src="{{ asset('public/build/assets/app.js') }}"></script>
</body>
</html>
```

exploitation
```blade
  <x-hero
    title="Nos engagements"
    subtitle="Un nouveau souffle pour une tradition responsable."
  />
```
compsoant
```blade
  <div class="hero">
  <h1>{{ $title }}</h1>
  <p>{{ $subtitle }}</p>
</div>
```
