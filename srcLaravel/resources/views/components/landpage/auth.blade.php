<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>

        <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
    
        <title>{{$titre}}</title>

        {{$style}}
        

    </head>
  
    <body class="pr">

        {{$header}}



        <div id="Esf_Auth" name="Esf_Auth" >           
            
            {{$slot}}
            
        </div>





        {{$footer}}    


    </body>

</html>    
