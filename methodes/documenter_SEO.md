Generation des metas SEO pour le composant x-meta1
realisations/show.blade.php
```
@php
	$keyGOOGLESEARCH = "KEY";
	$metaTitle = $realisation->titre;
	$metaDescription = Str::limit(strip_tags($realisation->description), 160);
	$metaKeywords = $realisation->competences->pluck('nom')->implode(', ');
	$metaImage = $realisation->images->first()?->url() ?? 'https://elfennel.fr/public/img/seo/default-image.jpg';
@endphp

<x-meta1 
	:gsv="$keyGOOGLESEARCH ?? ''" 
	:title="$metaTitle ?? 'Elfennel – Métiers techniques et VAE'" 
	:description="$metaDescription ?? 'Plateforme Laravel pour la validation des acquis, les projets industriels et les compétences techniques.'" 
	:keywords="$metaKeywords ?? 'énergie, automatisme, maintenance, industrie'" 
	:image="$metaImage ?? 'https://elfennel.fr/public/img/seo/default-image.jpg'" 
/>
```

un élément HTML représente un article
```html
<article itemscope itemtype="https://schema.org/Article">
  <h1 itemprop="headline">Réparation de la chaudière vapeur</h1>
  <p itemprop="author">Arnaud BOIS PORHEL</p>
  <time itemprop="datePublished" datetime="2025-07-30">30 juillet 2025</time>
  <div itemprop="articleBody">
    Intervention sur le brûleur gaz, configuration du détecteur H2S, etc.
  </div>
</article>
```
📌 Détail des balises :
- itemscope : indique que l’élément est un conteneur de données structurées.
- itemtype : précise le type (ex. Article, Person, Event…) avec une URL Schema.org.
- itemprop : définit le nom de la propriété (titre, auteur, corps, etc.).





fichier robots.txt :
```
User-agent: *
Disallow:
Sitemap: https://elfennel.fr/sitemap.xml
```
User-agent: *	S’applique à tous les moteurs de recherche (Googlebot, Bingbot, etc.).
Disallow:	Aucune restriction : tout le site est accessible à l’indexation.
Sitemap:	Indique où trouver le fichier sitemap.xml pour aider à l’indexation

---







---

php artisan make:controller SitemapController

app/Http/Controllers/SitemapController.php

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Models\Realisation;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $realisations = Realisation::all();

        $content = view('sitemap', compact('realisations'));

        return response($content, 200)->header('Content-Type', 'application/xml');
    }
}

```

vue resources/views/sitemap.blade.php :
```
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
@foreach($realisations as $realisation)
    <url>
        <loc>{{ url('/realisations/' . $realisation->id) }}</loc>
        <lastmod>{{ $realisation->updated_at->toDateString() }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.8</priority>
    </url>
@endforeach
</urlset>
```

Routes
```
Route::get('/sitemap.xml', [App\Http\Controllers\SitemapController::class, 'index']);
```
```

routes/web.php :

Route::get('/sitemap.xml', [App\Http\Controllers\SitemapController::class, 'index']);
