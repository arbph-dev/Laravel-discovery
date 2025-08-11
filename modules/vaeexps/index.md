# Module vaeexps
Gère les expériences professionnelles, **vaeexp**, associées à des [organisations](../organisations/index.md) (employeur)


## Migrations
[migration 1](../../srcLaravel/database/migrations/2025_07_06_093519_create_vaeexps_table.php)

### Table de la base de données

## Model Vaeexp
model : [Vaeexp](../../srcLaravel/app/Models/Vaeexp.php)

### Relations
- organisation
une organisation peut contenir plusieurs experiences voir [organisations](../organisations/index.md)
```
return $this->belongsTo(Organisation::class);
```
- realisations
une expérience a permis plusieurs réalisations
```
return $this->hasMany(Realisation::class);
```
### Methodes
#### getDureeAttribute
Détermine une durée pour l'expérience

## Controller
controleur : [VaeexpController](../../srcLaravel/app/Http/VaeexpController.php)


## route
Les routes sont gérées dans[web.php](../../srcLaravel/routes/web.php)

## views
- [vaeexps._form](../../srcLaravel/resources/views/vaeexps/_form.php)  (commun a create et edit)
- [vaeexps.create](../../srcLaravel/resources/views/vaeexps/create.php)
- [vaeexps.edit](../../srcLaravel/resources/views/vaeexps/edit.php)
- [vaeexps.index](../../srcLaravel/resources/views/vaeexps/index.php)
- [vaeexps.show](../../srcLaravel/resources/views/vaeexps/show.php)

<!-- 
## Outils
### command artisan
### seeder


### Helpers
[OrganisationSeeder](../../srcLaravel/database/seeders/OrganisationSeeder.php)
-->


