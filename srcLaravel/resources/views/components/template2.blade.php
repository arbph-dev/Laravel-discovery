<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        
        <link rel="stylesheet" href="./public/build/assets/app.css">


        <script src="./public/build/assets/laramain.js">
        </script>
        
        <script type="text/javascript">
            const mySidebarId = "mySidebar";
            const myOverlayId = "myOverlay";
            const myDbgbarId = "myDebugbar";
        </script>

    

    </head>
    <body>
<!-- ==================================================================================== -->
        <div class="bandeau">
            <!--  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  * -->
            <svg width="1920" height="150" viewBox="0 0 1920 150" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <!-- Dégradé pour l'éclair -->
                    <linearGradient id="electricGradient" x1="0" y1="0" x2="1" y2="0">
                    <stop offset="0%" stop-color="#00f" />
                    <stop offset="50%" stop-color="#0ff">
                        <animate attributeName="stop-color" values="#0ff;#fff;#0ff" dur="0.6s" repeatCount="indefinite" />
                    </stop>
                    <stop offset="100%" stop-color="#00f" />
                    </linearGradient>
                    <!-- Dégradé de fond -->
                    <linearGradient id="backgroundGradient" x1="0" y1="0" x2="1" y2="0">
                        <stop offset="0%" stop-color="#0a0f25" />
                        <stop offset="100%" stop-color="#0b1a40" />
                    </linearGradient>
                    <!-- Dégradé pour les éclairs -->
                    <linearGradient id="lightningGradient" x1="0" y1="0" x2="0" y2="1">
                        <stop offset="0%" stop-color="#ffd700" />
                        <stop offset="100%" stop-color="#ff8c00" />
                    </linearGradient>
                    <!-- Filtre pour l'effet de lueur -->
                    <filter id="glow" x="-50%" y="-50%" width="200%" height="200%">
                        <feGaussianBlur stdDeviation="4" result="coloredBlur"/>
                        <feMerge>
                        <feMergeNode in="coloredBlur"/>
                        <feMergeNode in="SourceGraphic"/>
                        </feMerge>
                    </filter>
                </defs>
                <!-- Fond -->
                <rect width="1920" height="150" fill="url(#backgroundGradient)" />
                <!-- Cercle central représentant le plasma -->
                <circle cx="960" cy="75" r="50" fill="#1e3a5f" filter="url(#glow)">
                    <animate attributeName="r" from="45" to="55" dur="1.5s" repeatCount="indefinite" />
                    <animate attributeName="fill" values="#1e3a5f;#224670;#1e3a5f" dur="2s" repeatCount="indefinite" />
                </circle>
                <!-- Éclairs stylisés -->
                <path d="M960,25 Q970,50 960,75 Q950,100 960,125" stroke="url(#lightningGradient)" stroke-width="2" fill="none" filter="url(#glow)">
                    <animate attributeName="stroke-width" from="1" to="3" dur="0.5s" repeatCount="indefinite" />
                    <animate attributeName="opacity" from="0.5" to="1" dur="0.5s" repeatCount="indefinite" />
                </path>
                <path d="M920,50 Q930,75 920,100" stroke="url(#lightningGradient)" stroke-width="2" fill="none" filter="url(#glow)">
                    <animate attributeName="stroke-width" from="1" to="3" dur="0.7s" repeatCount="indefinite" />
                    <animate attributeName="opacity" from="0.5" to="1" dur="0.7s" repeatCount="indefinite" />
                </path>
                <path d="M1000,50 Q1010,75 1000,100" stroke="url(#lightningGradient)" stroke-width="2" fill="none" filter="url(#glow)">
                    <animate attributeName="stroke-width" from="1" to="3" dur="0.6s" repeatCount="indefinite" />
                    <animate attributeName="opacity" from="0.5" to="1" dur="0.6s" repeatCount="indefinite" />
                </path>
                <!-- Arcs concentriques pour simuler le confinement magnétique -->
                <circle cx="960" cy="75" r="70" stroke="#ffd700" stroke-width="1" fill="none" opacity="0.5">
                    <animate attributeName="r" from="70" to="75" dur="1.5s" repeatCount="indefinite" />
                </circle>
                <circle cx="960" cy="75" r="90" stroke="#ffd700" stroke-width="1" fill="none" opacity="0.3">
                    <animate attributeName="r" from="90" to="95" dur="1.5s" repeatCount="indefinite" />
                </circle>
                <circle cx="960" cy="75" r="110" stroke="#ffd700" stroke-width="1" fill="none" opacity="0.1">
                    <animate attributeName="r" from="110" to="115" dur="1.5s" repeatCount="indefinite" />
                </circle>
                <!-- Arc électrique sur toute la largeur -->
                <path d="M0,150 Q300,100 400,120 T800,80 Q1000,50 1200,70"
                        stroke="url(#electricGradient)" 
                        stroke-width="4"
                        fill="none"
                        filter="url(#glow)">
                    <animate attributeName="d"
                            dur="0.25s"
                            repeatCount="indefinite"
                            values="
                            M200,150 Q300,100 400,120 T800,80 Q1000,50 1200,70;
                            M0,150 Q310,90 390,130 T790,100 Q1010,60 1200,70;
                            M800,150 Q290,110 410,115 T805,70 Q995,55 1200,70;
                            M0,150 Q300,100 400,120 T800,80 Q1000,50 1200,70" />
                    <animate attributeName="filter"
                            values="url(#glow);none;url(#glow)"
                            dur="0.4s"
                            repeatCount="indefinite" />               
                </path>
                <!-- Citations animées -->
                <!-- Groupe pour les citations -->
                <g id="citations">
                    <text id="citation1" x="1920" y="40" text-anchor="end" font-size="20" fill="#ffd700" opacity="0">
                        <tspan>"La technologie est une extension de l'homme." - Marshall McLuhan</tspan>
                    </text>
                    <text id="citation2" x="0" y="70" text-anchor="start" font-size="20" fill="#ffd700" opacity="0">
                        <tspan>"L'avenir appartient à ceux qui croient en la beauté de leurs rêves." - Eleanor Roosevelt</tspan>
                    </text>
                    <text id="citation3" x="1920" y="100" text-anchor="end" font-size="20" fill="#ffd700" opacity="0">
                        <tspan>"L'innovation distingue un leader d'un suiveur." - Steve Jobs</tspan>
                    </text>
                    <text id="citation4" x="0" y="130" text-anchor="start" font-size="20" fill="#ffd700" opacity="0">
                        <tspan>"La créativité, c'est l'intelligence qui s'amuse." - Albert Einstein</tspan>
                    </text>
                    <animate xlink:href="#citation1" attributeName="x" from="1920" to="0" dur="10s" begin="0s;40s" fill="freeze" />
                    <animate xlink:href="#citation1" attributeName="opacity" values="0;1;1;0" dur="10s" begin="0s;40s" />
                    <animate xlink:href="#citation2" attributeName="x" from="0" to="1920" dur="10s" begin="10s;50s" fill="freeze" />
                    <animate xlink:href="#citation2" attributeName="opacity" values="0;1;1;0" dur="10s" begin="10s;50s" />
                    <animate xlink:href="#citation3" attributeName="x" from="1920" to="0" dur="10s" begin="20s;60s" fill="freeze" />
                    <animate xlink:href="#citation3" attributeName="opacity" values="0;1;1;0" dur="10s" begin="20s;60s" />
                    <animate xlink:href="#citation4" attributeName="x" from="0" to="1920" dur="10s" begin="30s;70s" fill="freeze" />
                    <animate xlink:href="#citation4" attributeName="opacity" values="0;1;1;0" dur="10s" begin="30s;70s" />
                </g>
                <!-- Path pour la courbe de Lissajous -->
                <path id="lissajous-path" fill="none" stroke="#ffd700" stroke-width="2" z-index="2"/>
            </svg>
            <!--  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  * -->
          <div class="bandeau-top">                  
            <h1>Elfennel</h1>
          </div>

          <div class="bandeau-bottom">
            <nav class="menu">
              <a href="#">Accueil</a>
              <a href="#">Pages</a>
              <a href="#">Contact</a>
            </nav>

            <div class="actions">
              <button>Menu</button>
              <button>Profil</button>
            </div>

          </div><!--  bandeau-bottom     -->

        </div><!--  bandeau -->
<!-- ==================================================================================== -->
        <div class="container">

            <nav class="navbar" id="mySidebar">
                <ul>
                  <li>Item 1</li>
                  <li>Item 2</li>
                  <li>Item 3</li>
                </ul>
            </nav>
            <!-- ==================================================================================== -->
            <!--                   Partie principale 
            acceuille les template
                                                                                                      -->
            <!-- ==================================================================================== -->
            <main class="main-content">

                <div class="content template-A">

                    <div class="col1">
                        <!-- uen seul carte  a fois  du fait de position: absolute et height: 100%  sinon se superpose prevoir onglet -->
                        <div class="card">
                            <h3>Titre de la carte</h3>
                            <p>Contenu de la carte.</p>
                        </div>                        
                        <div class="card">
                            <h3>Pensée du jour de soren</h3>
                            <p>Une image de licorne .</p>
                            <img src="./public/img/licorn1_raw.jpeg" alt="une licorne" width="20%"> 
                        </div>
                        <div class="card">
                            <h3>Notes CSS</h3>
                            <p>
                                2025-05-26 : on intègre svg.
                                - suppression background div bandeau voir classe class
                                - mettre svg dans le div.bandeau => OK
                                - ajouter  position:relative; au parent div.bandeau => OK
                                - ajouter  position:absolute;top:0;z-index: 1; à bandeau-top
                                - ajouter  position:absolute;bottom:0;z-index: 1; à bandeau-bottom 
                                on doit : 
                                - modifier classe .bandeau ; height:150px;    OU modifier SVG  puis remettre  height:90px;
                            <img src="./public/img/licorn1_raw.jpeg" alt="une licorne" width="20%"> 
                                - modifier classe 
                            </p>
                        </div>
                        <!-- SVG  -->
                        <div class="card">
                            <h3>Notes SVG</h3>
                            <p>2025-05-26 : on intègre svg.
                                on reprend animation des citations, le code original restera ici : "G:\WEB\TEMP\VAE\section3.html"
                                begin="0s;40s"

                            <div id="CALLOUT_2" class="callout">
                                <div id="CALLOUT_2_TITRE" class="titre">
                                <span>Callout 2</span>
                                <span>
                                <i class="fa fa-instagram w3-hover-opacity"></i>
                                <i class="fa fa-twitter w3-hover-opacity"></i>
                                </span>
                                </div>
                                <div id="CALLOUT_2_CONTENT" class="content">
                                Les missiles hypersoniques posent un défi considérable. À des vitesses supérieures à Mach 5, les CWS conventionnels, qui sont conçus pour traiter des menaces plus lentes et proches, sont moins susceptibles de réussir l'interception. Même avec des canons à grande cadence de tir, la rapidité de ces missiles dépasse généralement les capacités des CWS actuels, car le temps d'engagement est extrêmement limité.<br/>
                                Le missile parcourt environ 17 mètres entre deux tirs du CWS à Mach 5.
                                Le CWS effectuera 60 tirs pendant le temps où le missile parcourt 1 km soit 0,6 seconde.

                                </div>
                            </div>

                            <button id="infoTemp_bt1">Essai module js</button>
                            <br/>
                            <div id="infoTime"> div infoTime</div>


                        </div>

                    </div>

                    <div class="col2">

                      <ul>
                        <li>Lien 1</li>
                        <li>Note</li>
                      </ul>
                     
                      <div id="carousel-app">
                        <image-carousel :period="3000">
                        <a href="./public/img/ANIMAUX/CHIENS/berger-allemand.jpg" target="_blank"> 
                            <img src="./public/img/ANIMAUX/CHIENS/berger-allemand.jpg" alt="berger allemand"/>
                        </a>
                        <img src="./public/img/ANIMAUX/CHIENS/berger-border-Collie.jpg" alt="berger border Collie" />
                        <img src="./public/img/ANIMAUX/CHIENS/berger-malinois.jpg" alt="berger malinois" />
                        <img src="./public/img/ANIMAUX/CHIENS/chien_akita.jpg" alt="Akita Inu"/>
                        <img src="./public/img/ANIMAUX/CHIENS/chien_border.jpg" alt="Border Collie" />
                        </image-carousel>
                      </div><!-- end caroussel -->

                    </div><!-- end col2 -->

                </div>
              
                <div class="pagination">
                    Pagination
                </div>

            </main>

        </div>

        <footer class="footer">Footer</footer>


        <div class="overlay" id="myOverlay" onclick="w3_close()"></div>
        <div class="debuglay" id="myDebugbar" onclick="w3_close2()">
            Sert aussi pour historique de version.
            On modifie le style 
                => copie fonctionnelle  :   template1.blade.php
                => backup               :   template0523-01.blade.php
        <hr>        
        2025-05-24 : la strucure etablie est stockee
        
        => backup               :   template0524-00.blade.php
        La priorité est de terminer le template A
        bidouille actuelle pagination, hauteur de banniere ?? 

        => composant on commence a preparer uen section composant apres RWD dans css
        composant  : card ;  slot a prevoir : titre, content ; style :  .card ;  style lié : .card h3     
        image du rendu , code css, code html

        => on cré le composant card, note il serai tpossible des les mettre 
         - en grille selon les dimensions
         - en onglet   ave cun id et realise ruen pagination 
        avec script = > on laisse template2_ongletpagination.blade.php pour essai js


        => ajout svg, probleme avec titre qui se decale    
        on va donc 

            choix 
            - modifier svg cause banner => svg width="1920" height="150" devient svg width="1920" height="90"
            - deplacer  height:90px; dans parent div.bandeau

            un effet inopiné le svg est mis a echelle et n'occupe plus la totalité  REVOIR SVG

        suppresion des elements le code original est dans "G:\WEB\TEMP\VAE\section3.html"
                            g id="SVGRepo_iconCarrier"
                g id="electrotechnique"

        ==> on repasse sur 150 pour le moment il faut modifier svg  h 150 puis modifer height bandeau a 150px   

        => plus de modification apres copie du template et des cards tant que la logique n'est pas géré et fusionnee dans le  template

            ==> on se concnetre sur la strutucte avant gestion onglet

        ----
        
        


        </div>
        
<!--
   div style 

   - CWModal : container globale de la fenetre modale

   - cwTOP : bandeau superieure
   - CWModal_Titre: titre de la modale
   - CWModalClose: bouton close
   - cwCT: contenu



-->
    <div id="CWModal" >
        <div id="cwTOP">
            [+] <span id="CWModal_Titre">Selectionner un element</span> 
            <span class="CWModalClose" id= "CWModalClose">X</span>
        </div>
        <div id="cwCT">

        </div>
    </div>

    <!--
    src="./public/build/assets/laramain.js"    
    -->      
    <script type="module">
        import { createApp } from 'https://unpkg.com/vue@3/dist/vue.esm-browser.js';
        import { ImageCarousel } from './public/build/assets/carousel.js';
        import { Callout } from './public/build/assets/callout.js'

        import * as ENTITY from './public/build/assets/modules/entity.js';
        import * as IHM from './public/build/assets/modules/ihm.js';

//        import {MYMODALWIN} from './public/build/assets/laramain';
import {ModalWin} from './public/build/assets/modules/helpers/modalwin.js';
 
    // export let MYMODALWIN = new ModalWin("Titre de modale")//pour la fenetre modale
    //let MYMODALWIN = new ModalWin("Titre de modale") //pour la fenetre modale
    let MYMODALWIN
//export let MYMODALWIN = new ModalWin("Titre de modale")//pour la fenetre modale

function infoTemp_bt1_ev_click( evt ) { 
    MYMODALWIN = new ModalWin("Titre de modale")
    //MYMODALWIN.setContent_Html("Le contenu de la fenetre")
    //MYMODALWIN.setContent_Node( person1.generateForm2() )
    MYMODALWIN.setContent_Node( person1.getPropertiesTable() )
    MYMODALWIN.show()
}


function GestionEvents()
{
	const infoTemp_bt1 = document.getElementById( "infoTemp_bt1");
	if ( infoTemp_bt1 != null )
	{
			//console.log( `MotIndexTemplate.php , ligne 67 - GestionEvents => ${ infoTemp_bt1.id } : OK`)
			//infoTemp_bt1.innerText = 'infoTemp_bt1'
			infoTemp_bt1.addEventListener('click', ( event ) => { infoTemp_bt1_ev_click( event ) } )
	}
}

        // Application pour le carrousel
        const carouselApp = createApp( { components: { 'image-carousel': ImageCarousel } } )
        carouselApp.mount('#carousel-app')


      // Application pour le Callout
        const calloutApp = createApp({ components: {'callout': Callout } })
        calloutApp.mount('#callout-app')  


    // essai 


//
    let person1 = new ENTITY.Person( { firstname: "John", lastname: "Doe", birthdate: "1990-05-15" } )
    //person1 = new Person("John", "Doe", "1990-05-15");
    console.log(person1.getAge()); // Affiche l'âge de la personne
    console.log(person1.getWarningBirthday(7)); // Affiche un avertissement si l'anniversaire est dans les 7 jours

    debugger

    IHM.CONTENT_SetHtml( "infoTime" , `Date anniversaire ${ person1.birthdate } Age de la personne ${ person1.getAge() } ans`)

    GestionEvents();//gestioannaire event ihm


    </script>
    </body>
</html>