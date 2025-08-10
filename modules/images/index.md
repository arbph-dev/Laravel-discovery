# Module : images

---

## Migration

### table

2 tables servent au module :
- images
- image_realisation

### images
Table principale, elle contient les données propres aux images

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


## Controller ImageController
A ce stade seule la méthode index est implémentée

[ImageController](./images/ImageController.php)


### Notes
La méthode index, utilise la pagination. La pagination requiert une gestion de css à détailler. 
[TODO]


    public function index()
    {
	   $images = Image::orderBy('created_at', 'desc')->paginate(20);
		return view('images.index', compact('images'));
    }


## route 
dans routes/web.php
on inclue le controller : use App\Http\Controllers\ImageController;

route model binding
Route::resource('images', ImageController::class);


## views
seul la vue images/index.blade.php est implémentée
a creer 
_form
edit
create
show


## command artisan

images:sync fichier [Syncimages.php](./images/SyncImages.php)
