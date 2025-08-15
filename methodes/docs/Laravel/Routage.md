# Routage

une route exploite un controlleur , BIEN PENSER a importer les controller dans web.php
```php
use App\Http\Controllers\VaeexpController;

Route::resource('vaeexps', VaeexpController::class);
```

# middleware
a definir sur toutes les routes sensibles create,edit,delete

