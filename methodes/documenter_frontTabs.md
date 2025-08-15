# systeme d onglet

on reprend la documentation du w3c

le système d onglet est géré par 
- un div contenant la barre de navigation
- les onglets, implémentés, par le biais d'element ou noeuds div
- un script

## Structure

chaque onglet est un noeud div avec
- id et name 
- classe de style 
  
chaque onglet 
- à un id
- utilise une classe de style

On masque les onglets en ajoutant : style="display:none" sauf pour l'onglet a afficher par défaut; ici Londres ;)

```html
<!--  barre de navigation     -->
<div class="w3-bar w3-black">
  <button class="w3-bar-item w3-button" onclick="openCity('London')">London</button>
  <button class="w3-bar-item w3-button" onclick="openCity('Paris')">Paris</button>
  <button class="w3-bar-item w3-button" onclick="openCity('Tokyo')">Tokyo</button>
</div>
 
<!-- premier onglet -->
<div id="London" class="city">
  <h2>London</h2>
  <p>London is the capital of England.</p>
</div>

<!-- deuxieme onglet  -->
<div id="Paris" class="city" style="display:none">
  <h2>Paris</h2>
  <p>Paris is the capital of France.</p>
</div>

<!--  troisieme onglet     -->
<div id="Tokyo" class="city" style="display:none">
  <h2>Tokyo</h2>
  <p>Tokyo is the capital of Japan.</p>
</div>
```
## script

Pour réaliser l'interaction on utilise javascript. 

- La fonction **openCity**  prend un argument **cityName**
- La fonction initiliase les variables
  - i est une variable temporaire 
  - x continet la collection de tous les elements du document de **classe city**, on emploie une méthode DOM **getElementsByClassName**
- pour i de 0 à longueur de x
  - masque l'element de la collection **x[i]** en affectant none à la propritété style.display
- affiche l'element dont le nom est passée dans l'argument **cityName**
 
```html
<script>
function openCity(cityName) {
  var i;
  var x = document.getElementsByClassName("city");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";
  }
  document.getElementById(cityName).style.display = "block";
}
</script>
```


## Evolutions
ce système d'onglet est un bon point de départ mais il doit etre améliorer.
- Le contenu se déplace selon ce qui est placé dans les onglets
- principe outerdiv innerdiv est a tester
- composant laravel

