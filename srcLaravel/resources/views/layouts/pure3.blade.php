<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	  <link rel="stylesheet" href="https://www.w3schools.com/w3css/5/w3.css"> 
    
	  <title>@yield('title', 'Site')</title>

    <script>

      function ihm_Darkmode_Toggle() {
        let classBody = "w3-black"

        let x = document.body
        x.classList.toggle(classBody)

      }

    </script> 

  </head>

  <body>
    <div class="w3-container">    
    
    <!-- TOP BAR --> 
      <div class="w3-bar w3-black">
        <a href="#" class="w3-bar-item w3-button">item 1</a>
        <a href="#" class="w3-bar-item w3-button">item 2</a>
        <a href="#" class="w3-bar-item w3-button w3-right" onclick="ihm_Darkmode_Toggle()">Dark</a>
      </div> 
    
      <!-- TOP BAR --> 
      <header class="w3-teal">
          <h1>@yield('title', 'Site')</h1>
      </header> 


      <div class="">
          @yield('content', '<h2>Content</h2>store html tags')
      </div>

      <footer class="w3-teal">
        <h5>Footer</h5>
        <p>Footer information goes here</p>
      </footer> 

    </div>

  </body>

</html>