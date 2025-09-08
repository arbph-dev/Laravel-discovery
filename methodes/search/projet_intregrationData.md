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


# Methode fetch et xhr


## XmlHttpRequest ou fetch
Le code est similaire en terme de longueur

### Fetch
```js
const url = 'https://jsearch.p.rapidapi.com/search?query=developer%20jobs%20in%20chicago&page=1&num_pages=1&country=us&date_posted=all';
const options = {
	method: 'GET',
	headers: {
		'x-rapidapi-key': 'yourkey',
		'x-rapidapi-host': 'jsearch.p.rapidapi.com'
	}
};

try {
	const response = await fetch(url, options);
	const result = await response.text();
	console.log(result);
} catch (error) {
	console.error(error);
}
```



#### XmlHttpRequest
```js
const data = null;

const xhr = new XMLHttpRequest();
xhr.withCredentials = true;

xhr.addEventListener('readystatechange', function () {
	if (this.readyState === this.DONE) {
		console.log(this.responseText);
	}
});

xhr.open('GET', 'https://jsearch.p.rapidapi.com/search?query=developer%20jobs%20in%20chicago&page=1&num_pages=1&country=us&date_posted=all');
xhr.setRequestHeader('x-rapidapi-key', 'yourkey');
xhr.setRequestHeader('x-rapidapi-host', 'jsearch.p.rapidapi.com');

xhr.send(data);
```







### Objet XMLHttpRequest 

- upload object : An XMLHttpRequestUpload object.
- state : One of unsent, opened, headers received, loading, and done; initially unsent.
- send() option argument flag :  A flag, initially unset.
- timeout : An unsigned integer, initially 0.
- cross-origin credentials : A boolean, initially false.
- request method :A method.
- request URL :A URL.
- author request headers :A header list, initially empty.
- request body :Initially null.
- synchronous flag :A flag, initially unset.
- upload complete flag :A flag, initially unset.
- upload listener flag :A flag, initially unset.
- timed out flag : A flag, initially unset.
- response :A response, initially a network error.
- received bytes :A byte sequence, initially the empty byte sequence.
- response type :One of the empty string, "arraybuffer", "blob", "document", "json", and "text"; initially the empty string.
- response object :An object, failure, or null, initially null.
- fetch controller :A fetch controller, initially a new fetch controller. The send() method sets it to a useful fetch controller, but for simplicity it always holds a fetch controller.
- override MIME type :A MIME type or null, initially null. Can get a value when overrideMimeType() is invoked.

-----------------------------------------------------

# Sources Data

SITE CATALOGUE : 
https://www.allthingsdev.co/apimarketplace/endpoints/jsearch/666bdc4af86d656f834184ad
rapidapi


## https://hubeau.eaufrance.fr/page/api-surveillance-littoral

https://www.sandre.eaufrance.fr/v2/

### 1. Lister tous les lieux de surveillance possédant des données de contaminants chimiques :

La paramètre à utiliser est donnees_cc.
 L'URL à interroger est : https://hubeau.eaufrance.fr/api/v1/surveillance_littoral/lieux_surv?donnees_cc=true

Résultat :
objet de objet ??erreur deux { consécutif non vue dans les autres réponse documentés sur le site https://hubeau.eaufrance.fr/page/api-surveillance-littoral

```json
{
  {
  "count": 353,
  "first": "https://hubeau.eaufrance.fr/api/v1/surveillance_littoral/lieux_surv?donnees_cc=true&page=1&size=1000",
  "last": null,
  "prev": null,
  "next": null,
  "api_version": "v1",
  "data": [
    {
      "code_lieusurv": "1001104",
      "libelle_lieusurv": "001-P-022 - Oye plage",
      "mnemo_lieusurv": "001-P-022",
      "ecart_heureTU_lieusurv": 1,
      "prof_lieusurv": -1,
      "coordonnee_x_lieusurv": 2.00455,
      "coordonnee_y_lieusurv": 51.002766,
      "code_projection": "31",
      "type_acquisition_coord": "3",
      "codes_masses_eau": [
        "FRAC02"
      ],
      "noms_masses_eau": [
        "FRAC02 - Jetée de Malo à Est cap Griz nez"
      ],
      "commentaire": "Coordonnées modifiées le 20/09/2019 à la demande du LER/BL validée par les coordinateurs des réseaux concernés car anciennes coordonnées fausses (hors zone d'exploitation des coquillages)   anciennes coordonnées   lat = 51.0024777513, long = 1.9986607303 (positionnement IGN non défini)",
      "date_creation": "1900-01-01T00:00:00Z",
      "date_maj": "2019-09-20T00:00:00Z",
      "date_debut_donnees": "1987-06-29T00:00:00Z",
      "date_fin_donnees": "2021-02-02T00:00:00Z",
      "codes_reseaux": [
        "0000000010",
        "0000000013",
        "0000000014",
        "0000000020",
        "0000000110"
      ],
      "noms_reseaux": [
        "Réseau de contrôle microbiologique des zones de production conchylicoles (REMI)",
        "Réseau de contrôle microbiologique (REMI) - Surveillance",
        "Réseau de Surveillance du Phytoplancton et des Phycotoxines (REPHY)",
        "Réseau National d'Observation de la qualité du milieu marin (RNO) - Matière vivante",
        "Réseau de surveillance du phytoplancton et des phycotoxines (REPHY) -  Toxines"
      ],
      "codes_taxons_suivis": [
        "3432"
      ],
      "noms_taxons_suivis": [
        "Mytilus edulis"
      ],
      "donnees_cc": true,
      "longitude": 2.00455,
      "latitude": 51.002766,
      "geometry": {
        "type": "Point",
        "crs": {
          "type": "name",
          "properties": {
            "name": "urn:ogc:def:crs:OGC:1.3:CRS84"
          }
        },
        "coordinates": [
          2.00455,
          51.002766
        ]
      },
      "uri_reseaux": [
        "https://id.eaufrance.fr/dc/0000000010",
        "https://id.eaufrance.fr/dc/0000000013",
        "https://id.eaufrance.fr/dc/0000000014",
        "https://id.eaufrance.fr/dc/0000000020",
        "https://id.eaufrance.fr/dc/0000000110"
      ],
      "uri_taxons_suivis": [
        "https://id.eaufrance.fr/apt/3432"
      ]
    },
    {
      "code_lieusurv": "1001105",
      "libelle_lieusurv": "001-P-023 - Digue du Braek",
      "mnemo_lieusurv": "001-P-023",
      "ecart_heureTU_lieusurv": 1,
      "prof_lieusurv": null,
      "coordonnee_x_lieusurv": 2.2903323,
      "coordonnee_y_lieusurv": 51.052483,
      "code_projection": "31",
      "type_acquisition_coord": "1",
      "codes_masses_eau": [
        "FRAC02"
      ],
...
...     
}
```









### 2. Restreindre la réponse 
avec seulement les attributs :
- code  => **code_lieusurv**
- libellé du lieu => **libelle_lieusurv**
- date de début => **date_debut_donnees**
- date de fin => **date_fin_donnees**
- codes réseaux suivis **codes_reseaux**
- latitude **latitude**
- longitude **longitude**
- taxons **codes_taxons_suivis**

https://hubeau.eaufrance.fr/api/v1/surveillance_littoral/lieux_surv?donnees_cc=true&fields=code_lieusurv,libelle_lieusurv,date_debut_donnees,date_fin_donnees,codes_reseaux,codes_taxons_suivis,noms_taxons_suivis,longitude,latitude&page=1&size=1000

https://hubeau.eaufrance.fr/api/v1/surveillance_littoral/lieux_surv
?donnees_cc=true
&
fields=code_lieusurv,libelle_lieusurv,date_debut_donnees,date_fin_donnees,codes_reseaux,codes_taxons_suivis,noms_taxons_suivis,longitude,latitude
&
page=1
&
size=1000

on note un seul {
un objet avec les key values , **count** renvoie le nombre de resultat, les autres on peut d'interet à ce stade
- count 
- first
- last
- prev
- next
- api_version

l'objet contient une  proporiété data de type tableau

les données du tableau
- code_lieusurv
- libelle_lieusurv **codifie , extraitre avec (- + espace )!!**
- date_debut_donnees
- date_fin_donnees
- codes_reseaux  **tableau**: a déteminer  **??**
- codes_taxons_suivis
- noms_taxons_suivis tableau
- longitude
- latitude


```json
{
  "count": 353,
  "first": "https://hubeau.eaufrance.fr/api/v1/surveillance_littoral/lieux_surv?donnees_cc=true&fields=code_lieusurv,libelle_lieusurv,date_debut_donnees,date_fin_donnees,codes_reseaux,codes_taxons_suivis,noms_taxons_suivis,longitude,latitude&page=1&size=1000",
  "last": null,
  "prev": null,
  "next": null,
  "api_version": "v1",
  "data": [
    {
      "code_lieusurv": "1001104",
      "libelle_lieusurv": "001-P-022 - Oye plage",
      "date_debut_donnees": "1987-06-29T00:00:00Z",
      "date_fin_donnees": "2021-02-02T00:00:00Z",
      "codes_reseaux": [
        "0000000010",
        "0000000013",
        "0000000014",
        "0000000020",
        "0000000110"
      ],
      "codes_taxons_suivis": [
        "3432"
      ],
      "noms_taxons_suivis": [
        "Mytilus edulis"
      ]
      "longitude": 2.00455,
      "latitude": 51.002766
    },
    {
      "code_lieusurv": "1001105",
      "libelle_lieusurv": "001-P-023 - Digue du Braek",
      "date_debut_donnees": "1991-02-04T00:00:00Z",
      "date_fin_donnees": "1993-04-08T00:00:00Z",
      "codes_reseaux": [
        "0000000020"
      ],
      "codes_taxons_suivis": [
        "3432"
      ],
      "noms_taxons_suivis": [
        "Mytilus edulis"
      ]
    },
    {
      "code_lieusurv": "1001503",
      "libelle_lieusurv": "001-P-071 - Dunkerque 3 S",
      "date_debut_donnees": "1976-12-14T00:00:00Z",
      "date_fin_donnees": "1982-09-14T00:00:00Z",
      "codes_reseaux": [
        "0000000022"
      ],
...
...

```



### 3. lire des données de 2015 :
Le paramètre à utiliser date_donnees. L'URL devient 

https://hubeau.eaufrance.fr/api/v1/surveillance_littoral/lieux_surv?donnees_cc=true&fields=code_lieusurv,libelle_lieusurv,date_debut_donnees,date_fin_donnees,codes_reseaux,codes_taxons_suivis,noms_taxons_suivis,longitude,latitude&date_donnees=2015-01-01&page=1&size=1000"

https://hubeau.eaufrance.fr/api/v1/surveillance_littoral/lieux_surv
?
donnees_cc=true&
fields=code_lieusurv,libelle_lieusurv,date_debut_donnees,date_fin_donnees,codes_reseaux,codes_taxons_suivis,noms_taxons_suivis,longitude,latitude
&
date_donnees=2015-01-01
&page=1
&size=1000"


```json

```

### 4. Définir le périmètre
Maintenant, parmi ces lieux de surveillance, ne conserver que ceux qui se trouvent **dans un cercle de centre -1,8° de longitude et 48,6° de latitude, et de rayon 20 kilomètres**:
Les paramètres à utiliser sont longitude, latitude et distance. L'URL devient : https://hubeau.eaufrance.fr/api/v1/surveillance_littoral/lieux_surv?donnees_cc=true&fields=code_lieusurv,libelle_lieusurv,date_debut_donnees,date_fin_donnees,codes_reseaux,codes_taxons_suivis,noms_taxons_suivis,longitude,latitude&date_donnees=2015-01-01&longitude=-1.8&latitude=48.6&distance=20

https://hubeau.eaufrance.fr/api/v1/surveillance_littoral/lieux_surv
?
donnees_cc=true
&
fields=code_lieusurv,libelle_lieusurv,date_debut_donnees,date_fin_donnees,codes_reseaux,codes_taxons_suivis,noms_taxons_suivis,longitude,latitude
&
date_donnees=2015-01-01
&longitude=-1.8 **longitude**=-1.8
&latitude=48.6  **latitude** =48.6
&distance=20    **distance** = 20

```json
```



### 5. Enfin, nous voulons filtrer sur les réseaux de mesure et ne garder que les lieux faisant partie des réseaux de code 0000000022 ou 0000000011 :

Le paramètres à utiliser est codes_reseaux. On peut mentionner **plusieurs codes réseaux en les séparant par une virgule**. L'URL devient : https://hubeau.eaufrance.fr/api/v1/surveillance_littoral/lieux_surv?donnees_cc=true&fields=code_lieusurv,libelle_lieusurv,date_debut_donnees,date_fin_donnees,codes_reseaux,codes_taxons_suivis,noms_taxons_suivis,longitude,latitude&date_donnees=2015-01-01&longitude=-1.8&latitude=48.6&distance=20&codes_reseaux=0000000022,0000000011

https://hubeau.eaufrance.fr/api/v1/surveillance_littoral/lieux_surv
?donnees_cc=true
&
fields=code_lieusurv,libelle_lieusurv,date_debut_donnees,date_fin_donnees,codes_reseaux,codes_taxons_suivis,noms_taxons_suivis,longitude,latitude
&
date_donnees=2015-01-01
&longitude=-1.8
&latitude=48.6
&distance=20
&codes_reseaux=0000000022,0000000011 **codes_reseaux** =0000000022,0000000011

### 6. contaminants chimiques
 paramètre Fluoranthène (code paramètre Sandre = 1191)
 réalisées sur support Bivalve (code support Sandre = 21) 
 dans un rectangle de coordonnées comprises entre -1,8 et -1,7° de longitude et 48,6 et 48,7° de latitude :

Les paramètres à utiliser sont code_parametre, code_support et bbox. L'URL à interroger est : https://hubeau.eaufrance.fr/api/v1/surveillance_littoral/contaminants_chimiques?bbox=-1.8,48.6,-1.7,48.7&code_parametre=1191&code_support=21&size=100

https://hubeau.eaufrance.fr/api/v1/surveillance_littoral/contaminants_chimiques
?
bbox=-1.8,48.6,-1.7,48.7
&
code_parametre=1191
&
code_support=21
&
size=100

## api-adresse.data.gouv

exemple de requete :  **https://api-adresse.data.gouv.fr/search/?q=8+bd+du+port**
on note les + a la place des espcaes ou pour forcer ET les termes ??
teste : O

Le service renvoie un tableau de données 
type = feature => properties  sinon non ?

    {
      "type": "Feature",
      "geometry": {
        "type": "Point",
        "coordinates": [2.290084, 49.897442]
      },
      "properties": {
        "label": "8 Boulevard du Port 80000 Amiens",
        "score": 0.492194736842105,
        "housenumber": "8",
        "id": "80021_6590_00008",
        "banId": "f2633629-5541-4233-aa54-3c2eb58aa8b9",
        "name": "8 Boulevard du Port",
        "postcode": "80000",
        "citycode": "80021",
        "x": 648952.58,
        "y": 6977867.14,
        "city": "Amiens",
        "context": "80, Somme, Hauts-de-France",
        "type": "housenumber",
        "importance": 0.6773,
        "street": "Boulevard du Port",
        "_type": "address"
      }
    }


### properties
label: The full address including street name, house number, and city.
housenumber: The house number.
id: A unique identifier for the address.
name: The street name.
postcode: The postal code.
citycode: The city code.
x: X-coordinate (longitude) of the address.
y: Y-coordinate (latitude) of the address.
city: The city name.
district: The district or arrondissement.
context: Additional context information (e.g., region).
type: The type of address (e.g., housenumber).
importance: A prediction score indicating the importance of the address (ranging from 0 to 1).


## whois
### https://api.ipapi.is/?q=52.46.64.223
teste : N







##  rapidapi
### api-plaque-immatriculation
a revoir Le code rapidapi api-plaque-immatriculation (tres limité ) , erreur credentials set mais pas de headers  control allow => reponse rejete par le navigateur vu par le servuer

### JOB / https://www.openwebninja.com/api/jsearch
https://rapidapi.com/letscrape-6bRBa3QguO5/api/jsearch/playground/endpoint_73845d59-2a15-4a88-92c5-e9b1bc90956d






