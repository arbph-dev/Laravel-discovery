# Relations

Laravel peut fonctionner avec Mysql ou SqlLite
L'intégrité réferentielle est géré par Laravel et se définit dans les migrations, l'intégrité réferentielle veille à la cohérence des données

Nous avons des publications, dans une table article. Un article est supprimé. Si l'on ne prend pas garde tous les commentaires associés resteront dans une table Comments
L'intégrité referentielle permettra ou non la suppresion de l'article, ou encore supprimera tous les commentaires associés. Ceci selon la configuration adapoté dans les migrations


## A noter 
Une bonne pratique est de réaliser sytématiquement les duex relations meme si elles ne servent pas, dans l'instant.

les methodes sont utilisés par les controller commes des propiétés

Un model User :
- inclue l'interface HasOne
- possède une méthode phone() qui implémente une interface HasOne permettant d'établir la relation
```php
namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
 
class User extends Model
{
    public function phone(): HasOne
    {
        return $this->hasOne(Phone::class);
    }
}
```
Un Controller stocke le numéro de téléphone, le numéro est récupé comme s'il s'agissait d'une propriété (sans parenthèses)

```php
$phone = User::find(1)->phone;
```

## Type de relations à deux clefs
on distingue différentes relations entre les données
- un à un : un utilsateur unique d'une table User à un profil unique dans une table profile
- un à plusieurs :  1 employeur propose des offres d emploi, une offre d'emploi appartient à un employeur unique. 
- plusieurs à plusieurs : un article comporte plusieurs Tags , les Tags peuvent être associés à plusieurs articles

### Relation un a un
Un utilisateur , model User, a un profil , model Profile, contenant le numéro de téléphone dans une propriété phone

La relation est réciproque :
- L'utilisateur unique possède un numéro unique 
- Un numéro correpsond à un utilisateur unique

on établit la relation entre les Model User et Profile
- Model User, ajout d'une méthode profile(). relation **hasOne**
- Model Profile, ajout d'une méthode user(). relation **??**


#### Migrations => ??


### Relation un à plusieurs
1 employeur propose plusieurs postes dans son organisations, une offre d'emploi appartient à un employeur unique

on établit la relation entre les Model Employer et Job
- Model Employer, ajout d'une méthode jobs(). relation **hasMany**
- Model Job, ajout d'une méthode employer(). relation **belongsTo**

la notation jobS indique plusieurs, employer un seul employeur;c'est une convention 

### Relation de plusieurs a plusieurs 
Plusieurs tags peuvent être associé a un article mais un même tag peut être employé pour plusieurs articles 

Ce type de relation nécessitera une table intermédiaire appelée PivotTable 

**image_realisation**



--- 
## lectures

[30 days to learn laravel - Day 11 : Two Key Eloquent Relationship Types](https://laracasts.com/episodes/3136) 
[30 days to learn laravel - Day 12: Pivot Tables and BelongsToMany Relationships]([https://laracasts.com/episodes/3136](https://laracasts.com/episodes/3137)) 

