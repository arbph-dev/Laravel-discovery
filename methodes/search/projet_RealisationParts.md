On doit revoir la mise en page des réalisations; on choisit de scinder les réalisation en partie 

La [structure actuelle](../../srcHtml/rbase.html) est copié et complété pour chaque partie
On copie le code dans un textaera

# Fichiers à créer ou modifier
- database/migrations/2025_08_XX_create_realisation_parts_table.php
- app/Models/RealisationPart.php
- app/Http/Controllers/RealisationPartController.php
- app/Helpers/SeoHelper.php
- resources/views/components/realisation/part.blade.php
- resources/views/realisationparts/index.blade.php
- resources/views/realisationparts/create.blade.php
- resources/views/realisationparts/edit.blade.php
- resources/views/realisationparts/show.blade.php
- resources/views/realisationparts/_form.blade.php
- routes/web.php
- app/Http/Controllers/RealisationController.php
- resources/views/realisations/show.blade.php

# Migrations
Fichier : database/migrations/2025_08_XX_create_realisation_parts_table.php

```
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRealisationPartsTable extends Migration
{
    public function up()
    {
        Schema::create('realisationparts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('realisation_id')->constrained()->onDelete('cascade');
            $table->string('titre')->nullable();      // Titre de la partie
            $table->text('contenu')->nullable();      // HTML ou texte enrichi
            $table->string('type')->default('text');  // 'text', 'image', 'code', etc.
            $table->integer('ordre')->default(0);     // Pour l'ordre d'affichage
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('realisationparts');
    }
}
```


```
Schema::create('realisationparts', function (Blueprint $table) {
    $table->id();
    $table->foreignId('realisation_id')->constrained()->onDelete('cascade');
    $table->string('titre');
    $table->text('contenu'); // HTML riche
    $table->text('meta_description')->nullable(); // Pour SEO
    $table->unsignedTinyInteger('ordre')->default(0);
    $table->timestamps();
});
```

## version finale 
- on gerera meta_description dans realisation plutot que realisationparts
- on ne gere pas type mais l'edition se fera avec un fichier ?? rbase.html en attendant un formulaire plsu avancé
- on ajoute une realtion avec image,plus facile pour gerer les images


```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRealisationPartsTable extends Migration
{
    public function up()
    {
        Schema::create('realisationparts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('realisation_id')->constrained()->onDelete('cascade');
            //$table->string('titre')->nullable();      // Titre de la partie
			//$table->text('contenu')->nullable();      // HTML ou texte enrichi
    		$table->string('titre');
    		$table->text('contenu'); // HTML riche
            $table->integer('ordre')->default(0);     // Pour l'ordre d'affichage
            $table->timestamps();
        });

		Schema::create('image_realisation_part', function (Blueprint $table) {
		    $table->id();
		    $table->foreignId('image_id')->constrained()->onDelete('cascade');
		    $table->foreignId('realisation_part_id')->constrained()->onDelete('cascade');
		    $table->timestamps();
		});
    }

    public function down()
    {
        Schema::dropIfExists('realisationparts');
		Schema::dropIfExists('image_realisation_part');
    }
}
```





# Models

## Realisation
la relation sera transposé dans le model [Realisation](../../srcLaravel/app/Models/Realisation.php)
```php
public function parts()
{
    return $this->hasMany(RealisationPart::class)->orderBy('ordre');
}
```


## RealisationPart

php artisan make:model RealisationPart

```
// app/Models/RealisationPart.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RealisationPart extends Model
{
    protected $fillable = [
        'realisation_id',
        'titre',
        'contenu',
        'type',
        'ordre',
    ];

    public function realisation()
    {
        return $this->belongsTo(Realisation::class);
    }
}
```
type est a supprimer on doit gérer les images par la suite 
mais une RealisationPart => texte + image + lien

```
<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RealisationPart extends Model
{
    protected $fillable = ['realisation_id', 'titre', 'contenu', 'meta_description', 'ordre'];

    public function realisation()
    {
        return $this->belongsTo(Realisation::class);
    }
}
```

---

### version "finale"

```php
class RealisationPart extends Model
{
    protected $fillable = [
        'realisation_id',
        'titre',
        'contenu',
        'ordre',
    ];

    public function realisation()
    {
        return $this->belongsTo(Realisation::class);
    }

    public function images()
    {
        return $this->belongsToMany(Image::class, 'image_realisation_part');
    }
}

```

# Helper SEO (standby)

Fichier : app/Helpers/SeoHelper.php
Résumé SEO : Générer un extrait court et propre depuis le contenu HTML.
un résumé SEO automatique pour chaque RealisationPart. Cela repose sur :
- Le contenu existant de la partie (texte).
- Les relations existantes (autres réalisations ou compétences).
- Un helper centralisé pour l’analyse.

Liens internes :
- vers d'autres parties pertinentes (realisation_parts)
- vers des compétences
- vers des réalisations entières
- vers des articles internes si possible
  
Servira à générer :
- meta
- description
- keywords
- links
- score

```php
<?php
namespace App\Helpers;

use Illuminate\Support\Str;

class SeoHelper
{
    public static function extractKeywords(string $text, int $minLength = 4): array
    {
        $clean = strip_tags($text);
        preg_match_all('/\b\p{L}{'.$minLength.',}\b/u', $clean, $words);
        $counts = array_count_values(array_map('mb_strtolower', $words[0]));
        arsort($counts);
        return array_slice(array_keys($counts), 0, 15);
    }

    public static function score(string $text): int
    {
        $clean = strip_tags($text);
        return min(100, intval(strlen($clean) / 10));
    }

    public static function summary(string $text, int $length = 160): string
    {
        $clean = trim(strip_tags($text));
        return Str::limit($clean, $length);
    }

    public static function suggestRelated(string $content, array $candidates): array
    {
        $keywords = self::extractKeywords($content);
        $related = [];

        foreach ($candidates as $label => $url) {
            foreach ($keywords as $kw) {
                if (Str::contains(Str::lower($label), $kw)) {
                    $related[$label] = $url;
                    break;
                }
            }
        }

        return $related;
    }
}

```

## Étendre la logique SEO à tous les modules
Crée un SeoHelper qui peut extraire :
- mots-clés (keywords)
- résumé (description)
- score de densité de mots
- suggestions (voir [projet_Lexique](../projet_Lexique.md)

```
namespace App\Helpers;

class SeoHelper
{
    public static function extractKeywords(string $text, int $minLength = 4): array
    {
        $clean = strip_tags($text);
        preg_match_all('/\b\p{L}{'.$minLength.',}\b/u', $clean, $words);
        $counts = array_count_values(array_map('mb_strtolower', $words[0]));
        arsort($counts);
        return array_slice(array_keys($counts), 0, 15);
    }

    public static function score(string $text): int
    {
        $len = strlen(strip_tags($text));
        return min(100, intval($len / 10)); // simple base sur la longueur
    }
}

```



# Controller 
## RealisationController

Dans la methode show de [RealisationController](../../srcLaravel/app/Http/Controllers/RealisationController.php)

```
$parts = $realisation->parts;

foreach ($realisation->parts as $part) {
    $part->summary = SeoHelper::summary($part->contenu);
    $part->seo_score = SeoHelper::score($part->contenu);
}
```

---


## RealisationPartController
fichier : app/Http/Controllers/RealisationPartController.php

php artisan make:controller RealisationPartController --resource


Inclut les méthodes CRUD classiques : index, create, store, show, edit, update, destroy
Optionnellement une méthode sort() ou reorder().


```
use App\Models\Realisation;
use App\Models\RealisationPart;
use Illuminate\Http\Request;

class RealisationPartController extends Controller
{
    public function create(Realisation $realisation)
    {
        return view('realisation_parts.create', compact('realisation'));
    }

    public function store(Request $request, Realisation $realisation)
    {
        $validated = $request->validate([
            'titre' => 'nullable|string|max:255',
            'contenu' => 'required|string',
            'type' => 'nullable|string|max:50',
            'ordre' => 'nullable|integer',
        ]);

        $validated['realisation_id'] = $realisation->id;

        RealisationPart::create($validated);

        return redirect()->route('realisations.show', $realisation)->with('success', 'Partie ajoutée.');
    }

    public function edit(Realisation $realisation, RealisationPart $part)
    {
        return view('realisation_parts.edit', compact('realisation', 'part'));
    }

    public function update(Request $request, Realisation $realisation, RealisationPart $part)
    {
        $validated = $request->validate([
            'titre' => 'nullable|string|max:255',
            'contenu' => 'required|string',
            'type' => 'nullable|string|max:50',
            'ordre' => 'nullable|integer',
        ]);

        $part->update($validated);

        return redirect()->route('realisations.show', $realisation)->with('success', 'Partie mise à jour.');
    }

    public function destroy(Realisation $realisation, RealisationPart $part)
    {
        $part->delete();
        return redirect()->route('realisations.show', $realisation)->with('success', 'Partie supprimée.');
    }
}

```



evolution doit gerer le seo
```
<?php
use App\Helpers\SeoHelper;

public function show(Realisation $realisation)
{
    $parts = $realisation->parts;

    $competences = $realisation->competences->pluck('nom', 'id')->toArray();
    $otherTitles = $realisation->parts->pluck('titre', 'id')->toArray();

    foreach ($parts as $part) {
        $text = $part->contenu;

        $part->summary = SeoHelper::summary($text);
        $part->seo_score = SeoHelper::score($text);

        // Crée les candidats : ici liens vers compétences (à adapter)
        $relatedCandidates = [];

        foreach ($realisation->competences as $comp) {
            $relatedCandidates[$comp->nom] = route('competences.show', $comp);
        }

        foreach ($realisation->parts as $p) {
            if ($p->id !== $part->id) {
                $relatedCandidates[$p->titre] = route('realisationparts.show', $p);
            }
        }

        $part->related_links = SeoHelper::suggestRelated($text, $relatedCandidates);
    }

    return view('realisations.show', compact('realisation', 'parts'));
}

```



Un RealisationPartController gère les CRUD des étapes.
Tu pourras soit :

avoir un CRUD séparé (index, create, edit pour les parts),

soit les gérer directement imbriqués dans la vue edit de Realisation (plus fluide pour toi).

Exemple d’ajout rapide d’un part :


```php
public function store(Request $request, Realisation $realisation)
{
    $data = $request->validate([
        'titre' => 'nullable|string',
        'contenu' => 'nullable|string',
        'ordre' => 'nullable|integer',
        'images_ids' => 'nullable|string'
    ]);

    $part = $realisation->parts()->create($data);

    $imagesIdsString = $request->input('images_ids', '');
    if (!empty($imagesIdsString)) {
        $imagesIds = array_filter(explode(';', $imagesIdsString));
        $part->images()->sync($imagesIds);
    }

    return redirect()->route('realisations.show', $realisation);
}
```








# Views 
on conserve : Layout pure.blade.php

## balise meta
Injecter dynamiquement les balises meta dans chaque vue via : [x-meta1](../../srcLaravel/resources/views/components/meta1.blade.php)
```blade
<x-meta1 
    :gsv="$keyGOOGLESEARCH ?? ''"
    :title="$metaTitle ?? 'Elfennel'" 
    :description="$metaDescription ?? '...'" 
    :keywords="$metaKeywords ?? '...'" 
    :image="$metaImage ?? '...'" 
/>
```
## composant x-realisation.part
Il permettra d'aficher les realisationparts via un composant dans la vue show des realisations
- [realisations/show.blade.php](../../srcLaravel/resources/views/realisations/show.blade.php)

### exploitation
Rendu des parties via composant :
```blade
@foreach($realisation->parts as $part)
    <x-realisation.part 
        :titre="$part->titre" 
        :contenu="$part->contenu" 
        :date="$part->created_at" 
        :summary="$part->summary ?? null"
        :related="$part->related_links ?? []" 
    />
@endforeach
```

### Code composant x-realisation.part
version 0
```blade
@props([
    'titre' => 'Partie sans titre',
    'contenu' => '',
    'images' => [],
    'date' => now()->toDateString()
])

<div itemscope itemtype="https://schema.org/Article" class="textimgr">

    <div class="text-content">
        <h2 itemprop="headline">{{ $titre }}</h2>
        <div itemprop="description">
            {!! $contenu !!}
        </div>
    </div>

    <div class="img-content">
        @foreach($images as $image)
            <a href="{{ $image['url'] }}" target="_blank">
                <img src="{{ $image['thumb'] ?? $image['url'] }}" alt="{{ $image['alt'] ?? 'illustration' }}">
            </a>
        @endforeach
    </div>

    <meta itemprop="datePublished" content="{{ $date }}" />
</div>
```

version 1
```blade
@props([
    'titre' => 'Partie sans titre',
    'contenu' => '',
    'images' => [],
    'date' => now()->toDateString(),
    'author' => 'Elfennel',
    'related' => [],
    'seoScore' => null,
    'editUrl' => null
])

<div itemscope itemtype="https://schema.org/Article" class="textimgr">
    <div class="text-content">
        <h2 itemprop="headline">{{ $titre }}</h2>
        
        <meta itemprop="author" content="{{ $author }}"/>

        <div itemprop="description">
            {!! $contenu !!}
        </div>

        @if($seoScore)
            <p><strong>Indice SEO :</strong> {{ $seoScore }}/100</p>
        @endif

        @if($related && is_iterable($related))
            <div class="related-links">
                <strong>Liens internes :</strong>
                <ul>
                    @foreach($related as $label => $url)
                        <li><a href="{{ $url }}">{{ $label }}</a></li>
                    @endforeach
                </ul>
            </div>
        @endif

        @auth
            @if(Auth::user()?->role === 'admin' && $editUrl)
                <a href="{{ $editUrl }}" class="edit-button">Modifier cette partie</a>
            @endif
        @endauth
    </div>

    <div class="img-content">
        @foreach($images as $image)
            <a href="{{ $image['url'] }}" target="_blank">
                <img src="{{ $image['thumb'] ?? $image['url'] }}" alt="{{ $image['alt'] ?? 'illustration' }}">
            </a>
        @endforeach
    </div>

    <meta itemprop="datePublished" content="{{ $date }}" />
</div>

```


version 2

```blade
<div itemscope itemtype="https://schema.org/Article" class="textimgr">
    <div class="text-content">
        <h2 itemprop="headline">{{ $titre }}</h2>
        <div itemprop="description">
            {!! $contenu !!}
        </div>
    </div>
    <div class="img-content">
        {{-- Générer les thumbs ici --}}
        @if(isset($images))
            @foreach($images as $img)
                <a href="{{ $img->url() }}" target="_blank">
                    <img src="{{ $img->thumb() }}" alt="{{ $img->filename }}">
                </a>
            @endforeach
        @endif
    </div>
    <meta itemprop="datePublished" content="{{ $date ?? now()->toDateString() }}" />
    <meta itemprop="author" content="Arnaud BOIS PORHEL">
</div>
```

## Vue show du module realisation
realisations/show.blade.php
```blade
@php
$tabs = $realisation->parts;
@endphp

<div class="tabs-container">
    <!-- Onglets (titres) -->
    <ul class="tab-buttons">
        @foreach($tabs as $index => $tab)
            <li>
                <button class="tab-btn" data-tab="tab-{{ $index }}">{{ $tab->titre }}</button>
            </li>
        @endforeach
    </ul>

    <!-- Contenu des onglets -->
    @foreach($tabs as $index => $part)
        <div id="tab-{{ $index }}" class="tab-content" style="display: {{ $index === 0 ? 'block' : 'none' }}">
            <x-realisation.part 
                :titre="$part->titre"
                :contenu="$part->contenu"
                :images="$part->images->map(fn($img) => [
                    'url' => '/public/' . $img->path,
                    'thumb' => \App\Helpers\ImageHelper::thumb($img->path),
                    'alt' => $img->filename
                ])->toArray()"
                :date="$part->date_realisation"
                :author="$realisation->auteur ?? 'Elfennel'"
                :related="$part->related"
                :seoScore="$part->seo_score"
                :editUrl="route('realisationparts.edit', $part->id)"
            />
        </div>
    @endforeach
</div>

<script>
    document.querySelectorAll('.tab-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            document.querySelectorAll('.tab-content').forEach(el => el.style.display = 'none');
            document.getElementById(btn.dataset.tab).style.display = 'block';
        });
    });
</script>

```

### Ajout de partie a une réalisation
Dans realisations/show.blade.php, après le contenu principal :
voir gestion de songlets ci dessous pour le style
```
<h2>Contenu détaillé</h2>

@foreach ($realisation->parts as $part)
    <div class="realisation-part realisation-part-{{ $part->type }}">
        @if ($part->titre)
            <h3>{{ $part->titre }}</h3>
        @endif

        <div class="contenu">
            {!! $part->contenu !!}
        </div>

        @auth
            @if (Auth::user()->role === 'admin')
                <a href="{{ route('realisation_parts.edit', [$realisation, $part]) }}">✏️ Modifier</a>
                <form action="{{ route('realisation_parts.destroy', [$realisation, $part]) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Supprimer cette section ?')">🗑️</button>
                </form>
            @endif
        @endauth
    </div>
@endforeach

```


## Vues du module realisationparts
Dossier : resources/views/realisationparts/
- _form.blade.php – formulaire partagé
- create.blade.php – formulaire de création
- edit.blade.php – formulaire d'édition
- index.blade.php – liste des parties pour une réalisation
- show.blade.php – page de détail d’une part (optionnelle si rendu par composant)

### Create
le fomulaire sera a extraire : 
```blade
@extends('layouts.pure')

@section('title', 'Nouvelle section')
@section('description', 'Ajout d’une partie à la réalisation')

@section('content')
<h1>Ajouter une section</h1>

<form method="POST" action="{{ route('realisation_parts.store', $realisation) }}">
    @csrf

    <label for="titre">Titre</label>
    <input type="text" name="titre" value="{{ old('titre') }}">

    <label for="contenu">Contenu (HTML autorisé)</label>
    <textarea name="contenu" rows="8">{{ old('contenu') }}</textarea>

    <label for="type">Type</label>
    <select name="type">
        <option value="text">Texte</option>
        <option value="image">Image</option>
        <option value="code">Code</option>
        <option value="schema">Schéma</option>
    </select>

    <label for="ordre">Ordre</label>
    <input type="number" name="ordre" value="{{ old('ordre', 0) }}">

    <button type="submit">Ajouter</button>
</form>

<a href="{{ route('realisations.show', $realisation) }}">Retour</a>
@endsection

```



# script
## Gestion des onglets
Afficher chaque realisation_part dans un onglet :
    Onglets en haut (via Tab)
    Contenu dans des panneaux (Tabelm)
    Optionnel : éditeur, boutons d’action
    
option : Fichier  public/build/assets/realisation_tabs.js ou inline dans la vue si minimal.

### Style
fichizer asset/tabs.css ou intégré)
```css


.Tab_group {
	display: flex;
	flex-direction: column;
}

.Tab_nav {
	display: flex;
	border-bottom: 1px solid #ccc;
}

.Tab_nav button {
	padding: 0.5em 1em;
	border: none;
	background: none;
	cursor: pointer;
	border-bottom: 3px solid transparent;
}

.Tab_nav button.active {
	border-color: #007bff;
	font-weight: bold;
}

.Tabelm_panel {
	display: none;
	padding: 1em;
}

.Tabelm_panel.active {
	display: block;
}
```

Code de vue
```blade
<div class="Tab_group">
    <div class="Tab_nav">
        @foreach ($realisation->parts as $index => $part)
            <button class="Tab_button" data-tab="{{ $index }}">
                {{ $part->titre ?? 'Bloc ' . ($index + 1) }}
            </button>
        @endforeach
    </div>

    <div class="Tab_content">
        @foreach ($realisation->parts as $index => $part)
            <div class="Tab_panel" data-tab="{{ $index }}" style="display: {{ $index === 0 ? 'block' : 'none' }}">
                {!! $part->contenu !!}
            </div>
        @endforeach
    </div>
</div>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const buttons = document.querySelectorAll(".Tab_button");
    const panels = document.querySelectorAll(".Tab_panel");

    buttons.forEach(button => {
        button.addEventListener("click", () => {
            const tab = button.getAttribute("data-tab");

            // Activer uniquement le bon panel
            panels.forEach(panel => {
                panel.style.display = panel.getAttribute("data-tab") === tab ? "block" : "none";
            });

            // Met à jour les styles actifs
            buttons.forEach(b => b.classList.remove("active"));
            button.classList.add("active");
        });
    });
});
</script>
```

## Composant x-tab
### Exploitation
dans la vue realisation.show 
```blade
@php
$tabs = [];

foreach ($realisation->parts as $index => $part) {
    $tabs[] = [
        'label' => $part->titre ?? "Bloc " . ($index + 1),
        'content' => view('realisationparts.panel', compact('part'))->render()
    ];
}
@endphp

<x-tab :tabs="$tabs" />
```


### code composant
Composant Blade resources/views/components/tab.blade.php
```blade
@props(['tabs' => [], 'active' => 0])

<div class="Tab_group" x-data="{ active: {{ $active }} }">
	<div class="Tab_nav">
		@foreach($tabs as $index => $tab)
			<button 
				type="button"
				:class="{ 'active': active === {{ $index }} }"
				@click="active = {{ $index }}"
			>
				{{ $tab['label'] }}
			</button>
		@endforeach
	</div>

	@foreach($tabs as $index => $tab)
		<div class="Tabelm_panel" x-show="active === {{ $index }}">
			{!! $tab['content'] !!}
		</div>
	@endforeach
</div>
```
Composant realisationparts/panel.blade.php
```blade
<div class="realisationpart realisationpart-{{ $part->type }}">
	@if ($part->titre)
		<h3>{{ $part->titre }}</h3>
	@endif

	<div class="contenu">
		{!! $part->contenu !!}
	</div>

	@auth
		@if (Auth::user()->role === 'admin')
			<a href="{{ route('realisationparts.edit', [$part->realisation_id, $part]) }}">✏️ Modifier</a>
			<form action="{{ route('realisationparts.destroy', [$part->realisation_id, $part]) }}" method="POST" style="display:inline;">
				@csrf
				@method('DELETE')
				<button type="submit" onclick="return confirm('Supprimer cette section ?')">🗑️</button>
			</form>
		@endif
	@endauth
</div>
```



# Routes
routes/web.php

```php
Route::middleware(['auth', 'verified'])->group(function () {
    Route::prefix('realisations/{realisation}')->group(function () {
        Route::get('parts/create', [RealisationPartController::class, 'create'])->name('realisation_parts.create');
        Route::post('parts', [RealisationPartController::class, 'store'])->name('realisation_parts.store');
        Route::get('parts/{part}/edit', [RealisationPartController::class, 'edit'])->name('realisation_parts.edit');
        Route::put('parts/{part}', [RealisationPartController::class, 'update'])->name('realisation_parts.update');
        Route::delete('parts/{part}', [RealisationPartController::class, 'destroy'])->name('realisation_parts.destroy');
    });
});

```

```php
Route::resource('realisationparts', RealisationPartController::class)->middleware(['auth']);
```
Ou bien 
```php
Route::prefix('realisations/{realisation}')->group(function () {
    Route::resource('parts', RealisationPartController::class)->middleware(['auth']);
});

```

