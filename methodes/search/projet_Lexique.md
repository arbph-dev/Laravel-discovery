
🧱 🔍 🛠️ 📦 🔄 🚧 📚 🧪 ➕ ✅

un module lexique avancé permettrait :

- indexer des mots et expressions dans toutes les parties texte de ton application,
- construire un réseau sémantique (type moteur de recherche, ou annotation automatique),
- enrichir le SEO,
- faciliter des assistants rédactionnels, ou la génération de glossaires contextuels.

# Structure 
requete sql pour table mots
migrations pour tables motcomposes (avec champ sid) et mots_usages pour suivre leur utilisation
        
## Table mots
```sql
    CREATE TABLE mots (
      rowid INTEGER PRIMARY KEY AUTOINCREMENT,
      lbl TEXT NOT NULL
    );
```
## Table des mots composés (motscomposes)
champs : 
- uind
- lbl
- sid (chaîne de mots élémentaires)


Base de données / Import
Un import massif depuis mots.sql permettra de disposer d'une base de travail


# Modules
- Mots
- MotsComposes

# MotComposes
## recherche

## Indexation
permet d'indexer des expressiosn comme : cheval de Troie 
- Décomposer une expression  : cheval , de, Troie ; explode chaine sur espace
- Associer à chaque mot un uind dans mots => 17452 , 19521 , 450011
  - quid de la syntaxe des mots Troie <> troie
- Gérer les cas particuliers comme les articles  (l’,le, la les d’…)
- Générer une chaîne sid (séquence d’identifiants)
  - "0" pour les mots ignorés mais structurellement présents (comme "de")
  - cheval de Troie => 17452;0;450011 ; 

Résultat attendu: cheval de Troie =>
- uind = 12544
- lbl = cheval de Troie
- sid (chaîne de mots élémentaires)SID : 17452;0;450011

### Décomposer une expression
une phrase et découpé puis analysé

#### cas simples (explode sur espace)

#### Mots inconus
Il faut prévoir les mots inconnus à ajouter dans mots puis dont il faut recupérer les id

#### traitement des apostrophes  
Le traitement des apostrophes, implique de modifier les chaines.
Exemple : L'hydre de lerne 
on commence :
offsetString = 0
strRAW = "L'hydre de lerne" 

on recherche un espace ou un ' ou  ...
  on detecte un ' en positionStop 1
    positionSearch = positionStop + 1
    check positionSearch (=2)  = caractere 
      oui  => on continuera 
      sinon => positionSearch = positionSearch +1 ( =3)
        check positionSearch (=2)  = caractere 
          oui  => on continuera
          sinon => erreur ou retourne -1
    on continue
    on supprime une partie de chaine strRAW de offestString , pour une longueur de  positionSearch
      => 1 er cas "L'hydre de lerne"  avec offsetString = 0 , positionSearch = 2 
      on suprime strRAW[0] = L et strRAW[1] = '
      => 2 eme cas "L' hydre de lerne"  avec offsetString = 0 , positionSearch = 3
      on suprime strRAW[0] = L strRAW[1] = ' et strRAW[2] = espace
      offsetString = positionSearch
      positionSearch = positionSearch+1

 

## Helper Laravel (service ou trait)

un service LexiqueService dans app/Services/LexiqueService.php :
methodes : 
- getMotUid
- makeSidFromPhrase

```php
namespace App\Services;

use Illuminate\Support\Facades\DB;

class LexiqueService
{
    public static function getMotUid(string $mot): int
    {
        $row = DB::table('mots')->where('lbl', $mot)->first();

        if ($row) return $row->rowid;

        return DB::table('mots')->insertGetId(['lbl' => $mot]);
    }

    public static function makeSidFromPhrase(string $phrase): string
    {
        $mots = explode(' ', strtolower($phrase));
        $sid = [];

        foreach ($mots as $mot) {
            if (preg_match("/^([ldmctn])’(.+)$/iu", $mot, $match)) {
                $sid[] = 0;
                $mot = $match[2];
            }

            $sid[] = self::getMotUid($mot);
        }

        return implode(';', $sid);
    }
}
```

utilisation dans un contrôleur :
```php
use App\Services\LexiqueService;

$phrase = "l’asymptote divergente";
$sid = LexiqueService::makeSidFromPhrase($phrase);

dd($sid); // ex: "0;123;456"
```


Module "Lexique" doit permettre de
- consulter les mots (/lexique)
- rechercher un mot ou une expression
- voir toutes les expressions contenant un mot
- Glossaire dans les contenus
- Ajout de synonymes	Pour enrichir la recherche
- Dictionnaire technique	Par domaine (électrotechnique, chimie…)
- Traduction automatique	Pour multilingualité
- Annotation automatique	Générer des liens, infobulles…
- Suggestion orthographique	Correction de fautes
- gestion des types grammaticales
- gestion des conjugaison
- API REST ou JSON pour fournir des suggestions (frontend JS)

Fonctionnalitées:
- enrichir l’interface utilisateur avec surlignage dynamique ?
  Créer un helper de surlignage sémantique. Ce helper pourrait être appliqué à toutes les recherches,descriptions ou réalisations.
  
```php
function highlightKnownWords(string $content): string {
    $mots = DB::table('mots')->pluck('lbl')->toArray();
    foreach ($mots as $mot) {
        $content = preg_replace("/\b($mot)\b/ui", '<span class="mot" data-term="$1">$1</span>', $content);
    }
    return $content;
}
```

- créer le composant Blade pour afficher les mots ou suggestions ?


