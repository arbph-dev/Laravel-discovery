

# recherche


## Vaeexp (model) - relations

```php
    public function organisation()
    {
        return $this->belongsTo(Organisation::class);
    }
	
	public function realisations()
	{
		return $this->hasMany(Realisation::class);
	}	

```

---



## VaeexpController  methode index : 

```php
	public function index(Request $request)
	{
		$query = Vaeexp::with(['organisation', 'realisations.client', 'realisations.competences'])
			->orderByDesc('dd');

		$q = $request->input('q');
		$organisationId = $request->input('organisation_id');
		$competenceId = $request->input('competence_id');

		// Récupération brute
		$vaeexps = $query->get();

		// Filtrage après chargement
		if ($q || $organisationId || $competenceId) {
			$vaeexps = $vaeexps->map(function ($vaeexp) use ($q, $organisationId, $competenceId) {
				$filtered = $vaeexp->realisations->filter(function ($real) use ($q, $organisationId, $competenceId) {
					if ($organisationId && $real->organisation_id != $organisationId) {
						return false;
					}

					if ($q && !str_contains(strtolower($real->titre . $real->description . $real->resultat), strtolower($q))) {
						return false;
					}

					if ($competenceId && !$real->competences->contains('id', $competenceId)) {
						return false;
					}

					return true;
				});

				$vaeexp->setRelation('realisations', $filtered);
				return $vaeexp;
			})->filter(function ($vaeexp) {
				return $vaeexp->realisations->isNotEmpty();
			});
		}

		$organisations = Organisation::orderBy('lbl')->get();
		$competences = Competence::orderBy('nom')->get();

		return view('vaeexps.index', compact('vaeexps', 'organisations', 'competences', 'q', 'organisationId', 'competenceId'));
	}

```

---
## Vue index 
resources/views/vaeexps/index.blade.php
contient formulaire de recherche


# Transposision

On consulte le model Image et ses relations

```
class Image extends Model
{
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
	
	public function realisations()
	{
		return $this->belongsToMany(Realisation::class, 'image_realisation');
	}
	
	public function url()
{
	return asset('public/' . $this->path);
}
}
```


La vue index du controller (avant recherche)

```
    public function index()
    {
    $images = Image::with('realisations')
        ->orderBy('created_at', 'desc')
        ->paginate(50);

    return view('images.index', compact('images'));
    }
```




le code de la vue 
resources/views/images/index.blade.php (avant recherche)


```
@php
$keyGOOGLESEARCH = "KEY";
$titre = "Elfennel - Module des images"
@endphp

@extends('layouts.pure')

@section('title', 'Elfennel')

@section('description', "Module des images")

@section('content')

	<h1>Liste des images</h1>

  @auth
      @if (Auth::user()->role === 'admin')
      <a href="{{ route('images.create') }}">Ajouter une image</a>
      @endif   
  @endauth

	

	<table>
		<thead>
			<tr>
				<th>ID</th>
				<th>Image</th>
				<th>Nom</th>
				<th>Extension</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($images as $image)
			<tr>
				<td>{{ $image->id }}</td>
				<td>
					<a href="/public/{{ $image->path }}" target="_blank">
						<img src="/public/{{ $image->path }}" alt="{{ $image->filename }}" width="100">
					</a>			
				
					<!-- <img src="./public/{{ $image->path}}" alt="{{ $image->filename }}" width="100"> -->
				</td>
				<td>{{ $image->filename }}</td>
				<td>{{ $image->ext }}</td>
				<td>
					<a href="{{ route('images.show', $image) }}">Voir</a> 
					
					
					@auth
						@if (Auth::user()->role === 'admin')
							<a href="{{ route('images.edit', $image) }}">Modifier</a>
						@endif   
					@endauth
					
					
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>

	{{ $images->links() }} {{-- Pagination --}}
@endsection

```













