<!--
realisations
[migration 1](../../srcLaravel/database/migrations/
.php
)
[OrganisationSeeder](../../srcLaravel/database/seeders/OrganisationSeeder.php)
Realisation
-->
## Migrations

---
## Model Realisation
model : [Realisation](../../srcLaravel/app/Models/Realisation.php)

### Relations

- experience(vaeexp)
une **réalisation** appartient à une expérience unique
```php
return $this->belongsTo(Vaeexp::class);
```

- client(organisation)
une **réalisation** peut etre réalisé pour une organisation client. Un client peut avoir donné lieu à plusieurs réalisations.
```php
return $this->belongsTo(Organisation::class, 'organisation_id');
```

- competences
une **réalisation** peut necessité plusieurs compétences
```php
return $this->belongsToMany(Competence::class, 'competence_realisation');
```

- images
une **réalisation** peut etre illustré par plusieurs photos
```php
return $this->belongsToMany(Image::class, 'image_realisation');
```

### Methodes

---
## Controller
controleur : [RealisationController](../../srcLaravel/app/Http/RealisationController.php)

---
## Route
Les routes sont gérées dans[web.php](../../srcLaravel/routes/web.php)

---
## Views
- [realisations._form](../../srcLaravel/resources/views/realisations/_form.php)  (commun a create et edit)
- [realisations.create](../../srcLaravel/resources/views/realisations/create.php)
- [realisations.edit](../../srcLaravel/resources/views/realisations/edit.php)
- [realisations.index](../../srcLaravel/resources/views/realisations/index.php)
- [realisations.show](../../srcLaravel/resources/views/realisations/show.php)
