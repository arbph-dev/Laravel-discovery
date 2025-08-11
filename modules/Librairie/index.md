# CARTO (app/Lib/Carto)


1- bilan
Le fichier cartoConvers.php contient :
    Des fonctions globales (DMStoDD, etc.)
    Des classes comme CoordWGS84, CoordL93, PseudoMercator, etc.
    Des variables globales pour des constantes de projection
    Des fonctions communes pour les projections Lambert et UTM

2-  Plan de refactorisation

organiser le code en 4 grandes parties pour Laravel : 📁 app/Lib/Carto/
Helpers/GeoUtils.php
	Fonctions comme DMStoDD, constantes, outils divers
Models/CoordWGS84.php
	Classe pour WGS84
Models/CoordL93.php
	Classe pour Lambert 93
Models/PseudoMercator.php
	Classe pour PseudoMercator
Projections/UtmConverter.php	
	Fonctions UTM (avec dépendances partagées)

