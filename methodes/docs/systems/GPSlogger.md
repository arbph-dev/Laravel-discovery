# Exploiter log du logiciel GPS logger (android)

Les données sont tranmises par mail dans un fichier texte
Le nom du fichier **20250628-113816**.txt correspond au nom assigné au tracé **20250628-113816**

Le mail reçu comporte des informations et statistiques
- GPS Logger - Tracé **20250628-113816**
- 178 Points de tracé
- 0 Annotations

- Distance = 140 m
- Durée = 02:57 | 02:00
- Écart d'altitude = 6 m
- Vitesse Max = 5 km/h
- Vitesse Moy = 2,9 | 4,2 km/h
- Orient. générale = N

Stats de parcours basées sur: Temps total | Temps en mouvement


## Fichier
type,date time,latitude,longitude,accuracy(m),altitude(m),geoid_height(m),speed(m/s),bearing(deg),sat_used,sat_inview,name,desc
T,2025-06-28 09:38:16,47.85001085,-4.208001633,1.18,72.517,,0.923,352,19,29,20250628-113816,GPS Logger: 20250628-113816
T,2025-06-28 09:38:17,47.85001822,-4.208001497,1.09,72.283,,1.051,343,19,29,,

- type : T => on ne traitera que les lignes commençant par T
- date time : 2025-06-28 09:38:16 => on demandera le decalage horaire au point consiféré ici GMT+2
- latitude : 47.85001085
- longitude : -4.208001633
- accuracy(m) : 1.18
- altitude(m) : 72.517
- geoid_height(m) : ,,
- speed(m/s) : 0.923
- bearing(deg) : 352
- sat_used : 19
- sat_inview : 29
- name : 20250628-113816 => ne figure que sur la seconde ligne du fichier, soit la premiere ligne des données
- desc :GPS Logger: 20250628-113816 => ne figure que sur la seconde ligne du fichier, soit la premiere ligne des données

on va devoir gérer
id user : le tracé appartient à un utilisateur, on se limite a l'admin via un middleware **TODO**
l'utilisateur pourra importer plusieurs gpslog => une table gpslog

la table gpslogs contient
- id
- name
- user_id => relation un user has many gpslogs
- description
- date  2025-06-28
- rawfile => path du fichier importé
- tabledata => un nom unique basé sur une chaine : "gpslog"+timestamp pour lire les données importer
- imported => un flag numérique 0 non importe 1 import ok 2 erreur import

chaque import va donc générer une table de données
cette solution devant éviter les traitments et requete complexe sur une base de données
a valider

un module gpslog sera constitué de
- la migration pour créer la table
- un Model Gpslog avec une relation un user has many gpslog
- un Controller qui permettra d'afficher les vues et de gérer l'import 
- l'import se fait dans une table "gpslog"+timestamp
- l'import termine imported est mis a 1 dans la table gpslogs

les vues index, show , create et edit permettront a l'utilsateur de gérer les gpslog
La vue index permettra de lister les gpslogs, une coche permettra de selectionner les parcours à afficher dans show
La vue show devra affiché les parcours selectionné avec Leafletjs
La partie vue sera abordé apres que la structure soit arrété



