@props(['titre' => 'Titre de la page'])


<!doctype html>
<html lang="en-US">
  
  <head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{$meta}}
    <title>{{$titre}}</title>
    {{$style}}
  </head>
  
  <body>
    <h1>Composant Landpage de SOREN</h1>
    <p>Landpage default, no css, no js. HTML only html</p>
    <hr>
    {{$slot}}
  </body>

</html>