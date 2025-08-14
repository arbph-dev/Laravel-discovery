# CSS

une série de layout doit permettre de déployer différentes solutions

- Tailwind
- W3.css
- Bootstrap

Tailwind et Bootstrap => pas convaicnu specialment pour les tableaux

## Pure css
nécessite un travail de fond mais présente l'avantage de la flexibilité
mis en oeuvre pour le layout[pure](../srcLaravel/resources/views/layouts/pure.blade.php)

## Tailwind
consulter [Tailwind](https://tailwindcss.com/)
mis en oeuvre pour le layout[pure2](../srcLaravel/resources/views/layouts/pure2.blade.php)
```html
  <body>
  <h1 class="text-3xl font-bold underline">
    Hello world!
  </h1>
```

---
## W3.css
consulter [w3.css](https://www.w3schools.com/w3css/w3css_intro.asp)
mis en oeuvre pour le layout[pure3](../srcLaravel/resources/views/layouts/pure3.blade.php)

```html
<div class="w3-container w3-teal">
  <h1>This is a Header</h1>
</div>

```

```
<link rel="stylesheet" href="https://www.w3schools.com/w3css/5/w3.css">

<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-amber.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-black.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-red.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-teal.css">
```



---
## Bootstrap
consulter [Bootstrap](https://getbootstrap.com/docs/3.3/getting-started/)  
mis en oeuvre pour le layout[pure4](../srcLaravel/resources/views/layouts/pure4.blade.php)

utiliser bootstrap en CDN
```html
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css">
```

## font-awesome
cette libraiire d'icone peut servir pour compléter les icones Unicode

utiliser font-awesome en CDN
```html
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
```

Une liste permet de retrouver les icones => lien ?
```html
<i class="fa fa-search"></i>
<i class="fa fa-volume-up"></i>
<i class="fa fa-wifi"></i>
<i class="fa fa-battery-2"></i>
<i class="fa fa-bars"></i>
```


