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

[GeoUtils](../srcLaravel/app/Lib/Carto/Helpers/GeoUtils.php)
[CoordL93](../srcLaravel/CARTO/app/Lib/Carto/Models/CoordL93.php)
[CoordWGS84](../srcLaravel/CARTO/app/Lib/Carto/Projections/UtmConverter.php)
[PseudoMercator](../srcLaravel/CARTO/app/Lib/Carto/Models/PseudoMercator.php)
[UtmConverter](../srcLaravel/CARTO/app/Lib/Carto/Projections/UtmConverter.php)

app\Services\CartoService.php

views\carto\form.blade.php


## Migrations Model et services
aucun fichiers de migration ou de model pour le moment

le traitement se fait par un **Service** voir [CartoService](../srcLaravel/app/Services/CartoService.php)
Le service emploie des librairies :
- app\Lib\Carto\Helpers\GeoUtils.php :[GeoUtils](../srcLaravel/app/Lib/Carto/Helpers/GeoUtils.php)
- app\Lib\Carto\Models\CoordL93.php : [CoordL93](../srcLaravel/app/Lib/Carto/Models/CoordL93.php)
- app\Lib\Carto\Models\CoordWGS84.php : [CoordWGS84](../srcLaravel/app/Lib/Carto/Models/CoordWGS84.php)
- app\Lib\Carto\Models\PseudoMercator.php : [PseudoMercator](../srcLaravel/app/Lib/Carto/Models/PseudoMercator.php)
- app\Lib\Carto\Projections\UtmConverter.php : [UtmConverter](../srcLaravel/app/Lib/Carto/Projections/UtmConverter.php)

## CartoController

[CartoController](../srcLaravel/app/Http/Controllers/CartoController.php)
il utilise le service [CartoService](../srcLaravel/app/Services/CartoService.php)

use App\Services\CartoService;




## Vues
uen seule vue à ce stade



## routes :
formulaire + traitement requete et reponse pour conversion
- un DMS en DD
- lon, lat DD vers L93

- '/carto', [CartoController::class, 'form']);
- '/carto/convert', [CartoController::class, 'convert'])->name('carto.convert');
- '/carto-test', [CartoController::class, 'show']);
  test ok mais des, au lieu des espaces => essai sans conversion to string CartoController l25 / 26 , a défaut prévoir methode retournant array de nombre float


**TODO**
- séparer les deux formulaire DMS -> DD et L93
- donner des détails





evolution gestion de POI
conversion de fichiers
