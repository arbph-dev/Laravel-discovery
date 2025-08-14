# Gestion ADMIN

## Notes
a amélior css et script
blade documenter diff entre {{ $table }} et	{!! $table !!} 


## Model 
pas de model spécifique mais des dépednances :
- model [User](./users/User.php)
- methode du [\App\Helpers\TableHelper](./TableHelper.php)

## Controller : DashadminController

### methode index

variables passés du controlleur à la vue [dashadmin](./dashadmin.blade.php)
**table** Nécessite [\App\Helpers\TableHelper](./TableHelper.php)

```php
		return view('dashadmin', [
			'usersCount' => $usersCount ,
			'table' => $table ,
			'laravelVersion' => app()->version(),
			'debugMode' => config('app.debug'),	
			'env' => app()->environment()		
			]);
```
