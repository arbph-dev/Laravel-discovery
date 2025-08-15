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
```blade
<x-nav.link2 href="/organisations" :active="request()->is('organisations')">VAE</x-nav.link2>
```

un autre conpomsant [x-ihm.old-card1](../srcLaravel/resources/views/components/ihm/old-card1.php)
ici un slot unique reçoit le contenu, le slot n'aps pas besoint dêtre nommée
```blade
    <x-ihm.old-card1>
            <h3>Bienvenue {{ Auth::user()->name }}</h3> 
            Tes droits actuels :<b> {{ Auth::user()->role }}</b><br/>
            <input id="card-bt1" name="card-bt1" type="button" value="Modal et Entity"/>
            <input id="card-bt2" name="card-bt2" type="button" value="card-bt2"/>
            <input id="card-bt3" name="card-bt3" type="button" value="card-bt3"/>
            <div id="card1-div1">la card1 div1
            </diV>
    </x-ihm.old-card1>
```

Un composant peut etre employé, comme template, à la place du Layout. Dans ce cas on peut utiliser  plusieurs slot et props
Ici 2 slots sont prévues pour gérer les styles et les scripts
```blade
    <x-slot:style>
        <link rel="stylesheet" href="./public/build/assets/simple_style.css" />	    
    </x-slot>

    <x-slot:script>
        <script src="./public/build/assets/simple_script.js" type="module"></script>
    </x-slot>
```

# Creation
[link2.blade.php](../srcLaravel/resources/views/components/nav/link2.blade.php)

```
@props(['active' => false])
```
on definit une props blade avec @props ,cette props est initialisée avec une valeur par défaut
le controller peut définir les props
```
{{ $attributes->merge(['class' => 'item']) }}
```
on peut affecter les classes CSS, ici la classe item

```
aria-current="{{ $active ? 'page' : 'false' }}
```
gère l'état selon que lien est la page cible => vrai 

```
{{$slot}}
```
le slot permet d'ajouter du contenu plus complet

## A voir
Laracast liens  
