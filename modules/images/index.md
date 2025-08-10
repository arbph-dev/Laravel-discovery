# Module : images

## migration
table : images

        $table->id();
        $table->string('path')->unique();      // ex: images/produits/logo.jpg
        $table->string('filename');            // ex: logo.jpg
        $table->integer('w')->nullable();      // largeur
        $table->integer('h')->nullable();      // hauteur
        $table->string('ext', 10);             // jpg, png, webp...
        $table->string('description')->nullable();
        $table->timestamps();

table image_realisation
        Schema::create('image_realisation', function (Blueprint $table) {
            $table->id();
            $table->foreignId('image_id')->constrained()->onDelete('cascade');
            $table->foreignId('realisation_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });



## model Image

    protected $table = 'images';

    protected $fillable = [
        'filename',
        'path',
        'w',
        'h',
        'ext',
        'alt',
		'description'
    ];

### methodes 
url()


### Relations
	public function realisations()
	{
		return $this->belongsToMany(Realisation::class, 'image_realisation');
	}

## ImageController
[ImageController](./images/ImageController.php)

seul index est implémentée

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
