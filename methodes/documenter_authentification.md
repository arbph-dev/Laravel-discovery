# Authentification



## Vues blade

On peut afficher des informations relatives à l'authentification avec quelques commandes blade
```php
<h3>Bienvenue {{ Auth::user()->name }}</h3> 
Tes droits actuels :<b> {{ Auth::user()->role }}</b><br/>
```

On peut restreindre certains elements de navigation aux utilisateurs anonymes sou ne disposant pas des droits nécessaires

Ici on gere le bouton, uniquement le bouton. Il faudra **ABSOLUMENT** en passer par un middleware pour protéger la route

```php 
@auth
    @if (Auth::user()->role === 'admin')
    <a href="{{ route('organisations.create') }}">Ajouter</a>
    @endif   
@endauth
```

Note : Ici le model User propose un méthode isAdmin()

```php 
 @auth
		@if ( Auth::user()->isAdmin() )
			<a href="{{ route('realisations.edit', $realisation) }}">Modifier</a>
		@endif   
	@endauth
```
