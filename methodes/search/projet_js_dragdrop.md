# drag drop 
voir 
- [w3schools](https://www.w3schools.com/html/html5_draganddrop.asp)
- [Demo](https://www.w3schools.com/jsref/tryit.asp?filename=tryjsref_ondrag_all)

## Zones draggable
les zones draggable sont définis ave l'attribut
```html
<p draggable="true" id="dragtarget">Drag me!</p>
```

## Events
on affecte event au document
- dragstart : detecte le début de mouvement drag et  prépare le transfert de données
- drag : déplacment de la zone draggable , peut ajouter des infos
- dragenter : on depalce le draggable sur un controle, peut ajouter des infos ou mettremodifier afficahge
- dragleave : detecte la sortie du draggable
- dragover : detecte la placmeent du draggable sur un element, on doit stopper l'event por permettre drop
- drop : detecte le relachement
- dragend : dernier event declecnhe detecte la fin du drag

### dragstart

```js
document.addEventListener("dragstart", function(event) {
  // The dataTransfer.setData() method sets the data type and the value of the dragged data
  event.dataTransfer.setData("Text", event.target.id);
  
  // Output some text when starting to drag the p element
  document.getElementById("demo").innerHTML = "Started to drag the p element.";
  
  // Change the opacity of the draggable element
  event.target.style.opacity = "0.4";
});
```

### drag

```js
// While dragging the p element, change the color of the output text
document.addEventListener("drag", function(event) {
  document.getElementById("demo").style.color = "red";
});
```

### dragenter
```js
// When the draggable p element enters the droptarget, change the DIVS's border style
document.addEventListener("dragenter", function(event) {
  if ( event.target.className == "droptarget" ) {
    event.target.style.border = "3px dotted red";
  }
});
```
### dragleave
```js
// When the draggable p element leaves the droptarget, reset the DIVS's border style
document.addEventListener("dragleave", function(event) {
  if ( event.target.className == "droptarget" ) {
    event.target.style.border = "";
  }
});
```

### dragover
```js
// By default, data/elements cannot be dropped in other elements. To allow a drop, we must prevent the default handling of the element
document.addEventListener("dragover", function(event) {
  event.preventDefault();
});
```


### dragend
```js
// Output some text when finished dragging the p element and reset the opacity
document.addEventListener("dragend", function(event) {
  document.getElementById("demo").innerHTML = "Finished dragging the p element.";
  event.target.style.opacity = "1";
});
```
### drop
```js
/* On drop - Prevent the browser default handling of the data (default is open as link on drop)
   Reset the color of the output text and DIV's border color
   Get the dragged data with the dataTransfer.getData() method
   The dragged data is the id of the dragged element ("drag1")
   Append the dragged element into the drop element
*/
document.addEventListener("drop", function(event) {
  event.preventDefault();
  if ( event.target.className == "droptarget" ) {
    document.getElementById("demo").style.color = "";
    event.target.style.border = "";
    var data = event.dataTransfer.getData("Text");
    event.target.appendChild(document.getElementById(data));
  }
});
```
