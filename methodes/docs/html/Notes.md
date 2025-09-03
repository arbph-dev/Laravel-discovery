
# Noeuds Tags

- [details](https://github.com/arbph-dev/Laravel-discovery/blob/main/methodes/docs/html/Notes.md#details) **a tester **
- [hgroup](https://github.com/arbph-dev/Laravel-discovery/blob/main/methodes/docs/html/Notes.md#hgroup)
- [meter](https://github.com/arbph-dev/Laravel-discovery/blob/main/methodes/docs/html/Notes.md#meter)
- [nav](https://github.com/arbph-dev/Laravel-discovery/blob/main/methodes/docs/html/Notes.md#nav)
- [ol](https://github.com/arbph-dev/Laravel-discovery/blob/main/methodes/docs/html/Notes.md#ol)
- [progress](https://github.com/arbph-dev/Laravel-discovery/blob/main/methodes/docs/html/Notes.md#progress)
- [search](https://github.com/arbph-dev/Laravel-discovery/blob/main/methodes/docs/html/Notes.md#search) **utilité??**
- [select](https://github.com/arbph-dev/Laravel-discovery/blob/main/methodes/docs/html/Notes.md#select) **optgroup a connaitre**
- [Template](https://github.com/arbph-dev/Laravel-discovery/blob/main/methodes/docs/html/Notes.md#Template)**a tester **
- [ul](https://github.com/arbph-dev/Laravel-discovery/blob/main/methodes/docs/html/Notes.md#ul)



[
](
https://github.com/arbph-dev/Laravel-discovery/blob/main/methodes/docs/html/Notes.md#
)




## details
semblable callout ;) => **a tester, img svg**
```html
<details>
  <summary>Epcot Center</summary>
  <p>Epcot is a theme park at Walt Disney World Resort featuring exciting attractions, international pavilions, award-winning fireworks and seasonal special events.</p>
</details>
```

## hgroup
permet de regrouper des delements comme div pour titre et description

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
<nav>
  <a href="/html/">HTML</a> |
  
## ol
**liste**
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
## Select
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

## Template
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



## ul
**liste**




# CSS
## Recherche 
object:focus

