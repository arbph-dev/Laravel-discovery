# Module competences

## Migrations
[Migration 1](../../srcLaravel/database/migrations/2025_07_11_021151_create_competences_table.php)

### tables
- competences

## Model Competence
[Competence](../../srcLaravel/app/Models/Competence.php)

### Relations
Les relations sont hiérachiques entre compétences.


- parent
Une compétence de Lecture de schémas est subordonnée à Electrcitié sa compétence parente
```php
return $this->belongsTo(Competence::class, 'idp');
```
- enfants
Une compétence Electrcitié est parente de Lecture de schémas, édition de schémas, dimensionnement câbles
```php 
return $this->hasMany(Competence::class, 'idp');
```
---
## Controller
controleur : [CompetenceController](../../srcLaravel/app/Http/Controllers/CompetenceController.php)

---
## Route
Les routes sont gérées dans[web.php](../../srcLaravel/routes/web.php)

---
## Views
- [competences._form](../../srcLaravel/resources/views/competences/_form.blade.php)  (commun a create et edit)
- [competences.create](../../srcLaravel/resources/views/competences/create.blade.php)
- [competences.edit](../../srcLaravel/resources/views/competences/edit.blade.php)
- [competences.index](../../srcLaravel/resources/views/competences/index.blade.php)
- [competences.show](../../srcLaravel/resources/views/competences/show.blade.php)
