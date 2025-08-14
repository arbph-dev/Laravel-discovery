# carto


2025-08-08 : essai concluant
**resultat** 
conforme essai avec les coordonnées de la citadelle de port louis releve en 2009
voir I:\VAE\CARTO\projet2.JPG

**conclusion** 

le service permet de gérer les librairies, ici on a regrouper les différentes librairies pour les employer dans un controller
CartoController


## fichiers

routes/web.php modifié 3 roues ajoutées

app\Http\Controllers\CartoController.php

[GeoUtils](./CARTO/app/Lib/Carto/Helpers/GeoUtils.php)
[CoordL93](./CARTO/app/Lib/Carto/Models/CoordL93.php)
[CoordWGS84](./CARTO/app/Lib/Carto/Projections/UtmConverter.php)
[PseudoMercator](./CARTO/app/Lib/Carto/Models/PseudoMercator.php)
[UtmConverter](./CARTO/app/Lib/Carto/Projections/UtmConverter.php)

app\Services\CartoService.php

views\carto\form.blade.php


## Migrations Model et services
aucun fichiers de migration ou de model pour le moment

le traitement se fait par un **Service** voir [CartoService](./CARTO/app/Services/CartoService.php)
Le service emploie des librairies :
- app\Lib\Carto\Helpers\GeoUtils.php :[GeoUtils](./CARTO/app/Lib/Carto/Helpers/GeoUtils.php)
- app\Lib\Carto\Models\CoordL93.php : [CoordL93](./CARTO/app/Lib/Carto/Models/CoordL93.php)
- app\Lib\Carto\Models\CoordWGS84.php : [CoordWGS84](./CARTO/app/Lib/Carto/Models/CoordWGS84.php)
- app\Lib\Carto\Models\PseudoMercator.php : [PseudoMercator](./CARTO/app/Lib/Carto/Models/PseudoMercator.php)
- app\Lib\Carto\Projections\UtmConverter.php : [UtmConverter](./CARTO/app/Lib/Carto/Projections/UtmConverter.php)

## CartoController

[CartoController](./CARTO/app/Http/Controllers/CartoController.php)
il utilise le service [CartoService](./CARTO/app/Services/CartoService.php)

use App\Services\CartoService;




## Vues
uen seule vue à ce stade



## routes :
formulaire + traitement requete et reponse 
'/carto', [CartoController::class, 'form']);
'/carto/convert', [CartoController::class, 'convert'])->name('carto.convert');

- formulaire converti un DMS en DD
- formulaire converti lon, lat DD vers L93

**TODO** séparer les deux et donner des détails

'/carto-test', [CartoController::class, 'show']);
- test ok mais des, au lieu des espaces 
**TODO** essai sans conversion to string CartoController l25 / 26 
a défaut prévori methode retournant array de nombre float




evolution gestion de POI
conversion de fichiers
