# protocole NMEA des GPS 
La version du protocole NMEA qui nous intéresse est la version NMEA-0183. Les trames transmises par les GPS, le sont sous forme de chaine texte ASCII. 

Ces chaines sont formatées de la manière suivante :
- Le premier caractère de toutes les trames est toujours $.
- Suivent deux caractères qui identifient l’émetteur : GP pour GPS.
- Ensuite trois lettres servent à identifier la trame émises par l’émetteur : RMC, GGA, GSA…
- Suivent les champs de données séparés par des virgules.
- En fin de trames on trouve une somme de contrôle ou contrôle de redondance cyclique.
- La chaine se termine par la suite des deux caractères retour chariot et saut de ligne (CR/LF)

Quelques précisions :  
- une trames ne peut excéder 82 caractères $ et CR/LF compris
- si un champ de données n’est pas connu par l’émetteur il est simplement omis mais les virgules sont transmises
- la somme de contrôle se trouve après le caractère *, elle est transmise sous forme de hexadécimale.

## une trame.

$GPGGA,103156.000,4845.3506,N,00722.6379,E,1,08,0.9,180.8,M,47.9,M,,0000*57
- GP identifie un récepteur GPS.
- GGA Mesure de position GPS
- 103156.000 indique l’heure de la mesure au format UTC, temps universel
- 4845.3506,N représente la valeur de la latitude : 48° 45.3506 minutes Nord
- 00722.6379,E donne la longitude : 7° 22.6379 minutes E
- 1 nous renseigne sur la qualité de la mesure, 0 inexploitable, 1 GPS et 2 DGPS
- 08 permet de connaitre le nombre de satellites utilisés pour cette mesure
- 0.9 est une indication sur la précisons de la mesure horizontale
- 180.8,M indique l’altitude du point de mesure par rapport au niveau de la mer.
- 47.9,M renvoie l’altitude au niveau de la mer selon l’ellipsoïde WGS84 pour le point de mesure
- Le champ vide est le temps écoulé depuis la dernière mesure DGPS
- 0000 est l’ID de la station DGPS.
- 57 est la somme de contrôle.

Le calcul du checksum est relativement simple. On lit la chaine de caractère, caractères par caractères ; immédiatement après le $ et avant le *.

- on lit le code ASCII associé à la première lettre après $,
  - La première lettre est convertit
  - on stocke cette valeur.

- De la seconde à la dernière lettre avant le *
  - on lit le code ASCII
  - on fait un XOR entre la valeur convertie et la valeur stockée précédemment
  
N’oubliez pas que le CRC est transmis sous forme hexadécimale

Si vous contrôlez l’intégrité des données il faudra transformer la chaine hexadécimale en nombre et le comparer à la valeur de CRC calculée.
