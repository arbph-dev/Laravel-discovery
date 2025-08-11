<!-- SIDEBAR id = mySidebar ( PC:visible TABLETTE=MOBILE:caché )
sur android ,elle apparait apres clique sur  icone"fa fa-bars" via onclick="w3_open()"
on utilise close a deux endroit sur la croix fa fa-remove et sur l'overlay qui cache la page
-->

  <nav class="w3-sidebar w3-bar-block w3-collapse w3-large w3-theme-l5 w3-animate-left" id="mySidebar">
    
    <!-- bouton de fermeture PC: caché , TABLETTE=MOBILE : visible -->
    <a href="javascript:void(0)" onclick="w3_close()" class="w3-right w3-xlarge w3-padding-large w3-hover-black w3-hide-large" title="Close Menu">
      <i class="fa fa-remove"></i>
    </a>
    
    <!-- MODIFIER  url = # sinon url relative ou absolue -->
    
    <h4 class="w3-bar-item"><b>Rubriques</b></h4>

    <!-- <a class="w3-bar-item w3-button w3-hover-black" href="./nicnum/arduino.html">Arduino</a> -->
    <a class="w3-bar-item w3-button w3-hover-black" href="./python/python.html">Python</a>
    <a class="w3-bar-item w3-button w3-hover-black" href="#">Link</a>
    <a class="w3-bar-item w3-button w3-hover-black" href="#">Link</a>
    
  </nav>

  <!-- Overlay de la barre de menu asombrit le document lorsqu elle est déployée on ferme SIDEBAR sur un clic-->
  <div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>
