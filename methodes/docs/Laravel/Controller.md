## Passage des variables
```php
$realisation->load(['vaeexp', 'client', 'competences', 'images']);
return view('realisations.show', compact('realisation'));
```
ou 

```php
$vaeexps = Vaeexp::all();
$organisations = Organisation::all();
$competences = Competence::all();
return view('realisations.edit', compact('realisation', 'vaeexps', 'organisations', 'competences'));
```
