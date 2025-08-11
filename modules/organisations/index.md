# Organisations
Ce module gère les organisations : entreprise, association, insititutions

Deux cas d'emploi : 
- organisation -> expérience professionelle
une organisation a été le vecteur d'une expérience professionelle (employeur)

- réalisation -> organisation
une réalisation, d'une expérience professionelle, est lié à une organisation (client)

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
organisations._form  (commun a create et edit)
organisations.create
organisations.edit
organisations.index
organisations.show

<!-- 


## Outils
### command artisan
### seeder
-->


