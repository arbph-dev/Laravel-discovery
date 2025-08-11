<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>


     
        <style>
            :root {
                
                -- cBlue        : #2196F3 !important;

                --primary       : #000000 ;  /*  3 couleurs = theme ?? reste a:link etc... code hex a dans outil ff ??*/
                --secondary     : var(--cBlue); /* blue; */
                --back          : #ffffff;
                
                --fntSzpt       : calc(2px + 1vw); /*  3 couleurs  code hex a dans outil ff ??*/
                /*--fntSzpt_TpS   : calc(12px + 2vw);*/
                /*  headingH1 => Titre H1 scope tout doc */ 

                --headingH1_Primary : var(--primary) ;
                --headingH1_Secondary : var(--secondary);
                --headingH1_Back : var(--back);
                /* --headingH1_FntSz: calc(12px + 2vw);  --headingH1Fontsize: clamp( 2rem, 2.5vw, 3.5rem );  */
                --headingH1_FntSz: 6em;
                --headingH1_Border: 4px solid var(--headingH1_Secondary);
                
            }  
 


html, body {
  margin: 0;
  padding: 0;
}

body {
  display: flex;
  flex-direction: column;
  min-height: 100vh; /* ← cette ligne est clé */
  font-size: var(--fntSzpt);
}

.bandeau {
  background-color: var(--secondary);
  color: white;
  padding: 1em;
  text-align: center;
}

.bandeau div.menu {color:teal;display: inline-block;}

.container {
  display: flex;
  flex: 1; /* container prend l’espace restant entre bandeau et footer */
}

nav.navbar {
  background-color: #f4f4f4;
  padding: 1em;
  width: 200px;
}

main.main-content {
  flex: 1;
  padding: 1em;
  background-color: #fdfdfd;
}

footer.footer {
  background-color: #333;
  color: white;
  padding: 1em;
  text-align: center;
}


div.content { color : orangered; font-size:2em; }

div.pagination { color : purple; } 


.overlay { background-color: rgba(0, 0, 0, 0.5); display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; }

.debuglay { background-color: rgba(0, 0, 0.5, 0.8); color:teal;display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; }

            @media (max-width:600px)
            {
                html body h1{ 
                font-size: var( --headingH1FontsizeS );
                }

                nav.navbar {
                    z-index: 3;display: none;
                }                    
            }




        </style>

        <script src="./public/build/assets/laramain.js">
        </script>
        
        <script type="text/javascript">
            const mySidebarId = "mySidebar";
            const myOverlayId = "myOverlay";
            const myDbgbarId = "myDebugbar";
        </script>
    </head>
    <body>
        <!--  
        <h1>template2.blade.php</h1>
        <div>
            <div class="show-block">Div A . 1</div>
            <div class="show-block hide-small">Div A . 2</div>             
        </div>            
      
        html body div div.show-block

        {{ $slot }}  

            div.container main.main-content div.content { color : orangered; }
            
            div.container main.main-content div.pagination { color : purple; bottom: 0px;}        
        -->


        <div class="bandeau">          
          <div class="menu">bd1</div>
          <div class="menu">bd2</div>
          <div class="menu">bd3</div>
          <button class="menu-button" onclick="w3_open()">
            &#8633;
          </button>
          <button class="menu-button" onclick="w3_open2()">
            &#9763;
          </button>
        </div>

        <div class="container">
            <nav class="navbar" id="mySidebar">
                <ul>
                  <li>Item 1</li>
                  <li>Item 2</li>
                  <li>Item 3</li>
                </ul>
            </nav>

            <main class="main-content">
            
              <div class="content">Zone principale</div>
            
              <div class="pagination">Pagination</div>
            
            </main>

        </div>

        <footer class="footer">Footer</footer>


        <div class="overlay" id="myOverlay" onclick="w3_close()"></div>
        <div class="debuglay" id="myDebugbar" onclick="w3_close2()"></div>
        
    </body>
</html>