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


# Helper

DashadminController exploitait initialmeent la methode modelToTable du [TableHelper](./TableHelper.php)
```php        
$table = \App\Helpers\TableHelper::modelToTable($users, \App\Models\User::class, 'users.show');// On doit préparer ici le tableau avec TableHelper 
```

on modifie TableHelper pour exploiter methode modelToTable du helper mais qui sera dapté au model User
```
return self::modelToTable($users, \App\Models\User::class, 'users.show');
```

Le controller DashadminController exploite La methode usersTable 
```php        
$table =\App\Helpers\TableHelper::usersTable($users);// On doit préparer ici le tableau avec TableHelper 
```





