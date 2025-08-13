
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

---
# Ressources 
un script php de travaux précédents pourra servir de base de travail et de sources d'inspiration
```php
class motcompose {
	public $uind = -1; // inconu en db
	public $lbl = null;
    public $sid = null;
//-----------------------------------------------------------------------------------------------
	function getMotComposeById( $uid ) { return QuerySelectWhere('d_motcompose' ,array( 'uind' => $uid)); }
//-----------------------------------------------------------------------------------------------
	function getMotComposeBySyntaxe( $stx ) { return QuerySelectWhere('d_motcompose' ,array( 'lbl' => $stx)); }
//-----------------------------------------------------------------------------------------------    
    public static function getBySyntaxe( $stx ) { return QuerySelectWhere('d_motcompose' ,array( 'lbl' => $stx)); }
//-----------------------------------------------------------------------------------------------
    public static function getLikeSyntaxe($stx) { return QueryLike( 'd_motcompose' ,$stx); }
//-----------------------------------------------------------------------------------------------
	public static function setBySyntaxe( $stx , $sid )
	{
		$ParamArray = array( 'lbl' => $stx , 'sid' => $sid );
		$tmp_uind = QueryInsert('d_motcompose',$ParamArray);
		return $tmp_uind;
	}

//migration table dic, lbl devient syntaxe
	//public function getMotLikeSyntaxe($stx) { return QueryLike( 'dmot' ,$stx); }
//-----------------------------------------------------------------------------------------------
	public function __construct($stx) { $this->lbl = $stx; }
//-----------------------------------------------------------------------------------------------
	public function toString() { return "uind $this->uind : syntaxe $this->lbl"; }
//-----------------------------------------------------------------------------------------------
// explose le mot compose, recheche le sid e tfiltre les ' (et autre ??)
    public static function makeStringSid($mcp)
    {
        $arMOTCOMP = explode( ' ' , $mcp ); //on recupere la chaine ex cheval de troie // prévoir mise en minuscule
        $iNBMO = count($arMOTCOMP);//nombre de mot attention l'hermite reste un seul mot
        $chaineSID ='';
        $tmp_uind = -1;
       
        for ( $i = 0 ; $i < $iNBMO ; $i++ )//pour chaque mot 
        {
            $tmpStr = $arMOTCOMP[$i];
            $finstr   = "'";//gestion des traits d'unions ??
            $pos = strpos($tmpStr, $finstr);//un mot inconnu le mot contient ' ??
            if ( !$pos ) //le mot ne contient pas ' on recherche dansla base si le mot existe
            { 
                $RS_MOT = \mot::getBySyntaxe($arMOTCOMP[$i]);//ajout al achaine sid
                if ( $RS_MOT != null) { $tmp_uind = $RS_MOT[0]['uind']; } 
                else { 
 //mot inconnu verifie rles droits et enregistrer
                    //on ajout ele mot et on recuper id
                    $tmp_uind = \mot::setBySyntaxe( $arMOTCOMP[$i] ); // retourne -1 ou id
                 }//return $tmp_uind;   //on ajoute le mot ?
            }
            else
            {
                if ($pos == 1 )//le mot  contient ' ex l'anthologie
                {
                    $tmpStr2 = substr( $tmpStr , 2 , (strlen($tmpStr)-2) );//$tmpStr2 = substr( $tmpStr , 2 , strlen($tmpStr) );
                    $RS_MOT = \mot::getBySyntaxe($tmpStr2);//on recherche dansla base si le mot existe
                    if ( $RS_MOT != null) 
                    { 
                        $tmp_uind = '0;' . $RS_MOT[0]['uind']; 
                    } 
                    else 
                    {
//mot inconnu verifie rles droits et enregistrer
//on ajout ele mot et on recuper id
                        $tmp_uind = '0;'. \mot::setBySyntaxe( $tmpStr2 ) . ';';
                        //$tmp_uind = '0;-1';// on a 0 pour l' ou d' et -1 mot inconnu 
                    }
                    // on met 0 pour ' le la ?? suivant regle et genre
                }// $pos == 1 .  2 a faire ex qu'illusion?



            }
            if ( $i < ( $iNBMO - 1 ) ) { $chaineSID .= $tmp_uind .';'; } else { $chaineSID .= $tmp_uind; }
        }
        //return 'Le mot composé ' . $mcp . ' est décomposée <br/>chaineSID = ' . $chaineSID; 
        //$tmp_uind = -1;
         return $chaineSID;   //on ajoute le mot ?   
    }
  //============================================================================================================================================
  //  on ajoute le mot ? 
  // cette fonction n'eregitre pa sle smots on peut ajouter la fonction en reprenant le code deinsertion makeStringSid 
  // le service  insertion utilise  makeStringSid qui ne renvoie pas de détail
  // 0 est ajouté pour les l' d'

      public static function makeStringTableAndSid( $mcp )
    {
        $arMOTCOMP = explode( ' ' , $mcp ); //on recupere la chaine ex cheval de troie // prévoir mise en minuscule
        $iNBMO = count($arMOTCOMP);//nombre de mot attention l'hermite reste un seul mot
        $chaineSID ='';
        $tmp_uind = -1;
        $tblmot = array();//count($this->Sections);
       
        for ( $i = 0 ; $i < $iNBMO ; $i++ )//pour chaque mot 
        {
            $tmpStr = $arMOTCOMP[$i];
            $finstr   = "'";//gestion des traits d'unions ??
            $pos = strpos($tmpStr, $finstr);//un mot inconnu le mot contient ' ??
            if ( !$pos ) //le mot ne contient pas ' on recherche dansla base si le mot existe
            { 
                $RS_MOT = \mot::getBySyntaxe($arMOTCOMP[$i]);//ajout al achaine sid
                
                if ( $RS_MOT != null) { $tmp_uind = $RS_MOT[0]['uind']; } 
                else 
                { 
                    $tmp_uind = -1;  
                }//return $tmp_uind;   //on ajoute le mot ?
                
                $tblmot[ count( $tblmot ) ] =array($tmp_uind,$tmpStr );
            }
            else
            {
                if ($pos == 1 )//le mot  contient ' ex l'anthologie
                {
                    $tmpStr2 = substr( $tmpStr , 2 , (strlen($tmpStr)-2) );//$tmpStr2 = substr( $tmpStr , 2 , strlen($tmpStr) );
                    
                    $RS_MOT = \mot::getBySyntaxe($tmpStr2);//on recherche dansla base si le mot existe
                    if ( $RS_MOT != null) 
                    { 
                        $tmp_uind = '0;' . $RS_MOT[0]['uind'];
                        $tblmot[ count( $tblmot ) ] =array($RS_MOT[0]['uind'],$tmpStr2 ); 
                    }
                     else 
                    {   //on n'enregistre pa sl d dans le tableau mais il doit figurer dans la chaien (pour recostruction??)
                        $tmp_uind = -1; 
                        $tblmot[ count( $tblmot ) ] =array($tmp_uind,$tmpStr2 ); 
                        $tmp_uind = '0;-1';

                    }// on met 0 pour ' le la ?? suivant regle et genre
                }// $pos == 1 .  2 a faire ex qu'illusion?
                
                //$tblmot[ count( $tblmot ) ] = $tmpStr2;
                
            }
            if ( $i < ( $iNBMO - 1 ) ) { $chaineSID .= $tmp_uind .';'; } else { $chaineSID .= $tmp_uind; }
        }
        //return 'Le mot composé ' . $mcp . ' est décomposée <br/>chaineSID = ' . $chaineSID; 
        //$tmp_uind = -1;
        $HtmlOut = $mcp .'<hr/>';
        $HtmlOut .= '<ul>';
        for ( $i = 0 ; $i < $iNBMO ; $i++ )//pour chaque mot 
        {
            $HtmlOut .='<li>';
            $HtmlOut .= $tblmot[$i][1];
            $HtmlOut .= ' [ ' . $tblmot[$i][0] . ' ]';
            $HtmlOut .='</li>';
        }
        $HtmlOut .= '</ul>';
        $HtmlOut .= '<hr/>' . $chaineSID;
        // return $chaineSID;   //on ajoute le mot ?   
        return $HtmlOut;     
    }
```



