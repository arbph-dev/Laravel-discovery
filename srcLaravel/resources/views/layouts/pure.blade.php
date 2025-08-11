<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    
    <x-meta1 
	:gsv="$keyGOOGLESEARCH ?? ''" 
	:title="$metaTitle ?? 'Elfennel'" 
	:description="$metaDescription ?? 'Plateforme Laravel pour la validation des acquis, les projets industriels et les compétences techniques.'" 
	:keywords="$metaKeywords ?? 'énergie, automatisme, maintenance, industrie'" 
	:image="$metaImage ?? 'https://elfennel.fr/public/img/seo/default-image.jpg'" 
/>

    <title>@yield('title', 'Site')</title>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- <link rel="stylesheet" href="./public/build/assets/pure_style.css" />
    <script type="module"src="./public/build/assets/pure_script.js"></script>
    on doit passer aux url absolues pour les sous vues
    -->
    <link rel="stylesheet" href="https://elfennel.fr/public/build/assets/pure_style.css" />
    <script type="module"src="https://elfennel.fr/public/build/assets/pure_script.js"></script>
  </head>

  <body>
    <!-- ENTETE BARRE DE NAVIGATION -->
    <header id= "Esf_Upbar "class ="Esf_Upbar" > 
      <x-nav.link2 href="{{ route('homeguest') }}" :active="request()->routeIs('homeguest')">Accueil</x-nav.link2>
      <!-- <a href="#" class="nav-item" >Home</a> -->
      <x-nav.link2 href="/about" :active="request()->is('about')">informations</x-nav.link2>
      <x-nav.link2 href="/note" :active="request()->is('note')">Note</x-nav.link2>
      <x-nav.link2 href="/tache" :active="request()->is('tache')">Tache</x-nav.link2>
      <x-nav.link2 href="/script" :active="request()->is('script')">script</x-nav.link2>
      <!-- <x-nav.link2 href="/organisations" :active="request()->is('organisations')">VAE</x-nav.link2>-->
	  <x-nav.link2 href="/three" :active="request()->is('three')">Threejs</x-nav.link2>
	  
      <!--
      <a href="#" class="item" >Link 1</a>
      <a href="#" class="item" >Link 2</a>
      <a href="#" class="item" >Link 3</a>
      <a href="#" class="item" >Link 4</a>
      -->
      <a href="javascript:void(0);" class="sys-item" onclick="w3_open()" title="Toggle Navigation Menu" ><i>&#9776;</i></a>
      <a href="javascript:void(0)" class="sys-item" id="si_bt-Theming" onclick="myFunction()" title="Toggle Theming" >Dark mode</a>
      <a href="javascript:void(0)" class="sys-item"onclick="w3_open2()" title="Affiche fenetre de deboggage">Debug</a>


        @auth
          <a href="{{ route('home') }}" class="sys-item">{{ Auth::user()->name}} :: {{ Auth::user()->role }}</a>
          
          @if (Route::has('logout'))
              <a href="javascript:void(0)" class="sys-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                  Logout
              </a>

              <form id="logout-form" action="{{ route('logout') }}" method="POST">@csrf</form>

          @endif 
        @else
          <a href="{{ route('login') }}" class="sys-item">Log in</a>
          @if (Route::has('register'))
            <a href="{{ route('register') }}" class="sys-item">Register</a>
          @endif
        @endauth


    </header>
    <!-- END header class Esf_Upbar id = Esf_Upbar  -->

    <!-- CONTENEUR PRINCIPAL
         TODO : doit on déplacer la barre nav mobile sous un div style position relative 
      et creer un div style position relative pour le reste du contenu ??

      <header id="rwd_header" class="Esf_Header" => a modifier en div  ??
      div id="rwd_Navbar" class="rwd_Navbar"

      div class="Esf_Content
     -->
    <div id="Esf_Main" class="Esf_Main">      
      
      <!-- Header -->
      <div id="Esf_Header" class="Esf_Header">
        
        <div class="Esf_Header_Content">
            <h1>@yield('title', 'Site')</h1>
            <p>@yield('description', 'Site')</p>
        </div>

        <div class="Esf_Header_Background">
            <x-ihm.svgban02/>
        </div>

      </div>
      <!-- END Header -->


      <!-- CONTENT -->
      <div class="Esf_Content">
        @yield('content', '<h2>Content</h2>store html tags')
      </div>
      <!-- END CONTENT -->

    </div>       
    <!-- END CONTENEUR PRINCIPAL  -->



    <!-- footer -->
    <footer id="Esf_Dnbar" class="Esf_Dnbar">  
      <div id="Esf_Dnbar_Dn" class="Esf_Dnbar_Dn">
        <!--
        <div class="w3-xlarge w3-padding-32">
            <i class="fa fa-facebook-official w3-hover-opacity"></i>
            <i class="fa fa-instagram w3-hover-opacity"></i>
            <i class="fa fa-snapchat w3-hover-opacity"></i>
            <i class="fa fa-pinterest-p w3-hover-opacity"></i>
            <i class="fa fa-twitter w3-hover-opacity"></i>
            <i class="fa fa-linkedin w3-hover-opacity"></i>
        </div>
        -->
        <p>Powered by LARAVEL</p>
      </div>
    </footer>
    <!-- end footer-->


    <!-- Navbar -->
    <div id="Esf_Navbar" class="Esf_Navbar">
      <a href="#" >Link 1</a>
      <a href="#" >Link 2</a>
      <a href="#" >Link 3</a>
      <a href="#" >Link 4</a>
    </div>
    <!-- END Navbar -->

        <!-- MODAL begin    -->
    <div id="cp_modal_div" >

        <div id="cp_modal_top">
            [+] <span id="cp_modal_ti">Selectionner un element</span> 
            <span class="cp_modal_cl" id= "cp_modal_cl">X</span>
        </div>

        <div id="cp_modal_ct">
        </div>
    </div>
    <!-- MODAL end     -->

    <div class="cp_nav-overlay" id="cp_nav-overlay" onclick="w3_close()"></div>

    <div class="cp_dbg-div" id="cp_dbg-div" onclick="w3_close2()">
        cp_dbg-div , visualiation debug
    </div>

  </body>

</html>
