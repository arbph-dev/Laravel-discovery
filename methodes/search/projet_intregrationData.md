"Objectif"
Récupérer le JSON des parrainages 2022 depuis data.gouv.fr et l’injecter dans un base via Laravel
2 possibilitées 
- Seeder (petits fichiers) 
- Artisan command (gros volumes)

1. Créer une table dédiée

Par exemple parrainages :
```php
php artisan make:migration create_parrainages_table
```

2- Migration
```php
Schema::create('parrainages', function (Blueprint $table) {
    $table->id();
    $table->string('candidat')->nullable();
    $table->string('civilite')->nullable();
    $table->string('nom')->nullable();
    $table->string('prenom')->nullable();
    $table->string('mandat')->nullable();
    $table->string('fonction')->nullable();
    $table->string('commune')->nullable();
    $table->string('departement')->nullable();
    $table->string('region')->nullable();
    $table->date('date_parrainage')->nullable();
    $table->timestamps();
});

```
