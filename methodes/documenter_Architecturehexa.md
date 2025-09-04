# Architecture hexagonale appliquée à une app front

On disitingue dans une architecture hexagonale :
- Domaine (core) : Représente la logique métier pure.
  Ici → l’entité Mot, les cas d’usage (CRUD, pagination, recherche).
  Ne dépend ni du DOM ni d’API externes.

- Ports (interfaces) :Définissent ce que le domaine attend comme service.
Exemple : IMotRepository (avec list, getById, create, update, delete).

- Adapters (implémentations) : Connectent le domaine avec le "monde extérieur".

Exemple :
Adapter REST (fetch vers jsonplaceholder ou ton backend).
Adapter LocalStorage (pour simuler).
Adapter UI (Web Components qui implémentent une interface visuelle).
