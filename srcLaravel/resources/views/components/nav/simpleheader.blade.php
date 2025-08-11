<!----------------------------------------------------------------------------------------------------------------------------->       
<!-- HEADER ( banniere ou top bar ) -->
<div id="Esf_Topbar" name="Esf_Topbar" class="Esf_Topbar" >

    <div id="topbar" style="position:relative;">
    
        <x-ihm.svgban02/>

        <div id="Esf_Topbar_Up" name="Esf_Topbar_Up" class="Esf_Topbar_Up" >


            <div id="Esf_RwdDg" name="Esf_RwdDg" class="Esf_RwdDg" >
                
                <a href="javascript:void(0)" onclick="myFunction()">dark mode</a>

                <a href="javascript:void(0)" onclick="w3_open()" class="Esf_RwdDg_btnav">&#10024;</a>

                <a href="javascript:void(0)" onclick="w3_open2()">debug</a>

                RWD     


                @auth
                    @if (Route::has('logout'))
                        
                        <a href="javascript:void(0)" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST">@csrf</form>

                    @endif 


                @else
                    <a href="{{ route('login') }}">Log in</a>
                    @if (Route::has('register'))
                    <a href="{{ route('register') }}">Register</a>
                    @endif
                @endauth




            </div>
            
            <div id="Esf_Topbar_Bt_Show" name="Esf_Topbar_Bt_Show" class="Esf_Topbar_Bt_Show" >
                
            </div>

        </div><!-- fin div id="Esf_Topbar_Up" -->

        <div id="Esf_Topbar_Dn" name="Esf_Topbar_Dn" class="Esf_Topbar_Dn" >
            <x-nav.link2 href="{{ route('homeguest') }}" :active="request()->routeIs('homeguest')">Accueil</x-nav.link>
            <x-nav.link2 href="/about">a propos</x-nav.link>
            <x-nav.link2 href="/tache">tache</x-nav.link>
            <x-nav.link2 href="/note">note</x-nav.link>
        </div>
        
    </div><!-- fin div id="topbar" -->
    
</div><!-- fin div id="Esf_Topbar" -->
 
