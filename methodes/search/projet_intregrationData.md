"Objectif"
Récupérer le JSON des parrainages 2022 depuis data.gouv.fr et l’injecter dans un base via Laravel

# Étapes pour créer une API dans Laravel
## Définir modèle et contrôleur API
- un modèle Parrainage
- une migration (avec seeder ou command pour import) 
- un contrôleur ParrainageController

on part sur l’exemple des parrainages :
```
php artisan make:model Parrainage -mcr
```


## Configurer les routes API

Dans routes/api.php :
```php
use App\Http\Controllers\ParrainageController;

Route::get('/parrainages', [ParrainageController::class, 'index']);
Route::get('/parrainages/{id}', [ParrainageController::class, 'show']);
Route::get('/parrainages/departement/{dep}', [ParrainageController::class, 'byDepartement']);
```

Url :
- https://ton-domaine/api/parrainages
- https://ton-domaine/api/parrainages/123



## Contrôleur

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
// ou mieux
/*
    public function index(Request $request)
    {
        $query = Parrainage::query();

        // Filtres dynamiques
        if ($request->has('candidat')) {
            $query->where('candidat', $request->candidat);
        }
        if ($request->has('departement')) {
            $query->where('departement', $request->departement);
        }
        if ($request->has('region')) {
            $query->where('region', $request->region);
        }

        return response()->json($query->paginate(50));
    }
*/


    public function show($id)
    {
        return response()->json(Parrainage::findOrFail($id));
    }
    /* devient obsolete voir ci dessus */
    public function byDepartement($departement)
    {
        return response()->json(
            Parrainage::where('departement', $departement)->get()
        );
    }
}
```





## Model
Fichier app/Models/Parrainage.php
```php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Parrainage extends Model
{
    protected $fillable = [
        'nom',
        'prenom',
        'candidat',
        'departement',
        'region',
        'fonction',
    ];
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

### Créer un seeder
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
#### 3-2. executer
```
php artisan db:seed --class=ParrainagesSeeder
```


### commande artisan

#### commandes
```
php artisan make:command ImportParrainages => import:parrainages ??
curl -o storage/app/parrainages.json https://static.data.gouv.fr/resources/parrainages-des-candidats-a-lelection-presidentielle-francaise-de-2022/20220307-183354/parrainagestotal.json
php artisan import:parrainages storage/app/parrainages.json
```

#### fichier
app/Console/Commands/ImportParrainages.php
```php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Parrainage;

class ImportParrainages extends Command
{
    protected $signature = 'import:parrainages {file}';
    protected $description = 'Importer les parrainages depuis un fichier JSON';

    public function handle()
    {
        $file = $this->argument('file');

        if (!file_exists($file)) {
            $this->error("Fichier introuvable : $file");
            return 1;
        }

        $this->info("Importation depuis $file ...");

        // Lecture du fichier ligne par ligne
        $handle = fopen($file, 'r');
        $buffer = '';
        $batch = [];

        while (($line = fgets($handle)) !== false) {
            $buffer .= $line;

            // Détection fin du JSON complet (si ton fichier est un tableau unique)
            if (str_ends_with(trim($line), ']')) {
                $json = json_decode($buffer, true);
                foreach ($json as $entry) {
                    $batch[] = [
                        'nom'        => $entry['nom'] ?? '',
                        'prenom'     => $entry['prenom'] ?? null,
                        'candidat'   => $entry['candidat'] ?? '',
                        'departement'=> $entry['departement'] ?? null,
                        'region'     => $entry['region'] ?? null,
                        'fonction'   => $entry['fonction'] ?? null,
                    ];

                    if (count($batch) >= 500) {
                        Parrainage::insert($batch);
                        $batch = [];
                        $this->info("500 entrées importées...");
                    }
                }
            }
        }

        if (!empty($batch)) {
            Parrainage::insert($batch);
        }

        fclose($handle);

        $this->info("✅ Import terminé !");
        return 0;
    }
}
```


## exploitation
Côté JavaScript (WebComponents, fetch)

### fetch

```js
async function getParrainages() {
  const response = await fetch('https://ton-domaine/api/parrainages');
  const data = await response.json();
  console.log(data);
}

getParrainages();

```




```js
fetch('/api/parrainages')
  .then(r => r.json())
  .then(console.log)

```


```js
fetch('/api/parrainages?candidat=Macron')
  .then(r => r.json())
  .then(console.log)

```


```js
fetch('/api/parrainages?departement=29')
  .then(r => r.json())
  .then(console.log)

```


```js
fetch('/api/parrainages?region=Bretagne')
  .then(r => r.json())
  .then(console.log)

```

### WebComponents

```js
class ParrainageList extends HTMLElement {
  async connectedCallback() {
    const res = await fetch('/api/parrainages');
    const data = await res.json();
    this.innerHTML = `
      <ul>
        ${data.data.map(p => `<li>${p.nom} ${p.prenom} (${p.candidat})</li>`).join('')}
      </ul>
    `;
  }
}

customElements.define('parrainage-list', ParrainageList);
```



```js
class ParrainageList extends HTMLElement {
  async connectedCallback() {
    const res = await fetch('/api/parrainages?region=Bretagne');
    const data = await res.json();

    this.innerHTML = `
      <h3>Parrainages en Bretagne</h3>
      <ul>
        ${data.data.map(p => `
          <li>${p.prenom ?? ''} ${p.nom} — ${p.candidat}</li>
        `).join('')}
      </ul>
    `;
  }
}
customElements.define('parrainage-list', ParrainageList);

```
