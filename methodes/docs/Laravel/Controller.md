## Passage des variables
```php
$realisation->load(['vaeexp', 'client', 'competences', 'images']);
return view('realisations.show', compact('realisation'));
```


```php
$vaeexps = Vaeexp::all();
$organisations = Organisation::all();
$competences = Competence::all();
return view('realisations.edit', compact('realisation', 'vaeexps', 'organisations', 'competences'));
```


```php
    public function index()
    {
        //$vaeexps = Vaeexp::with('organisation')->orderByDesc('dd')->get();
		//$vaeexps = Vaeexp::with(['organisation', 'realisations'])->orderByDesc('dd')->get();		
		$vaeexps = Vaeexp::with(['organisation', 'realisations.client'])->orderByDesc('dd')->get();
        return view('vaeexps.index', compact('vaeexps'));
    }
```
