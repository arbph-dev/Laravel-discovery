<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	  <script src="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss-browser/4.1.11/index.global.js" integrity="sha512-olm4cT8of/zUv2YTJJ2M8Tz62WACopyNthdPOUIAEmuFD8HjfOJtc8YAHF334UoBlAW8We+3iKzw3olxGDZtHg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
	<title>@yield('title', 'Site')</title>



  </head>

  <body>

      <div>
        @yield('content', '<h2>Content</h2>store html tags')
      </div>

  </body>

</html>