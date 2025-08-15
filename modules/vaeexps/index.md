# Module vaeexps
Gère les expériences professionnelles, **vaeexp**, associées à des [organisations](../organisations/index.md) (employeur)


## Migrations
[migration 1](../../srcLaravel/database/migrations/2025_07_06_093519_create_vaeexps_table.php)

### Table de la base de données

## Model Vaeexp
model : [Vaeexp](../../srcLaravel/app/Models/Vaeexp.php)

```php
    protected $table = 'vaeexps';

    protected $fillable = [
        'dd',
        'df',
        'fonction',
        'description',
        'organisation_id'
    ];

    public function getDureeAttribute()
    {
        if ($this->dd && $this->df) {
            return Carbon::parse($this->dd)->diff(Carbon::parse($this->df))->format('%y ans, %m mois');
        }
        return null;
    }
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
### Methodes
#### getDureeAttribute
Détermine une durée pour l'expérience

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


