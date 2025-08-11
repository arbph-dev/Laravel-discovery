<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts 
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://elfennel.fr/public/build/assets/w3.css" rel="stylesheet">         
        <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-black.css">        
        <style>
        .HeaderTop2 { position : sticky ; top : 0 ; left : 0 ; flex : 1 ; }

        .w3-sidebar { z-index: 3; width: 250px; top: 43px; bottom: 0;  height: inherit; }
        </style>
        
        <script src="./public/build/assets/laramain.js"></script>
        
    </head>
    <body>


        {{ $slot }}
        
    </body>
</html>