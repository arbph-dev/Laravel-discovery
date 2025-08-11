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
            <!-- INSERT -->
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
            <!--                   Partie principale             acceuille les template               -->
            <!-- ==================================================================================== -->
            <main class="main-content">

                <div class="content template-A">

                    <div class="col1">
                        <!-- uen seul carte  a fois  du fait de position: absolute et height: 100%  sinon se superpose prevoir onglet -->
                        <div class="card">
                            <h3>Titre de la carte</h3>
                            <p>Contenu de la carte.</p>
                        </div>                        
                    </div>

                    <div class="col2">

                      <ul>
                        <li>Lien 1</li>
                        <li>Note</li>
                      </ul>

                    </div><!-- end col2 -->

                </div><!-- end content template-A -->
              
                <div class="pagination">
                    Pagination
                </div>

            </main>

        </div><!--  container -->

        <footer class="footer">Footer</footer>


        <div class="overlay" id="myOverlay" onclick="w3_close()"></div>
        <div class="debuglay" id="myDebugbar" onclick="w3_close2()"></div>
        

        <div id="CWModal" >

            <div id="cwTOP">
                [+] <span id="CWModal_Titre">Selectionner un element</span> 
                <span class="CWModalClose" id= "CWModalClose">X</span>
            </div>

            <div id="cwCT">

            </div>
        </div><!--  CWModal -->

    

    </body>
</html>