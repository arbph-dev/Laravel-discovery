On va créer un module gestion des taches

on doit tester [mermaid.js](https://mermaid.js.org/), cette librairie permet de réaliser,entre autre, les garpiques suivants:

- [gantt](https://mermaid.js.org/syntax/gantt.html)
- [kanban](https://mermaid.js.org/syntax/kanban.html)

25-08-12 : Essai Mermaid.js
- [Mermaid.js - Graphe](../../srcHtml/mermaid_graphe.html) voir [en ligne](https://elfennel.fr/public/mmgraf.html)
- [Mermaid.js - Kanban](../../srcHtml/mermaid_kanban.html) voir [en ligne](https://elfennel.fr/public/mmkb.html)
- [Mermaid.js - Gantt](../../srcHtml/mermaid_gantt.html) voir [en ligne](https://elfennel.fr/public/mmgantt.html)

# TODO
- déployer des graphiques mermaid sous laravel 
- lecture doc => creation fichier
- upload vers serveur : /public/mmkb.html
- url : https://elfennel.fr/public/mmkb.html


## Bilan des essais
### Graphe
aucun souci => voir + en détail pour usage et style
### Kanban
aucun souci => voir + en détail pour usage et style
### Gantt
Le code de l'exemple [interaction](https://mermaid.js.org/syntax/gantt.html#interaction) ne fonctionnait pas.
Il faut assigner les gestionnaires d'evenement à window du fait que le script soit déclaré avec un attribut module.

Le choix de la syntaxe meta est à réaliser,se reporter à [gantt syntax](https://mermaid.js.org/syntax/gantt.html#syntax)
Celle de l'exemple nécessite un encodages des durées
Celle proposé par l'IA repose sur date de debut, date de fin
```
    gantt
      dateFormat  YYYY-MM-DD

      section Clickable
      Visit mermaidjs         :active, cl1, 2014-01-07, 3d
      Print arguments         :cl2, after cl1, 3d
      Print task              :cl3, after cl2, 3d
```
Celle proposé par l'IA repose sur date de debut, date de fin
```
    Tâche 1   :done,    2025-08-01, 2025-08-03
```
### Conclusion 
Gantt nécessite des choix, d'autres graphiques sont à voir.
- [timeline](https://mermaid.js.org/syntax/timeline.html)
- [userJourney](https://mermaid.js.org/syntax/userJourney.html)

 
Une note de synthèse sur 
- diagramme Mermaid / Kanban est à finaliser (style? interaction?) [doc/tools/Mermaid](../docs/tools/Mermaid.js)
- diagramme Mermaid / Gantt est à créer (syntaxe , style , interaction => fonction assigné à windows )

---

# proposition IA
l'IA prévoit:
- Le modèle Tache et ses relations
- Les helpers pour formatter les données pour Gantt et Kanban
- La syntaxe Mermaid à utiliser pour ces deux vues
- Les 3 vues (showTable, showKanban, showGantt)

### modèle Tache et ses relations

#### structure des données

| Champ         | Type                              | Utilisation                  |
| ------------- | --------------------------------- | ---------------------------- |
| `id`          | int                               | PK                           |
| `user_id`     | int                               | Lié au créateur/propriétaire |
| `titre`       | string                            | Nom de la tâche              |
| `description` | text                              | Détails                      |
| `statut`      | enum(`todo`, `doing`, `done`)     | Pour le kanban               |
| `date_debut`  | date                              | Pour Gantt                   |
| `date_fin`    | date                              | Pour Gantt                   |
| `priorite`    | enum(`basse`, `moyenne`, `haute`) | Optionnel                    |
| `progression` | int (0-100)                       | Pour Gantt                   |
| `created_at`  | timestamp                         |                              |
| `updated_at`  | timestamp                         |                              |

## table : (non fourni par IA)
Tache => tache
Tache_User =>  tache_user

## migration
a abrorder apres reflexion

## model

### relations Tache User
Tache belongsTo User <=> User hasMany Tache  


**a coniséderer** : tache  mutliuser on doit prevoir un utilsateur responsable et de sutilisateurs executants

## Helpers ( fourni par IA)
dans app/Helpers/TacheHelper.php

### Kanban 
l'IA proposer de gérer Kanban
```
---
title: Kanban
---
kanban
    column ToDo
        "Tâche 1"
        "Tâche 2"
    column Doing
        "Tâche 3"
    column Done
        "Tâche 4"

```
ce qui ne correpond pas à la [documentation](https://mermaid.js.org/syntax/kanban.html)

1. l'utilisation de yaml permettrait une [configuration](https://mermaid.js.org/syntax/kanban.html#configuration-options)
2. l'exemple met clairement le point sur l'[usage de meta](https://mermaid.js.org/syntax/kanban.html#adding-metadata-to-tasks) comme vu dans le wiki 

```
kanban
todo[Todo]
  id3[Update Database Function]@{ ticket: MC-2037, assigned: 'knsv', priority: 'High' }
```

Pour cela l'IA propose d'implémenter
```php
public static function toMermaidKanban($taches)
{
    $columns = [
        'todo' => [],
        'doing' => [],
        'done' => []
    ];

    foreach ($taches as $t) {
        $columns[$t->statut][] = $t->titre;
    }

    $mermaid = "---\ntitle: Kanban\n---\nkanban\n";
    foreach ($columns as $colName => $tasks) {
        $mermaid .= "    column " . ucfirst($colName) . "\n";
        foreach ($tasks as $taskTitle) {
            $mermaid .= '        "' . addslashes($taskTitle) . "\"\n";
        }
    }

    return $mermaid;
}

```

### gantt
Je n'ai rien lu sur ce sujet , à ce stade. 
l'IA proposer de gérer gantt
```
gantt
    title Planning des tâches
    dateFormat  YYYY-MM-DD
    section Projet
    Tâche 1   :done,    2025-08-01, 2025-08-03
    Tâche 2   :active,  2025-08-04, 2025-08-07
    Tâche 3   :         2025-08-05, 3d
```

avec ce helper
```php
public static function toMermaidGantt($taches)
{
    $mermaid = "gantt\n";
    $mermaid .= "    title Planning des tâches\n";
    $mermaid .= "    dateFormat  YYYY-MM-DD\n";
    $mermaid .= "    section Tâches\n";

    foreach ($taches as $t) {
        $status = match($t->statut) {
            'done'  => 'done',
            'doing' => 'active',
            default => ''
        };

        $mermaid .= "    {$t->titre} :{$status}, {$t->date_debut}, {$t->date_fin}\n";
    }

    return $mermaid;
}
```

## Controller TacheController

Contrôleur TacheController

Actions principales :
- showTable($id) → liste tabulaire des tâches d’un user
- showKanban($id) → appelle TacheHelper::toMermaidKanban() et affiche
- showGantt($id) → appelle TacheHelper::toMermaidGantt() et affiche

## Vues
- showTable.blade.php → HTML <table> avec colonnes (Titre, Statut, Dates, Progression)
- showKanban.blade.php → <pre class="mermaid">{!! $mermaidKanban !!}</pre> + script Mermaid
- showGantt.blade.php → <pre class="mermaid">{!! $mermaidGantt !!}</pre> + script Mermaid
