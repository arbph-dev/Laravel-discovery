# Organisations
Ce module gère les organisations : entreprise, association, insititutions

Deux cas d'emploi : 

1. organisation -> expérience professionelle
Une organisation a été le vecteur d'une expérience professionelle([vaeexp](../vaeexps/index.md)).

L'organisation est dans ce cas l'employeur

2. réalisation -> organisation

Une réalisation, d'une expérience professionelle ([vaeexp](../vaeexps/index.md)), est lié à une organisation (client)


A ce stade : pas de relations réalisations avec les prestataires


## Migrations
### Table de la base de données
table : organisations

### Migration
[migration 1](../../srcLaravel/database/migrations/2025_07_03_164608_create_tbl_organisations_table.php)

### Seeder


[OrganisationSeeder](../../srcLaravel/database/seeders/OrganisationSeeder.php)


## Model
model : [Organisation](../../srcLaravel/app/Models/Organisation.php)

### Relations

### Methodes

## Controller
controleur : [OrganisationController](../../srcLaravel/app/Http/OrganisationController.php)

### Helpers
aucun à ce stade

---
## route 
Les routes sont gérées dans[web.php](../../srcLaravel/routes/web.php)

```php
use App\Http\Controllers\OrganisationController;
```

```php
Route::resource('organisations', OrganisationController::class);
```

## views
- [organisations._form](../../srcLaravel/resources/views/organisations/_form.php)
commune a create et edit
- [organisations.create](../../srcLaravel/resources/views/organisations/create.php)
- [organisations.edit](../../srcLaravel/resources/views/organisations/edit.php)
- [organisations.index](../../srcLaravel/resources/views/organisations/index.php)
- [organisations.show](../../srcLaravel/resources/views/organisations/show.php)
<!-- 


## Outils
### command artisan
### seeder
-->


