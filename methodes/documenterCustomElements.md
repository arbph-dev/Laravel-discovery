# 2025-09-08
## Essai
2 composants sont réalisés , le troisième doit être validé

[InforBar](../scrhtml/Infobar.js)













# Documentations
le code est tirée de cette page : [MDN / exportparts](https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Global_attributes/exportparts)
Quelques questions relatives au composant et customElements

## A - Possibilités de la technologie

Depuis le composant Peut on accéder a 
- window A1 : ✅ oui
- les api comme speechsynthesis A2 : ✅ oui
- fetch A3 : ✅ oui
- declencher des evenemts dans le composant A4 : ✅ oui
- declencher des evenemts exploitable dans la page A5 : ✅ oui
- utiliser canvas ou svg A6 : ✅ oui
- importer des modules A7 : ✅ oui
- utiliser des librairie comme threejs A8 : ✅ oui
- utiliser element.dataset ( DOMStringMap) A9 : ✅ oui

## B - limitations de la technologie

- Isolation : le Shadow DOM isole le style et le DOM → parfois compliqué de faire communiquer le CSS de la page hôte avec l’intérieur du composant.
  - Styling : le style de la page hôte ne traverse pas le Shadow DOM (sauf avec :host, ::part, ::slotted). 
- SEO / Accessibilité : certains moteurs de recherche et outils d’accessibilité ont du mal avec des contenus encapsulés dans Shadow DOM.
- Interop : pas tous les frameworks ne gèrent pas bien les Custom Elements (ex: React a eu longtemps des frictions).
- Chargement : les composants sont déclarés via customElements.define(). S’ils ne sont pas définis au moment de l’insertion, ils apparaissent comme des "unknown element".
- Pas de polyfill complet natif : dans les vieux navigateurs (IE…), ça ne marche pas sans polyfills.

## C - Showcase et projets
Quels projets consulter pour se former ?

- [Using_templates_and_slots](https://developer.mozilla.org/en-US/docs/Web/API/Web_components/Using_templates_and_slots)
- [tag template](https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/template)
- [tag slot](https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/slot)
- [using_templates_with_web_components](https://developer.mozilla.org/en-US/docs/Web/API/Web_components/Using_templates_and_slots#using_templates_with_web_components)
- [adding_flexibility_with_slots](https://developer.mozilla.org/en-US/docs/Web/API/Web_components/Using_templates_and_slots#adding_flexibility_with_slots)
- [events / avoiding_documentfragment_pitfalls ](https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/template#avoiding_documentfragment_pitfalls)
- [part](https://developer.mozilla.org/en-US/docs/Web/API/Element/part)**script event listener**
- [ShadowRoot](https://developer.mozilla.org/en-US/docs/Web/API/ShadowRoot)

exemples

- [composants todos](https://github.com/shprink/web-components-todo)

MDN Web Components guide (templates, slots, shadow DOM).
Lit → framework léger pour simplifier la création de Web Components.
Shoelace → librairie complète de composants UI en Web Components pur.
Vaadin Components → gros set de composants Web Components.
WebComponents.org → annuaire de composants.

Exemples pratiques → rechercher "Using templates and slots" / "adding flexibility with slots" ( tag template, tag slot, part, event listener, etc.).


## D mise en oeuvre
Puis je déclarer les composants dans un module  ? que faire du html ?

Déclarer dans un module → ✅ oui
**my-element.js :**
```js
class MyElement extends HTMLElement {
  constructor() {
    super();
    this.attachShadow({ mode: "open" });
    this.shadowRoot.innerHTML = `<p>Hello</p>`;
  }
}
customElements.define("my-element", MyElement);
```
est importé
```html
<script type="module" src="my-element.js"></script>
<my-element></my-element>
```
#### Template HTML
Tu peux stocker ton <template> directement dans le module JS, ou dans le DOM principal.

- un template défini en HTML
```html
<template id="tpl-hello">
  <style>p { color: red; }</style>
  <p>Hello <slot></slot></p>
</template>
```

est récupéré en js comme ceci
```
const tpl = document.getElementById("tpl-hello");
this.shadowRoot.appendChild(tpl.content.cloneNode(true));
```


- 


- on initialise la page cree les noeuds tempalte dans le dom
- puis on execute le script customElements.define()
- enfin on ajoute les noeuds composant dans le dom

Puis je déclarer les composants dans un module et des sous composant dans un autre modules? 
On peut créer plusieurs fichiers a-component.js, b-component.js, et un main.js qui importe les deux. Chaque module dispose de son customElements.define().

si besoin on emploie un script commun qui importe les deux?

si je place le composant dans un div caché jusqu'a la fin du chargment des scripts customElements.define ça peut passer ?

Placer le composant dans un div hidden avant define() , ça marche, mais mieux vaut charger les scripts avant.
Si un composant inconnu est présent dans le DOM, il sera "upgrade" automatiquement dès que customElements.define() est exécuté.
→ Donc pas grave si l’élément est déjà là.


- différence entre this.querySelector('todo-input') et this.shadowRoot.querySelector('todo-input') 
#### this.querySelector('todo-input')
this.querySelector(...) → cherche dans le contenu fourni par l’utilisateur entre les balises du composant.
Si tu fais this.querySelector(...), la recherche se fait dans le Light DOM, c’est-à-dire le contenu "normal" inséré par l’utilisateur de ton composant.

Ici this est ton élément custom (par ex. <todo-app>).
```html
<todo-app>
  <todo-input></todo-input> <!-- trouvé par this.querySelector -->
</todo-app>
```
#### this.shadowRoot.querySelector('todo-input')
this.shadowRoot.querySelector(...) → cherche dans ton template encapsulé (le rendu interne du composant).
Accede à un composant avec Shadow DOM, tout le contenu est encapsulé dans le Shadow DOM. Le "monde extérieur" (la page) ne peut pas voir directement ce qui est dedans.
```js
this.attachShadow({ mode: 'open' });
this.shadowRoot.innerHTML = `
  <todo-input></todo-input>
  <button>Ajouter</button>
`;
```
Donc si tu veux récupérer <todo-input> à l’intérieur de ton Shadow DOM, tu dois cibler :
```js
this.shadowRoot.querySelector('todo-input');
```







## Méthodes

on crée le template (HTML ou JS).
on crée le script (classe extends HTMLElement.)
Faire customElements.define().
on emploie le composant dans html

## Templates

### card-component-template
a voir
- id a employer dans js **card-component-template**

- :host ??
  The :host CSS pseudo-class selects the shadow host of the shadow DOM containing the CSS it is used inside
  in other words, this allows you to select a custom element from inside its shadow DOM.
  voir [styling_the_shadow_host](https://developer.mozilla.org/en-US/docs/Web/CSS/:host#styling_the_shadow_host)

- structure exports => base ?
 
  - base
    - div part header
      - slot header_slot
    - div part body
      - slot body_slot
    ...

- ces elements exports sont utilise dans le template **card-wrapper**
```html  
 <card-component exportparts="base, header, body">
```



```html
<template id="card-component-template">
  <style>
    :host {
      display: block;
    }
  </style>
  <div class="base" part="base">

    <div part="header">
      <slot name="header_slot"></slot>
    </div>

    <div part="body">
      <slot name="body_slot"></slot>
    </div>

    <div part="footer">
      <slot name="footer_slot"></slot>
    </div>

  </div>
</template>
```

### card-wrapper

Selon le principe des poupées russes on encaspule les composants
Les elements exports du template **card-component-template** 
```html
  <div class="base" part="base">
```

sont utilise dans le template **card-wrapper**
```html
 <card-component exportparts="base, header, body">
```
Erreur ? doit on placer footer pluto que base ?
plus bas dans la page => Note footer is not bold when nested, **as we did not include it** in exportparts.
=> a corriger alors ?? base est donc nécessaire ?


```html
<template id="card-wrapper">
  <style>
    :host {
      display: block;
    }
  </style>
  <card-component exportparts="base, header, body">
    <slot name="H" slot="header_slot"></slot>
    <slot name="B" slot="body_slot"></slot>
    <slot name="F" slot="footer_slot"></slot>
  </card-component>
</template>
```

## Definition

### card-component
- on definit le nom du composant : "card-component"
- on assignr le template "card-component-template"

a documenter:
- this.attachShadow et mode: "open"?

```js
customElements.define(
  "card-component",
  class extends HTMLElement {
    constructor() {
      super(); // Always call super first in constructor
      const cardComponent = document.getElementById(
        "card-component-template",
      ).content;
      const shadowRoot = this.attachShadow({
        mode: "open",
      });
      shadowRoot.appendChild(cardComponent.cloneNode(true));
    }
  },
);
```

### card-wrapper

```js
customElements.define(
  "card-wrapper",
  class extends HTMLElement {
    constructor() {
      super(); // Always call super first in constructor
      const cardWrapper = document.getElementById("card-wrapper").content;
      const shadowRoot = this.attachShadow({
        mode: "open",
      });
      shadowRoot.appendChild(cardWrapper.cloneNode(true));
    }
  },
);

```



## exploitation
### card-component
We also use the new element we created, populating the slots with plain text as content.
on note pas de template dans lexplitation du composant voir le code Javascript declarant le composant

```html
<card-component>
  <p slot="header_slot">This is the header</p>
  <p slot="body_slot">This is the body</p>
  <p slot="footer_slot">This is the footer</p>
</card-component>
```
### card-component

```html
<card-wrapper>
  <p slot="H">This is the header</p>
  <p slot="B">This is the body</p>
  <p slot="F">This is the footer</p>
</card-wrapper>
```




## style 
We style parts of the <card-component> shadow tree using the ::part pseudo-element:




```css
:host {  background-color: aqua; font-weight: bold; }

h2 {  background-color: #dedede;}

card-wrapper, card-component { border: 1px dashed blue; width: fit-content; }

::part(body) { color: red; font-style: italic; }

::part(header), ::part(footer) {  font-weight: bold;}
```


