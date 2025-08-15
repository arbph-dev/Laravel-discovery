# Module vaeexps
Gère les expériences professionnelles, **vaeexp**, associées à des [organisations](../organisations/index.md) (employeur)

on commence la saiti du module avec : **php artisan make:model** 
- saisir le nom de model Vaeexp en respectant les convnetions de notation Laravel
- choisir migration et resource controller

   INFO  Model [app/Models/Vaeexp.php] created successfully.
   INFO  Migration [database/migrations/2025_07_06_093519_create_vaeexps_table.php] created successfully.
   INFO  Controller [app/Http/Controllers/VaeexpController.php] created successfully.

on dl les 3 fichiers

## Migrations
[migration 1](../../srcLaravel/database/migrations/2025_07_06_093519_create_vaeexps_table.php)

La migration est a compléter. 
Noter l'instruction nécessaire pour la relation. Si on supprime une orgnaisation on supprime les vaeexps
```php
$table->foreignIdFor(App\Models\Organisation::class)->constrained()->onDelete('cascade');
```

```php
Schema::create('vaeexps', function (Blueprint $table) {
    $table->id();
    $table->date('dd');         // date de debut
    $table->date('df');         // date de fin
    $table->string('fonction'); // poste occupé techicien, agent de maitrise
    $table->tinytext('description'); // poste occupé techicien, agent de maitrise
    $table->timestamps();
    $table->foreignIdFor(App\Models\Organisation::class)->constrained()->onDelete('cascade');
});
```
on execute la migration : **php artisan migrate**
   INFO  Running migrations.
  2025_07_06_093519_create_vaeexps_table ................................................................ 18.00ms DONE

### Table de la base de données

on regarde la Structure de la table vaeexps sur phpmyadmin depuis hpanel
organisation_id a bien été créé dans la table de données vaeexps

```sql
CREATE TABLE vaeexps (
  id bigint(20) UNSIGNED NOT NULL,
  dd date NOT NULL,
  df date NOT NULL,
  fonction varchar(255) NOT NULL,
  description tinytext NOT NULL,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL,
  organisation_id bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
```

## Model Vaeexp
model : [Vaeexp](../../srcLaravel/app/Models/Vaeexp.php)

```php
    protected $table = 'vaeexps';
```
```php
    protected $fillable = [
        'dd',
        'df',
        'fonction',
        'description',
        'organisation_id'
    ];
```
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
```php
    public function organisation()
    {
        return $this->belongsTo(Organisation::class);
    }
```




### Methodes
#### getDureeAttribute
Détermine une durée pour l'expérience, noter usage de Carbon qui requiert un import
```php
    public function getDureeAttribute()
    {
        if ($this->dd && $this->df) {
            return Carbon::parse($this->dd)->diff(Carbon::parse($this->df))->format('%y ans, %m mois');
        }
        return null;
    }
```
## Controller
controleur : [VaeexpController](../../srcLaravel/app/Http/VaeexpController.php)


## route
Les routes sont gérées dans[web.php](../../srcLaravel/routes/web.php)

## views
- [vaeexps._form](../../srcLaravel/resources/views/vaeexps/_form.blade.php)  (commun a create et edit)
- [vaeexps.create](../../srcLaravel/resources/views/vaeexps/create.blade.php)
- [vaeexps.edit](../../srcLaravel/resources/views/vaeexps/edit.blade.php)
- [vaeexps.index](../../srcLaravel/resources/views/vaeexps/index.blade.php)
- [vaeexps.show](../../srcLaravel/resources/views/vaeexps/show.blade.php)

<!-- 
## Outils
### command artisan
### seeder


### Helpers
[OrganisationSeeder](../../srcLaravel/database/seeders/OrganisationSeeder.php)
-->


