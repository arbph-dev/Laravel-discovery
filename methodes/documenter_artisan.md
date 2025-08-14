# Artisan

# Chemin
pour exploiter artisan il faut déja etre dans le bon repertoire
- cd dossier
- cd sousdossier
- cd publicfolder


# Commandes courantes

php artisan make:model Image -m => model et migration
php artisan make:model Image -mcr => model migration et controller ressource

php artisan list

php artisan config:clear
php artisan cache:clear
php artisan clear-compiled
php artisan optimize:clear


# seeder

php artisan make:seeder CompetenceAiglon1Seeder
php artisan db:seed --class=CompetenceAiglon1Seeder

# script

## création d'un script
```bash
php artisan make:command SyncImages
```

Le script est créé dans **app/Console/Commands/SyncImages.php**
On l'implémente et définit sa **signature** images:sync

## execution d'un script
```bash
php artisan images:sync
```

