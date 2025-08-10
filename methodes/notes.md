# interaction php -> js

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
