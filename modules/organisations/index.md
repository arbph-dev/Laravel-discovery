# Organisations
Ce module gère les organisations : entreprise, association, insititutions

Deux cas d'emploi : 
- organisation -> expérience professionelle
une organisation a été le vecteur d'une expérience professionelle (employeur)

- réalisation -> organisation
une réalisation, d'une expérience professionelle, est lié à une organisation (client)

A ce stade : pas de relations réalisations avec les prestataires


## Migrations


<!-- 

### Table de la base de données
## Model
### Relations
### Methodes
## Controller
### Helpers
## route 
## views

## Outils
### command artisan
### seeder
-->

table : organisations
model : Organisation
controleur : OrganisationController

Vues : 
organisations._form  (commun a create et edit)
organisations.create
organisations.edit
organisations.index
organisations.show
