**le data-* attribute fonctionne avec autre tag?** => oui
[MDN](https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Global_attributes/data-*)

# Noeuds Tags
- [article](https://github.com/arbph-dev/Laravel-discovery/blob/main/methodes/docs/html/Notes.md#article)
- [aside](https://github.com/arbph-dev/Laravel-discovery/blob/main/methodes/docs/html/Notes.md#aside)
- [data](https://github.com/arbph-dev/Laravel-discovery/blob/main/methodes/docs/html/Notes.md#data)
- [datalist](https://github.com/arbph-dev/Laravel-discovery/blob/main/methodes/docs/html/Notes.md#datalist)
- [details](https://github.com/arbph-dev/Laravel-discovery/blob/main/methodes/docs/html/Notes.md#details) **a tester **
- [footer](https://github.com/arbph-dev/Laravel-discovery/blob/main/methodes/docs/html/Notes.md#footer)
- [form](https://github.com/arbph-dev/Laravel-discovery/blob/main/methodes/docs/html/Notes.md#form)
    pour le script **"x.value=parseInt(a.value)+parseInt(b.value)"**
- [header](https://github.com/arbph-dev/Laravel-discovery/blob/main/methodes/docs/html/Notes.md#header)
- [hgroup](https://github.com/arbph-dev/Laravel-discovery/blob/main/methodes/docs/html/Notes.md#hgroup) **a tester **
- [input](https://github.com/arbph-dev/Laravel-discovery/blob/main/methodes/docs/html/Notes.md#input) 
- [kbd](https://github.com/arbph-dev/Laravel-discovery/blob/main/methodes/docs/html/Notes.md#kbd)
- [label](https://github.com/arbph-dev/Laravel-discovery/blob/main/methodes/docs/html/Notes.md#label)
- [main](https://github.com/arbph-dev/Laravel-discovery/blob/main/methodes/docs/html/Notes.md#main)
- [mapaera](https://github.com/arbph-dev/Laravel-discovery/blob/main/methodes/docs/html/Notes.md#mapaera) **area onclick => oui**
- [menu](https://github.com/arbph-dev/Laravel-discovery/blob/main/methodes/docs/html/Notes.md#menu)
- [meter](https://github.com/arbph-dev/Laravel-discovery/blob/main/methodes/docs/html/Notes.md#meter)
- [nav](https://github.com/arbph-dev/Laravel-discovery/blob/main/methodes/docs/html/Notes.md#nav)
- [ol](https://github.com/arbph-dev/Laravel-discovery/blob/main/methodes/docs/html/Notes.md#ol)
- [picture](https://github.com/arbph-dev/Laravel-discovery/blob/main/methodes/docs/html/Notes.md#picture)**rwd + solution tri image**
- [progress](https://github.com/arbph-dev/Laravel-discovery/blob/main/methodes/docs/html/Notes.md#progress)
- [search](https://github.com/arbph-dev/Laravel-discovery/blob/main/methodes/docs/html/Notes.md#search) **utilité??**
- [select](https://github.com/arbph-dev/Laravel-discovery/blob/main/methodes/docs/html/Notes.md#select) **optgroup a connaitre**
- [template](https://github.com/arbph-dev/Laravel-discovery/blob/main/methodes/docs/html/Notes.md#template)**a tester **
- [time](https://github.com/arbph-dev/Laravel-discovery/blob/main/methodes/docs/html/Notes.md#time)
- [ul](https://github.com/arbph-dev/Laravel-discovery/blob/main/methodes/docs/html/Notes.md#ul)


## aera
voir [mapaera](https://github.com/arbph-dev/Laravel-discovery/blob/main/methodes/docs/html/Notes.md#mapaera) **ci dessous**
[w3schools / tag area](https://www.w3schools.com/tags/tag_area.asp)
The <area> tag also supports the Event Attributes in HTML.

## article
The <article> tag specifies independent, self-contained content.
An article should make sense on its own and it should be possible to distribute it independently from the rest of the site.

Voir [w3schools / tag article](https://www.w3schools.com/tags/tag_article.asp)

## aside
aside a voir si supprimer par la suite ?? div class aside
[w3schools / tag aside](https://www.w3schools.com/tags/tag_aside.asp)

## data
valeur dans la structure mais invisible des users
```html
  <li><data value="21053">Cherry Tomato</data></li>
  <li><data value="21054">Beef Tomato</data></li>
  <li><data value="21055">Snack Tomato</data></li>
```

Use the data-* attribute to embed custom data:
```html
<ul>
  <li data-animal-type="bird">Owl</li>
  <li data-animal-type="fish">Salmon</li>
  <li data-animal-type="spider">Tarantula</li>
</ul>
```


```html
<script>
function showDetails(animal) {
  let animalType = animal.getAttribute("data-animal-type");
  alert("The " + animal.innerHTML + " is a " + animalType + ".");
}
</script>
</head>
<body>

<h1>Species</h1>
<p>Click on a species to see what type it is:</p>

<ul>
  <li onclick="showDetails(this)" id="owl" data-animal-type="bird">Owl</li>
  <li onclick="showDetails(this)" id="salmon" data-animal-type="fish">Salmon</li>  
  <li onclick="showDetails(this)" id="tarantula" data-animal-type="spider">Tarantula</li>  
</ul>
```






## datalist
```html
<label for="browser">Choose your browser from the list:</label>
<input list="browsers" name="browser" id="browser">

<datalist id="browsers">
  <option value="Edge">
  <option value="Firefox">
  <option value="Chrome">
  <option value="Opera">
  <option value="Safari">
</datalist>
```


## details
semblable callout ;) => **a tester, img svg**
```html
<details>
  <summary>Epcot Center</summary>
  <p>Epcot is a theme park at Walt Disney World Resort featuring exciting attractions, international pavilions, award-winning fireworks and seasonal special events.</p>
</details>
```

## fieldset
  peut servir à scinder les formulaires ??
  
## footer
Contact information inside a <footer> element should go inside an <address> tag.
```html
<footer>
  <address>
    Written by <a href="mailto:webmaster@example.com">Jon Doe</a>.<br> 
    Visit us at:<br>
    Example.com<br>
    Box 564, Disneyland<br>
    USA
  </address>
</footer>
```

## form
```html
<form action="/action_page.php">
 <fieldset>
  <legend>Personalia:</legend>
  <label for="fname">First name:</label><input type="text" id="fname" name="fname"><br><br>
  <label for="lname">Last name:</label><input type="text" id="lname" name="lname"><br><br>
  <label for="email">Email:</label> <input type="email" id="email" name="email"><br><br>
  <label for="birthday">Birthday:</label><input type="date" id="birthday" name="birthday"><br><br>
  <input type="submit" value="Submit">
 </fieldset>
</form>
```


```html
<form oninput="x.value=parseInt(a.value)+parseInt(b.value)">
  <input type="range" id="a" value="50">
  +<input type="number" id="b" value="25">
  =<output name="x" for="a b"></output>
</form>
```



## header

## hgroup
permet de regrouper des delements comme div pour titre et description
```html
<hgroup>
  <h2>Norway</h2>
  <p>The land with the midnight sun.</p>
</hgroup>
```
## input
Always use the <label> tag to define labels for 
```html
<input type="text">
<input type="checkbox">
<input type="radio">
<input type="file">
<input type="password">.

<input type="button">
<input type="checkbox">
<input type="color">

<input type="date">
<input type="datetime-local">
<input type="month">
<input type="time">
<input type="week">

<input type="email">
<input type="tel">

<input type="file">
<input type="image">

<input type="hidden">
<input type="password">

<input type="number">

<input type="range">

<input type="search">

<input type="reset">
<input type="submit">

<input type="text"> (default value)

<input type="url">
```


**attribut inputmode**
attribute allows you to change the appearance of the keyboard on a phone or tablet (any device with a virtual keyboard).
```html
<input type="text" inputmode="email">
<input type="text" inputmode="numeric">
```

## kbd
peu servir pour la synthese vocale ??
```html
<p>Press <kbd>Ctrl</kbd> + <kbd>C</kbd> to copy text (Windows).</p>
```

## label

## mapaera
Image + map area ; intéressant si onclick ?? **voir area onclick**
```html
<img src="workplace.jpg" alt="Workplace" usemap="#workmap" width="400" height="379">
<map name="workmap">
  <area shape="rect" coords="34,44,270,350" alt="Computer" href="computer.htm">
  <area shape="rect" coords="290,172,333,250" alt="Phone" href="phone.htm">
  <area shape="circle" coords="337,300,44" alt="Cup of coffee" href="coffee.htm">
</map>
```
[w3schools / tag area](https://www.w3schools.com/tags/tag_area.asp)
The <area> tag also supports the Event Attributes in HTML.


## main
Specify the main content of the document. There must not be more than one <main> element in a document. 

The <main> element must NOT be a descendant of an :
- <[article](https://github.com/arbph-dev/Laravel-discovery/blob/main/methodes/docs/html/Notes.md#article)>
- <[aside](https://github.com/arbph-dev/Laravel-discovery/blob/main/methodes/docs/html/Notes.md#aside)>
- <[footer](https://github.com/arbph-dev/Laravel-discovery/blob/main/methodes/docs/html/Notes.md#footer)>
- <[header](https://github.com/arbph-dev/Laravel-discovery/blob/main/methodes/docs/html/Notes.md#header)>
- <[nav](https://github.com/arbph-dev/Laravel-discovery/blob/main/methodes/docs/html/Notes.md#nav)>

```html
<main>
  <h1>Most Popular Browsers</h1>
  <p>Chrome, Firefox, and Edge are the most used browsers today.</p>

  <article>
    <h2>Google Chrome</h2>
    <p>Google Chrome is a web browser developed by Google, released in 2008. Chrome is the world's most popular web browser today!</p>
  </article>
```


## menu
The <menu> tag defines an unordered list of content.
```css
menu {
  display: block;
  list-style-type: disc;
  margin-block-start: 1em;
  margin-block-end: 1em;
  margin-inline-start: 0px;
  margin-inline-end: 0px;
  padding-inline-start: 40px;
}
```

## meter
apparait en vert mais semble similaire a [progress](https://github.com/arbph-dev/Laravel-discovery/blob/main/methodes/docs/html/Notes.md#progress)
```html
<label for="disk_d">Disk usage D:</label>
<meter id="disk_d" value="0.6">60%</meter>
```

## nav
The <nav> tag defines a set of navigation links.
The <nav> element is intended only for major blocks of navigation links.
```html
<nav>
  <a href="/html/">HTML</a>
```  
## ol
**liste**
```css  
ol.c {list-style-type: decimal;}
ol.d {list-style-type: decimal-leading-zero;}
ol.k {list-style-type: lower-alpha;}
ol.l {list-style-type: lower-greek;}
ol.m {list-style-type: lower-latin;}
ol.n {list-style-type: lower-roman;}
ol.o {list-style-type: upper-alpha;}
ol.p {list-style-type: upper-latin;}
ol.q {list-style-type: upper-roman;}
ol.r {list-style-type: none;}
ol.s {list-style-type: inherit;}
```  




## picture

```html
<picture>
  <source media="(min-width:650px)" srcset="img_pink_flowers.jpg">
  <source media="(min-width:465px)" srcset="img_white_flower.jpg">
  <img src="img_orange_flowers.jpg" alt="Flowers" style="width:auto;">
</picture>
```html



## progress 
apparait en bleu mais semble similaire a [meter](https://github.com/arbph-dev/Laravel-discovery/blob/main/methodes/docs/html/Notes.md#meter)
```html
<label for="file">Downloading progress:</label>
<progress id="file" value="32" max="100"> 32% </progress>
```

## search
```html
<search>
  <form>
    <input name="fsrch" id="fsrch" placeholder="Search W3Schools">
  </form>
</search>
```
## select
```html
  <select name="cars" id="cars">
    <optgroup label="Swedish Cars">
      <option value="volvo">Volvo</option>
      <option value="saab">Saab</option>
    </optgroup>
    <optgroup label="German Cars">
      <option value="mercedes">Mercedes</option>
      <option value="audi">Audi</option>
    </optgroup>
  </select>
```

## template
**a tester **
comme en svg on définit le "symbole" et on l'ajoute dans la strucuture
```html
  <button onclick="showContent()">Show hidden content</button>
  
  <template>
    <h2>Flower</h2>
    <img src="img_white_flower.jpg" width="214" height="204">
  </template>
  
  <script>
  function showContent() {
    let temp = document.getElementsByTagName("template")[0];
    let clon = temp.content.cloneNode(true);
    document.body.appendChild(clon);
  }
  </script>
```

## time
valeur dans la structure mais invisible des users comme data
time * selon 
```html
<time datetime="2008-02-14 20:00">Valentines day</time> apparait pas
<time>21:00</time> apparait
```
## ul
**liste**




# CSS
## Recherche 
object:focus

