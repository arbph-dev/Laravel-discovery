Je souahite exploiter des dalles « MNT » livrées par grille, disponible ici https://geoservices.ign.fr/documentation/donnees/alti/rgealti
J'ai besoin d'une zone de 2000 x 2000m pour commencer
Chaque répertoire contient des données, pour un pas de MNT, sous forme de fichiers
RGEALTI_1m pour le pas de 1 m (on verra plus tard )
RGEALTI_5m pour le pas de 5 m (ma priorité )

dans les répertoires on a des fichiers contenant ,chaque dalle « MNT », nommés de la façon suivante : RGEALTI_{ZONE}_{XXXX}_{YYYY}_MNT_{SRC}_{SRV}
ZONE :  FXX France métropolitaine
XXXX : Abscisse en kilomètres du nœud Nord-Ouest de la dalle (4 chiffres).
YYYY : Ordonnée en kilomètres du nœud Nord-Ouest de la dalle (4 chiffres).
SRC : Système de Référence de Coordonnées LAMB93 =  Lambert 93
SRV : Système de Référence Vertical IGN de 1969
exemple : RGEALTI_FXX_0095_6850_MNT_LAMB93_IGN69.asc

en tete de chaque fichier 
on a des champs puis les données en ligne séparé par des espaces
on a ncols colonne par nrows lignes quelque soit le pas 
on connait la position du point NW en haut a gauche avec xllcorner et yllcorner
le pas est précisié par  cellsize (en m )
si une valeur manque on a NODATA_value = -99999

on compte ainsi de 0 à 999 => 1000 points

pour retrouver une coordonnée on utilise
x =  xllcorner + col * cellsize
x =  yllcorner + row * cellsize

ncols        1000
nrows        1000
xllcorner    94997.500000000000
yllcorner    6845002.500000000000
cellsize     5.000000000000
NODATA_value  -99999.00
