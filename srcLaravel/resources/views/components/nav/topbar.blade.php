<div class="w3-top">

    <div class="w3-bar w3-theme w3-top w3-left-align">

        <!-- icone pour afficher SIDEBAR ; PC: caché , TABLETTE=MOBILE : visible 
        w3-theme-l1
        w3-hover-white
        
        <i class="fa fa-bars" style="color:red"></i>
        -->
        <a 
            class="w3-black w3-bar-item w3-button w3-right w3-hide-large" 
            href="javascript:void(0)" 
            onclick="w3_open()"
          >
        <i class="fa fa-bars"></i>    
        </a>
        
        <b>&#9962;</b><b>&#128366;</b>
            
        <x-nav.link href="{{ route('home') }}" :active="request()->routeIs('home')">Accueil</x-nav.link>
        <x-nav.link href="/presentation">Présentation</x-nav.link>
        <x-nav.link href="/technologies">Technologies</x-nav.link>
        <x-nav.link href="/loisirs">Loisirs</x-nav.link>


    </div>

</div>