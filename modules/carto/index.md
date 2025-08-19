
# service carto

## routage
1. Route::get('/carto', [CartoController::class, 'form']);
2. Route::post('/carto/convert', [CartoController::class, 'convert'])->name('carto.convert');

la route 1 , '/carto' affiche le formulaire via le controller


### Test 
Route::get('/carto-test', [CartoController::class, 'show']);


## controller CartoController
méthode, appellée par le routeur 
- CartoController::form : affiche le formulaire
- CartoController::convert : traite la requete via le service et repond

### CartoController::convert
```php
    public function convert(Request $request, CartoService $carto)
    {
        $deg = $request->input('deg');
        $min = $request->input('min');
        $sec = $request->input('sec');
        $lon = (float) $request->input('lon');
        $lat = (float) $request->input('lat');

        $dd = $carto->convertDMStoDD($deg, $min, $sec);
        $wgs = $carto->createWGS84($lon, $lat);
        $lambert = $carto->convertToLambert93($wgs);

        return response()->json([
            'dd' => number_format($dd, 6),
            'lambert' => $lambert->toString(),
        ]);
    }
```	



## Vues

### vue form
une vue form est appelé par CartoController::form

#### formulaire 
5 champs : 
- deg : nombre
- min : nombre
- sec : nombre
- lon : text
- lat : text


action : route('carto.convert')


```blade
<form id="cartoForm" method="POST" action="{{ route('carto.convert') }}">
    @csrf

    <label>Degrés: <input type="number" name="deg" required></label>
    <label>Minutes: <input type="number" name="min" required></label>
    <label>Secondes: <input type="number" name="sec" required></label>

    <label>Longitude (DD): <input type="text" name="lon" required></label>
    <label>Latitude (DD): <input type="text" name="lat" required></label>

    <button type="submit">Convertir</button>
</form>

<div id="result"></div>
```

#### script xhr 
```html
<script>
document.getElementById('cartoForm').addEventListener('submit', async function(e) {
    e.preventDefault();

    const formData = new FormData(this);

    const response = await fetch(this.action, {
        method: 'POST',
        body: formData
    });

    const data = await response.json();

    document.getElementById('result').innerHTML = `
        <strong>Angle en degrés décimaux :</strong> ${data.dd}<br>
        <strong>Coordonnées Lambert93 :</strong> ${data.lambert}
    `;
});
</script>
```

---

# evolutions
## 2025-08-19
la sortie texte actuelle affiche 	:
```
Angle en degrés décimaux : 45.762500
Coordonnées Lambert93 : Coordonnées CoordL93 : 794,064.81 : 6,714,037.06 	
```

Modification 
-  afficher les nombres sans les , la fonction a modifier CoordL93::toString
-  convertir les nombres CoordL93.x ($this->x) CoordL93.y ($this->y) en tableaux json  L93 : [x,y]

Modifier CoordL93::toString()
```php
public function toString()
{
//	return 'Coordonnées CoordL93 : ' . number_format($this->x, 2) . ' : ' . number_format($this->y, 2);
// Le troisième paramètre est le séparateur de milliers, mettre '' pour rien
 return 'Coordonnées CoordL93 : ' . number_format($this->x, 2, '.', '') . ' : ' . number_format($this->y, 2, '.', '');
}
```

Ajouter CoordL93::toArray()
```php
// Nouvelle méthode pour JSON
public function toArray()
{
    return [
        'x' => round($this->x, 2),
        'y' => round($this->y, 2)
    ];
}
```	

Modifier script
```js	
	document.getElementById('result').innerHTML = `
    <strong>Angle en degrés décimaux :</strong> ${data.dd}<br>
    <strong>Coordonnées Lambert93 :</strong> ${data.lambert}<br>
    <strong>Tableau L93 :</strong> [${data.L93.x}, ${data.L93.y}]
`;
```
