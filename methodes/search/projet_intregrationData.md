"Objectif"
Récupérer le JSON des parrainages 2022 depuis data.gouv.fr et l’injecter dans un base via Laravel

# Étapes pour créer une API dans Laravel
1. Définir modèle et contrôleur API
- un modèle Parrainage
- une migration (avec seeder ou command pour import) 
- un contrôleur ParrainageController

Si on part sur l’exemple des parrainages :
```
php artisan make:model Parrainage -mcr
```


2. Configurer les routes API

Dans routes/api.php :
use App\Http\Controllers\ParrainageController;

Route::get('/parrainages', [ParrainageController::class, 'index']);
Route::get('/parrainages/{id}', [ParrainageController::class, 'show']);
Route::get('/parrainages/departement/{dep}', [ParrainageController::class, 'byDepartement']);


https://ton-domaine/api/parrainages
https://ton-domaine/api/parrainages/123



3- Contrôleur

Dans app/Http/Controllers/ParrainageController.php

```php
namespace App\Http\Controllers;

use App\Models\Parrainage;
use Illuminate\Http\Request;

class ParrainageController extends Controller
{
    public function index()
    {
        return response()->json(Parrainage::paginate(50));
    }

    public function show($id)
    {
        return response()->json(Parrainage::findOrFail($id));
    }

    public function byDepartement($departement)
    {
        return response()->json(
            Parrainage::where('departement', $departement)->get()
        );
    }
}
```







## import
2 possibilitées 
- Seeder (petits fichiers) 
- Artisan command (gros volumes)

Téléchargement
- mettre le fichier json dans storage/app/data/parrainages.json (offline)
- soit pointer directement vers l’URL 
mieux vaut le stocker ?

1. Créer une table dédiée

Par exemple parrainages :
```php
php artisan make:migration create_parrainages_table
```

2- Migration
```php
Schema::create('parrainages', function (Blueprint $table) {
    $table->id();
    $table->string('candidat')->nullable();
    $table->string('civilite')->nullable();
    $table->string('nom')->nullable();
    $table->string('prenom')->nullable();
    $table->string('mandat')->nullable();
    $table->string('fonction')->nullable();
    $table->string('commune')->nullable();
    $table->string('departement')->nullable();
    $table->string('region')->nullable();
    $table->date('date_parrainage')->nullable();
    $table->timestamps();
});

```
**voir autre commande pour etat, avant migration** 
**Nom de fichier migration a ajouter**
```php
php artisan migrate
```

3. Créer un seeder
```
php artisan make:seeder ParrainagesSeeder
```

3-1. editer
database/seeders/ParrainagesSeeder.php

```php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ParrainagesSeeder extends Seeder
{
    public function run(): void
    {
        // Charger le fichier JSON (soit local, soit URL avec file_get_contents)
        $json = File::get(storage_path('app/data/parrainages.json'));
        $parrainages = json_decode($json, true);

        foreach ($parrainages as $item) {
            DB::table('parrainages')->insert([
                'candidat'       => $item['candidat'] ?? null,
                'civilite'       => $item['civilite'] ?? null,
                'nom'            => $item['nom'] ?? null,
                'prenom'         => $item['prenom'] ?? null,
                'mandat'         => $item['mandat'] ?? null,
                'fonction'       => $item['fonction'] ?? null,
                'commune'        => $item['commune'] ?? null,
                'departement'    => $item['departement'] ?? null,
                'region'         => $item['region'] ?? null,
                'date_parrainage'=> !empty($item['date_parrainage']) 
                                    ? date('Y-m-d', strtotime($item['date_parrainage'])) 
                                    : null,
            ]);
        }
    }
}
```
3-2. executer
```
php artisan db:seed --class=ParrainagesSeeder
```

