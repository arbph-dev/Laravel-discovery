# Module competences

## Mise en oeuvre
----

on débute la création du module : **php artisan make:model Competence -mcr**
   
   INFO  Model [app/Models/Competence.php] created successfully.
   INFO  Migration [database/migrations/2025_07_11_021151_create_competences_table.php] created successfully.
   INFO  Controller [app/Http/Controllers/CompetenceController.php] created successfully.
   
   on dl les 3 fichiers
	"G:\WEB\BACKUP\Hostinger\HostingerTemp\PUBLICATION\2025_07_11_021151_create_competences_table.php"
	"G:\WEB\BACKUP\Hostinger\HostingerTemp\PUBLICATION\Competence.php"
	"G:\WEB\BACKUP\Hostinger\HostingerTemp\PUBLICATION\CompetenceController.php"

on modifie la migration , on up

on execute la migration : **php artisan migrate**	
   2025_07_11_021151_create_competences_table ......................................................... 18.40ms DONE
   
on verifie la structure sous phpmyadmin
```sql
   CREATE TABLE `competences` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL,
  `idp` bigint(20) UNSIGNED DEFAULT NULL,
  `code_rome` varchar(255) DEFAULT NULL,
  `code_formacode` varchar(255) DEFAULT NULL,
  `code_nsf` varchar(255) DEFAULT NULL,
  `code_rncp` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


ALTER TABLE `competences`
  ADD PRIMARY KEY (`id`),
  ADD KEY `competences_idp_foreign` (`idp`);


ALTER TABLE `competences`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;


ALTER TABLE `competences`
  ADD CONSTRAINT `competences_idp_foreign` FOREIGN KEY (`idp`) REFERENCES `competences` (`id`) ON DELETE CASCADE;
COMMIT;
```
----

on edite le model , surtout les fillables
on up
```php
        'nom',
        'idp',
        'code_rome',
        'code_formacode',
        'code_nsf',
        'code_rncp',
        'description',


```

---

on edite le controller


on cree un dossier views/competences avec cinq vues
- index.blade.php
- create.blade.php
- edit.blade.php
- show.blade.php
- _form.blade.php ← pour mutualiser create et edit

---


On crée une Route
```php
use App\Http\Controllers\CompetenceController;

Route::resource('competences', CompetenceController::class); 
```
on edite unsedder

[u990825784@fr-int-web1795 public_html]$ php artisan make:seeder CompetenceAiglon1Seeder

   INFO  Seeder [database/seeders/CompetenceParentSeeder.php] created successfully.
   
on execute seeder   
   
   php artisan db:seed --class=CompetenceParentSeeder

----




## Migrations
[Migration 1](../../srcLaravel/database/migrations/2025_07_11_021151_create_competences_table.php)

```php
Schema::create('competences', function (Blueprint $table) {
    $table->id();
    $table->string('nom');
    $table->unsignedBigInteger('idp')->nullable(); // Parent
    $table->foreign('idp')->references('id')->on('competences')->onDelete('cascade');

    $table->string('code_rome')->nullable();
    $table->string('code_formacode')->nullable();
    $table->string('code_nsf')->nullable();
    $table->string('code_rncp')->nullable();
    
    $table->text('description')->nullable();
    $table->timestamps();
});
```




```
Schema::create('competence_realisation', function (Blueprint $table) {
    $table->id();
    $table->foreignId('competence_id')->constrained()->onDelete('cascade');
    $table->foreignId('realisation_id')->constrained()->onDelete('cascade');
    $table->timestamps();
});
```

## tables
- competences
- competence_realisation

### competences

idp	Gère la hiérarchie entre compétences (ex: Maîtriser un logiciel → Maîtriser Excel).
nom	Intitulé clair de la compétence.
description	Détail contextuel (utile pour la VAE, les évaluations, ou l'auto-positionnement).
code_rncp	Lien avec un bloc de compétences RNCP.
code_formacode
code_rome	Référence vers une fiche métier ROME (Pôle emploi).
code_nsf	Nomenclature des spécialités de formation (NSF) pour rattacher à un domaine.


  
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
