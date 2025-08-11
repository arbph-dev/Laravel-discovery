<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    
    <title>@yield('title', 'Site')</title>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="stylesheet" href="./public/build/assets/w3.css" />

  </head>

  <body>
    
    <!-- Navbar -->
    <div class="w3-top">
      <!-- Navbar pc et mobile -->
      <div class="w3-bar w3-red w3-card w3-left-align w3-large">
        <a 
          class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-red" 
          href="javascript:void(0);" 
          onclick="rwd_ToggleNavbar()" 
          title="Toggle Navigation Menu"
        >
            <i class="fa fa-bars"></i>
        </a>
        

        @auth
            @if (Route::has('logout'))
                <a 
                  href="javascript:void(0)" 
                  onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                  class="w3-bar-item w3-button w3-right w3-padding-large w3-hover-white w3-large w3-red"
                  >
                    Logout
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST">@csrf</form>

            @endif 
        @else
            <a 
              href="{{ route('login') }}"
              class="w3-bar-item w3-button w3-right w3-padding-large w3-hover-white w3-large w3-red"
              >
              Log in
            </a>
            
            @if (Route::has('register'))
            <a 
              href="{{ route('register') }}"
              class="w3-bar-item w3-button w3-right w3-padding-large w3-hover-white w3-large w3-red"
              >
              Register
            </a>
            @endif

        @endauth


        <a href="#" class="w3-bar-item w3-button w3-padding-large w3-white">Home</a>
        <a href="#" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Link 1</a>
        <a href="#" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Link 2</a>
        <a href="#" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Link 3</a>
        <a href="#" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Link 4</a>
      </div>

      <!-- Navbar mobile -->
      <div id="rwd_Navbar" class="w3-bar-block w3-white w3-hide w3-hide-large w3-hide-medium w3-large">
        <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 1</a>
        <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 2</a>
        <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 3</a>
        <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 4</a>
      </div>
    </div>
    <!-- END Navbar -->
    
    <!-- Header -->
    <header class="w3-container w3-red w3-center" style="padding-top:48px">
      <h1 class="w3-margin w3-animate-opacity">@yield('title', 'Site')</h1>
      <img class="w3-image" src="./pompier_robots.jpg" alt="Norway" width="600" height="400">

      @yield('description', 'Site')

    </header>
    <!-- END Header -->

    <!-- CONTENT ROWS-->
    <!-- First row -->
    <div class="w3-content">
      @yield('section1', '<h2>Section 1</h2>')
    </div>

    <!-- Second row  -->
    <div class="w3-content">
      @yield('section2', '<h2>Section 2</h2>')
    </div>


    <!-- troisieme row  onglet -->
    <div class="w3-content">

      <div class="w3-bar w3-black">
        <button class="w3-bar-item w3-button" onclick="cp_TabShow('London')">London</button>
        <button class="w3-bar-item w3-button" onclick="cp_TabShow('Paris')">Paris</button>
        <button class="w3-bar-item w3-button" onclick="cp_TabShow('Tokyo')">Tokyo</button>
      </div> 

      <div id="London" class="cp_Tabs">
        <h2>London</h2>
        <p>London is the capital of England.</p>
      </div>
      
      <div id="Paris" class="cp_Tabs" style="display:none">
        <h2>Paris</h2>
        <p>Paris is the capital of France.</p>
      </div>

      <div id="Tokyo" class="cp_Tabs" style="display:none">
        <h2>Tokyo</h2>
        <p>Tokyo is the capital of Japan.</p>
      </div>

    </div>


    <!-- footer -->
    <footer class="w3-container w3-padding-64 w3-center w3-opacity">  

      <div class="w3-xlarge w3-padding-32">
        <i class="fa fa-facebook-official w3-hover-opacity"></i>
        <i class="fa fa-instagram w3-hover-opacity"></i>
        <i class="fa fa-snapchat w3-hover-opacity"></i>
        <i class="fa fa-pinterest-p w3-hover-opacity"></i>
        <i class="fa fa-twitter w3-hover-opacity"></i>
        <i class="fa fa-linkedin w3-hover-opacity"></i>
      </div>

      <p>Powered by <a href="https://www.w3schools.com/w3css/default.asp" target="_blank">w3.css</a></p>

    </footer>

    <script>
    // Used to toggle the menu on small screens when clicking on the menu button
      function rwd_ToggleNavbar() {
        var x = document.getElementById("rwd_Navbar");
        if (x.className.indexOf("w3-show") == -1) {
          x.className += " w3-show";
        } else { 
          x.className = x.className.replace(" w3-show", "");
        }
      }



      function cp_TabShow(tabName) {
        var i;
        var x = document.getElementsByClassName("cp_Tabs");
        for (i = 0; i < x.length; i++) {
          x[i].style.display = "none";
        }
        document.getElementById(tabName).style.display = "block";
      }
    </script>

  </body>

</html>