# Module : images

---

## Migration

### table

2 tables servent au module :
- images
- image_realisation


### images
Table principale, elle contient les données propres aux images
migration : [migration 1](../..//srcLaravel/database/migrations/2025_07_09_155455_create_images_table.php)

les champs : 
- id
- path
- filename
- w
- h
- ext
- description
- timestamps

###  image_realisation
Table pivot

les champs : 
- id
- image_id
- realisation_id
- timestamps

---
## Model Image

les propriétés : **table** et **fillable**  sont définies

### Notes
Une méthode **url** permet de gérer l'arborescence pour la créations des liens


### Relations
- imgage et realisations
De type belongsToMany : une image peut appartenir à plusieurs realisations

---
## Controller ImageController
A ce stade seule la méthode index est exploité, les autres sont implémentées
[ImageController](../../srcLaravel/app/Http/Controllers/ImageController.php)



### Notes
La méthode index, utilise la pagination.

[TODO] La pagination requiert une gestion de css à détailler.

Le controleur charge les entités par le biais du Model Image, les trie et les pagine avant de les transmettre aux vues.


---
## route 
Le controller, ImageController
- inclu le model pour accéder au données
```php
use App\Models\Image;
```
- est inclu dans routes/web.php.
```php
use App\Http\Controllers\ImageController;
```
Les routes sont gérées en Route Model Binding.
```php
Route::resource('images', ImageController::class);
```

---
## views
Seule la vue index est implémentée

[TODO] Reste à créer : 
- _form
- edit
- create
- show

---

## command artisan
Pour gérer les images j'ai choisi de les importer en deux temps
- upload des images vers le serveur
- execution du script artisan via SSH

[TODO] Documenter l'usage d'artisan
- creation Model -mcr
- Visualisation des routes

---
Utilisation :
- https://elfennel.fr/images via la route GET /images/index , le controller 



