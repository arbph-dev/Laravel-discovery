<!--
realisations
[migration 1](../../srcLaravel/database/migrations/
.php
)
[OrganisationSeeder](../../srcLaravel/database/seeders/OrganisationSeeder.php)
Realisation
-->

## Migrations
[migration 1](../../srcLaravel/database/migrations/2025_07_12_025950_create_realisations_table.php)

### Tables
- realisations
- competence_realisation
- image_realisation

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
- [realisations._form](../../srcLaravel/resources/views/realisations/_form.blade.php)  (commun a create et edit)
- [realisations.create](../../srcLaravel/resources/views/realisations/create.blade.php)
- [realisations.edit](../../srcLaravel/resources/views/realisations/edit.blade.php)
- [realisations.index](../../srcLaravel/resources/views/realisations/index.blade.php)
- [realisations.show](../../srcLaravel/resources/views/realisations/show.blade.php)

### css assoicées
la mise en forme de la description des realisations est réalisé avec des css
Un template HTML est employé pour rédiger les réaliations voir [rbase.html](../srcHtml/rbase.html)

```
.textimgr
{
	display :flex;
	margin-bottom:20px
	border : 1px solid #ccc;
	padding:10px;
}


.textimgr h2
{
color : var(--theme-color-4);
}

.text-content
{
flex:1;
padding-right : 10px;
}
.img-content
{
width:320px;
text-align : right;
}

.img-content img
{
max-width:25%;
max-height:25%;
}
```



