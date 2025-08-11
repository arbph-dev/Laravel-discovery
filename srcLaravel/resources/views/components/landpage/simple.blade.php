<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>

        <meta content="text/html; charset=utf-8" http-equiv="Content-Type">

        {{$meta}}
    
        <title>{{$titre}}</title>

        {{$style}}
        
        {{$script}}

    </head>
  
    <body class="pr">

        {{$header}}

        <div>
            {{$navbar}}

            <div id="Esf_Mains" name="Esf_Mains" class="Esf_Mains" >            
                
                {{$slot}}
                
            </div>

        </div> 



        {{$footer}}    



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