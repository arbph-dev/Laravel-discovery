
@props([
	'title' => 'Elfennel',
	'description' => 'Bienvenue sur notre portail Laravel',
	'author' => 'Arnaud BOIS PORHEL',
	'keywords' => '',
	'robots' => 'index,follow',
	'gsv' => '',
	'image' => 'https://elfennel.fr/public/img/seo/default-image.jpg',
	'url' => request()->url(),
	'type' => 'website'
])

<!-- Métadonnées HTML classiques -->
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="robots" content="{{ $robots }}">
<meta name="author" content="{{ $author }}">
<meta name="description" content="{{ $description }}">
<meta name="keywords" content="{{ trim($keywords . ', électrotechnique, automatisme, énergie, informatique, transmission, sécurité', ', ') }}">
<meta name="google-site-verification" content="{{ $gsv }}">

<!-- Open Graph (Facebook / LinkedIn) -->
<meta property="og:title" content="{{ $title }}">
<meta property="og:description" content="{{ $description }}">
<meta property="og:type" content="{{ $type }}">
<meta property="og:url" content="{{ $url }}">
<meta property="og:image" content="{{ $image }}">
<meta property="og:site_name" content="Elfennel">

<!-- Twitter Card -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $title }}">
<meta name="twitter:description" content="{{ $description }}">
<meta name="twitter:image" content="{{ $image }}">
