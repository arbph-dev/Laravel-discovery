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
