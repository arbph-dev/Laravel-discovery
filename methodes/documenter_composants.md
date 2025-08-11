Les composants sont assez pertients mais necessitent de bien gérer le passage des variables

# Identification

Les composants sont stockées dans  /resources/views/components
  
Le composant link2.blade.php est stockée dans /resources/views/components/nav

Son chemin complet : /resources/views/components/nav/link2.blade.php   

lescomposants dans /resources/views/components 
commencent par x- 
esnuite le chemin ; les . remplace les / 
le nom de fichier sans .blade.php

ainsi : x-nav.link2
  
# Exploitation

Un composant peut intégrer des informations simple dans les attirubts , les attributs qui peuvent etre affectés par Laravel sont appelées **props**
    
Pour utiliser du contenu plus riche on emploie des slots, les : devant le nom indique qu il s agit d une props
  
Ci dessous : active est une props, le slot contient VAE
```html
<x-nav.link2 href="/organisations" :active="request()->is('organisations')">VAE</x-nav.link2>
```
# Creation
[link2.blade.php](../srcLaravel/resources/views/components/nav/link2.blade.php)

```
@props(['active' => false])
```
on definit une props blade avec @props ,cette props est initialisée avec une valeur par défaut

```
{{ $attributes->merge(['class' => 'item']) }}
```
on peut affecter les classes CSS, ici la classe item

```
aria-current="{{ $active ? 'page' : 'false' }}
```
gère l'état selon que lien est la page cible => vrai 


le slot permet d'ajouter du contenu plus complet

## A voir
Laracast liens  
