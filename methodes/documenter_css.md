# CSS

une série de layout doit permettre de déployer différentes solutions

- Tailwind
- W3.css
- Bootstrap

Tailwind et Bootstrap => pas convaicnu specialment pour les tableaux

## Pure css
nécessite un travail de fond mais présente l'avantage de la flexibilité
mis en oeuvre pour le layout[pure](../srcLaravel/resources/views/layouts/pure.blade.php)

On applique un style aux élements de structure h1, ou noeuds, de tout le document
On définit la couleur de l'element ou noeud body
```css
h1 {color : red ;  padding-left : 0;}

```
On définit une classe de style que l'on appliquera aux noeuds et elements du document
```css
.Titre1 {color : red ;  padding-left : 0;}
```

On définit une classe de style à un noeud spécifique du document
```css
#overlay {background-color : rgb(50,50,50); }
```


## Tailwind
consulter [Tailwind](https://tailwindcss.com/)
mis en oeuvre pour le layout[pure2](../srcLaravel/resources/views/layouts/pure2.blade.php)

CDN 
```html
<script src="https://cdn.tailwindcss.com"></script>
```
Syntaxe
```html
<h1 class="text-3xl font-bold underline">Info</h1>
```

---
## W3.css
consulter [w3.css](https://www.w3schools.com/w3css/w3css_intro.asp)
mis en oeuvre pour le layout[pure3](../srcLaravel/resources/views/layouts/pure3.blade.php)

```html
<div class="w3-container w3-teal">
  <h1>This is a Header</h1>
</div>

```

```html
<link rel="stylesheet" href="https://www.w3schools.com/w3css/5/w3.css">

<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-amber.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-black.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-red.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-teal.css">
```


---
## Bootstrap
consulter [Bootstrap](https://getbootstrap.com/docs/3.3/getting-started/)  
mis en oeuvre pour le layout[pure4](../srcLaravel/resources/views/layouts/pure4.blade.php)

utiliser bootstrap en CDN
```html
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css">
```

## font-awesome
cette libraiire d'icone peut servir pour compléter les icones Unicode

utiliser font-awesome en CDN
```html
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
```

Une liste permet de retrouver les icones => lien ?
```html
<i class="fa fa-search"></i>
<i class="fa fa-volume-up"></i>
<i class="fa fa-wifi"></i>
<i class="fa fa-battery-2"></i>
<i class="fa fa-bars"></i>
```

# Css et laravel

Le style est appliqué dans 
- les templates et composants
- les sections de layout
- les slots de composant

on doit gérer le style pour les templates et composants, un contenu est mis en forme dans un bloc div de classe Content
plusieurs solutions sont possibles

1. le style est associé a chaque balises du contenu, pour les tests ou certains cas délicats mais à éviter en général
2. le style est inclus dans l'entete ou  lier et on spécifie la classe a chaque balise
3. le syle est inclus, on a arrêté une structure de document on spécifie les classes des elements

le style ci dessous peut etre appliqué à un noeud div dans un template ,un composant ou du contenu
```html
.Content { max-width : 1200px;  margin-left : auto; margin-right : auto;}
```
## 1 - style associé au balise
avec cete option on écrit
```html
<div style="max-width:1200px;margin-left:auto;margin-right:auto;">contenu<div>
```
l'inconvénient évident est le manque de lisibilité, la difficulté de la syntaxe et les dificultés de maintenance et d'évolution.

## 2 - classe de style
Maintenant on spécifie uniquement la classe ou les classes

```html
<div classe="Content">contenu<div>
```
Le code est déja plus lisible, on modifiera la classe plutot que tout les styles des balises. mais il faut se repoorter au code ou la documentation pour information

Cette solution est celle que l'on mettra en oeuvre avec les frameworks css, les frameworks propose des classes que l'on peut combiner
```html
<h1 class="text-3xl font-bold underline">classes tailwind</h1>

<div class="w3-container w3-teal">classe w3.css</div>
```

C'est mieux mais si vous décidez de remplacer un style en changeant une classe d'un element de menu il vous faudra propablement le faire pour d'autres

## 3 - style appliqué à la structure

```html
<article>
  <div>
    <h1>contenuTitre<h1>
    <div>contenuContent<div>
  </div>
</article>
```
Cette méthode fonctionne bien avec les templates et composant qui auront une structure arrétée qui évoluera peu.
Dans le css on gère la structure ainsi
```css
article {color : blue ;  margin-left : 5%;}
article.div {padding : 5%;}
article.div h1 {color : red ;  padding-left : 0;}
article.div div {color : navy ;  padding-left : 5%;}
```

Cette méthode est la plus "académique" ,présente aussi quelques inconvénients, mais est très utile notamment pour la partie RWD

# Style des composant

Les composants laravel emploieront des styles il est préférable d'employer une méthode.
On peut utiliser les classe de framework ou utiliser du css pur, c'est mon choix 

on emploie dans des vues un composant page pour le contenu principale, les styles associés seront prefixés **cp_page**
- cp pour composant
- page nom du composant

Le choix de ne pas gérer la structure peut se justifier du fait qu'on peut dévelloper un composant sans savoir ou il sera intégré
Dans une solution livrable on peut intégrer le css dans le code du composant directement, dans le cadre d'un projet on prefere centraliser le style

exemple de rendu
```html
<section class="cp_page_section" >
	<blockquote class="cp_page_citation"></blockquote>
	<h1 class="cp_page_Titre1"></h1>
	<p class="cp_page_paragraphe"></p>
	<p class="cp_page_signature"></p>
</section>
```

ici le composant est fait pour intégrer un div identifié divpage
on peut définir le style de plusieurs façons
```css
.cp_page_Titre1 {color : red ;  padding-left : 0;}

div section h1 {color : red ;  padding-left : 0;}
divpage section.cp_page_section h1 {color : red ;  padding-left : 0;}
divpage section.cp_page_section h1.cp_page_Titre1 {color : red ;  padding-left : 0;}
```

## Composant formulaire
un formualire se définit par un noeud form qui contient des elements :
- label for pour les champs 
- link
- div ou span
- button
- submit

pour chacun de ces elements d'un composant form on définit de styles
- .cp_form
- .cp_form-label
- .cp_form-link
- .cp_form-error
- input.cp_form-field
- input[type=submit].cp_form
- input[type=submit]:hover.cp_form


# Structures 
La structure du projet évoluera, depusi l'implémentation des formulaire d'autentification j'ai réalisé de nombreux essais.

on décrit la structure de base
- Navbar
- Header
- Content
- Footer

Cette strucutre doit permettre de délivrer du contenu à des clients grands ecran, pc, tablette et mobileS
Il faudra donc intéger la notion de Responsive Web Design (a documenter plus en détail...)

## Navbar
Réalisé en deux parties, avec le framework w3.css. Cette methode bien que redondante est assez facile a gérer
- pc et mobile : barre en haut, la mahjorité des elements sont masqués sur mobile on laisse le strict minimum du fait d'une larguer réduite
- mobile : barre de naviagation en haut avec un minimum d'informations et un bouton. Le bouton fait apparaitre la barre de navigation (à gauche ici)   

DOCUMENTER fonction javascript myFunction
- la navbar mobile a un id : **navDemo**
- une icone , invisible sur "pc" permet d'afficher la navbar 


```html
    <!-- Navbar -->
    <div class="w3-top">
      <!-- Navbar pc  + mobile (reduit + bouton)-->

      <div class="w3-bar w3-red w3-card w3-left-align w3-large">
        <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-red" href="javascript:void(0);" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
        <a href="#" class="w3-bar-item w3-button w3-padding-large w3-white">Home</a>
        <a href="#" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Link 1</a>
        <a href="#" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Link 2</a>
        <a href="#" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Link 3</a>
        <a href="#" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Link 4</a>
      </div>
      
      <!-- Navbar on small screens -->
      <div id="navDemo" class="w3-bar-block w3-white w3-hide w3-hide-large w3-hide-medium w3-large">
        <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 1</a>
        <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 2</a>
        <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 3</a>
        <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 4</a>
      </div>
    </div>
```

##  header
toujours avec le framework w3.css, l'entete du document contient 
- titre
- image
- description
```html
<header class="w3-container w3-red w3-center" style="padding-top:48px">
  <h1 class="w3-margin w3-animate-opacity">Les Robots pompiers</h1>
  <img class="w3-image" src="./pompier_robots.jpg" alt="robot pompier" width="600" height="400">
  <p class="w3-xlarge">description</p>
</header>
```
