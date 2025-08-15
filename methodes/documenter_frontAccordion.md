# Accordion

dans cet exmple tirée de w3c 
un bouton ou une zone de texte affiche ou masuqe une zone de détail en dessous

## Strucuture
un bouton auquel on a affecté la fonction myFunction2 sur son evenement click
un element div, identifé par son id **Demo2**, caché par la classe de style w3-hide
```html
<button onclick="myFunction2('Demo2')" class="w3-button w3-left-align w3-block">
    <i class="fa fa-calendar-check-o fa-fw w3-margin-right"></i> My Events
</button>
<div id="Demo2" class="w3-hide w3-container w3-signal-red">
  <p>Some other text..</p>
</div>
```
## Script
La fonction myFunction2 prend un argument **id**
- initialise la variable **x** avec un référence au noeud dont l'id est passé en argument
- si la classe w3-show n'est pas affecté à x, référence au noeud
  - on affiche x, en ajoutant la classe w3-show
  - on modifie le style du bouton, on ajoute la classe w3-theme-d1
- sinon
  - on masque x, en supprimant la classe w3-show des styles
  -  on modifie le style du bouton, on retire la classe w3-theme-d1

```js
// 
function myFunction2(id) {
  var x = document.getElementById(id);
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
    x.previousElementSibling.className += " w3-theme-d1";
  } else { 
    x.className = x.className.replace("w3-show", "");
    x.previousElementSibling.className.replace(" w3-theme-d1", "");
  }
}
```

## Evolutions
Ce composant peut representer les "Callout" d'Obsidian

Composant Blade


