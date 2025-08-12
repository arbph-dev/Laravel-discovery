Les vues servent à presenter les données, collectés par un controller, en réponse à une requete routée vers une méthode de controller
Le controllerur gère les paramètres de la requetes, réalisent les traitments et recupére les données.
Les données sont transmises par des variables du controller vers la vues


# Mis en oeuvre
les vues sont réalisés de 3 manière
- page html (code complet)
- utilisation de layout template
- utilisation de composant

## page html
blade permet de réaliser l'intégralité de la page en html, en incluant style css et script js

## utilisation de layout
on definit la strucutre de la page dans une vue spéciale placé dans le dossier resources/views/layouts
dans cette strucutre on reserve des sections pour placer les variables et composants

## utilisation de composant
on definit la strucutre de la page dans un composant, les composants sont placés dans le dossier resources/views/components
dans cette strucutre on emploie des props et slot pour placer les variables et contenus.
Un composant opeut intéger d'autres composants

Pour ma part le choix se porte sur l'utilisation des layouts pour la structure et les composants sont inclues dans les layouts.
Les deux solutions fonctionnent.

# Blade
Les vues emploient le langage [blade](https://laravel.com/docs/11.x/blade#introduction) à prendre en main
on peut utiliser du code php dans les vues mais c'est a proscrire

les directives a connaitre sont: 
- les affichage de variables
- les structures de controle
- les directives auth
- les sytnaxes propre au composant et layout

## Affichage 

### Variables

Les variables sont tranmises par les controller, on doit les connaitre pour les employer.
La vue est affecté à une méthode,en consultant le code du controler on retrouve les variables transmises.
Ceci est détaillé dans la documentation des controller

Dans des cas simple ou pour lors d'essais, on peut affecter les variables depuis les routes 

#### Sotie écran "echappée"
Le code ci dessous va convertir le texte pour qu'il ne présente pas de risques de sécurité. C'est la méthode à employer dans la majorité des cas.

```html
<p>data {{ $x}} : {{ $y }}</p>
```

#### Sotie écran "brute"
Le texte de la variable sera incorporé sans être échappé, ceci est parcticulierment utile pour inclure le code html.
Cette pratique expoose a des risques en terme de sécurité et doit être limité au maximum

```html
<p>{!! $name !!}</p>
```

### fonctions et objet PHP
On peut employer des fonctions dans le code blade
- date('Y') => renvoie l'année
- asset('public/build/assets/app.js') => détermine le chemin des ressources (script, style, images, documents)
```html
  <footer>&copy; {{ date('Y') }} Site. Tous droits réservés.</footer>

  <script src="{{ asset('public/build/assets/app.js') }}"></script>
```

### structures de controle

On parcourt souvent des collections les directe @foreach et @endforeach sont utiles

```html
@foreach ($car as $x => $y)

    <p>data {{ $x}} : {{ $y }}</p>

@endforeach
```
On realise des tests et selon le resultat on affiche ou non des elements

```html
  @if (Route::has('logout'))
      <a href="javascript:void(0)" class="sys-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
          Logout
      </a>

      <form id="logout-form" action="{{ route('logout') }}" method="POST">@csrf</form>

  @endif 
```

### Composants
Selon les composant on affecte les variables 
- au props (attributs) du composant 
- au slot qui reçiovent le contenu
#### Composant simple ( sans props ou slot )
Un composant simple sans paramétrage, on l'emploi comme une balise en respectant la syntaxe des composants
- x => composant dans le dossier resources/view/components
- ihm => sous dossier resources/view/components/ihm
- svgban02 => nom du fichier sans les extensions .blade.php
```html
<x-ihm.svgban02/>
```
#### Composant 
Le composant ci dessous est un lien 
sa sytnaxe indique qu'il s'agit du fichier resources/view/components/nav/link2.blade.php
Il dispose de
- props active ; on note : devant active pour indiquer a Laravel qu'il doit ajouter la variable



```html
<x-nav.link2 href="/organisations" :active="request()->is('organisations')">VAE</x-nav.link2>
```

### Layouts
la directive @yield permet d'affecter des constantes ou des variables au section reservé dans le layout
```html
        <div class="Esf_Header_Content">
            <h1>@yield('title', 'Site')</h1>
            <p>@yield('description', 'Site')</p>
        </div>
```

```html
    <title>@yield('title', $pageTitle )</title>
```


## application : bandeau utilisateur

```
@auth
  <a href="{{ route('home') }}" class="sys-item">{{ Auth::user()->name}} :: {{ Auth::user()->role }}</a>
  
  @if (Route::has('logout'))
      <a href="javascript:void(0)" class="sys-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
          Logout
      </a>

      <form id="logout-form" action="{{ route('logout') }}" method="POST">@csrf</form>

  @endif 
@else
  <a href="{{ route('login') }}" class="sys-item">Log in</a>
  @if (Route::has('register'))
    <a href="{{ route('register') }}" class="sys-item">Register</a>
  @endif
@endauth
```



