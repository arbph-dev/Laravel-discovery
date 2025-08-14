# Vues
Une evolution s'impose dans la gestion des vues des réaisations

actuellement 
- on prépare la réalisation, on rédige le texte et on retrouve les médias
- on crée la relaisation dans l'applicatif
- on colle le code html

## Template html
```html
<div class="textimgr">
	<div class="text-content" >
		<h2></h2>
		<p>
			<b>capacité d’échange</b>
			<br><br>
			
			<ul>
			<li></li>
			<li></li>
			<li></li>
			</ul>

		</p>
	</div>
	
	<div class="img-content" >
		<a href="" target="_blank">
			<img src="">
		</a>
		<a href="" target="_blank">
			<img src="">
		</a>
		<a href="" target="_blank">
			<img src="">
		</a>


		
	</div>
</div>
```
----
# Controller et formulaire

## Combo multi-sélection
pour associer des images à une réalisation ou utilise une chaine d'id

On pourrait remplacer la chaîne d’IDs séparés par ; par un <select multiple> qui renvoie un tableau d’IDs.
Plus simple à gérer et plus propre en Laravel. 

=> Modifier RealisationController@store et  @update :
```php
$realisation->save();

// Gestion des images associées (table pivot)
$imagesIds = $request->input('images_ids', []);
if (!empty($imagesIds)) {
    $realisation->images()->sync($imagesIds);
} else {
    $realisation->images()->sync([]); // aucune image
}
```

Dans le formulaire realisation._form :

**$images** est une liste complète d’images passée depuis le contrôleur.
=> Modifier RealisationController@create et @edit pour passer la variable **$images**
```blade
<div>
    <label for="images_ids">Images associées :</label>
    <select name="images_ids[]" id="images_ids" multiple size="10">
        @foreach($images as $img)
            <option value="{{ $img->id }}" 
                @if(isset($realisation) && $realisation->images->contains($img->id)) selected @endif>
                {{ $img->filename }} [{{ $img->id }}]
            </option>
        @endforeach
    </select>
</div>
```




