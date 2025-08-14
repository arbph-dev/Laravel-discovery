ajout de vue dans resources/views/three.blade.php

ajout d'une route three pour essai threejs

```php
Route::get('/three', function () {  return view('three');});
```

On ajoute le lien dans le menu => welcome.blade.php

welcome.blade.php exploite le layout/pure.blade.php

<x-nav.link2 href="/organisations" :active="request()->is('organisations')">VAE</x-nav.link2>
remplacé par 
<x-nav.link2 href="/three" :active="request()->is('three')">Threejs</x-nav.link2>

on prévoit de reprndre le code existant comme la classe TerranGenerator dans C:\wamp64\www\W3D5\js\modules\3js\3jsMNT.js
