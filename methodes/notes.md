# Laravel
## Gestion d'erreur

💡 Bonne pratique :
Utiliser sans @ pendant le développement pour voir les erreurs.
Et si on veut éviter d'afficher les warnings en production, on supprime le @ et on encapsule dans un try...catch ou un test file_exists() avant d’appeler getimagesize() :

```php
$imageSize = @getimagesize($destinationPath . '/' . $finalName);
```
Le @ supprime l’affichage des warnings PHP.

Si le fichier n’est pas une image valide ou introuvable, getimagesize() déclenche normalement un warning (Warning: getimagesize(): ...).
Avec @, ce warning est silencieusement ignoré. $imageSize sera alors false si ça échoue.

```php
$imageSize = getimagesize($destinationPath . '/' . $finalName);
```
Ici, aucune suppression des warnings : si le fichier n’est pas une image, PHP affiche un warning.

C’est plus sûr en développement car ça t’avertit si quelque chose cloche (fichier corrompu, mauvais chemin, etc.).

---

# BLADE : interaction php -> js

## Transferer des données au script du navigateur

🧠 Depuis le contrôleur

On prépare une variable **infos** que l'on passera à la vue (index,show...) dans une méthode

```php
$infos = [
    'user_id' => auth()->id(),
    'realisation_id' => $realisation->id,
    'csrf_token' => csrf_token(),
    'parts' => $realisation->parts->pluck('titre'),
];
```

🧠 Dans la vue Blade :

La variable est converti en json puis incorporé dans le code javascript
```js
<script>
    const appData = @json($infos);
    console.log(appData);
    // Tu peux utiliser appData.user_id, appData.parts etc.
</script>
```

# CSS

## les palettes

### psychométrie

couleurs et signification : https://www.therapistsitetoolbox.com/blog/color-palette-private-practice-website
trois couleurs :
bleu  : #b8ccf8 , #004fff , #00226d


cinq couleur
https://medium.com/@kornferryinstitute/visualizations-for-the-color-blind-or-the-black-and-white-printer-247a8d1dfda9
bleu  : #fafafa ; #c0d8fb ; #77a9e2 ; #0071b5 ; #003a69
