<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	  
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css">
	<title>@yield('title', 'Site')</title>



  </head>

  <body>

      <div>
        @yield('content', '<h2>Content</h2>store html tags')
      </div>

  </body>

</html>