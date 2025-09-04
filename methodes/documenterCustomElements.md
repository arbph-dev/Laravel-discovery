le code est tirée de cette page
[MDN / exportparts](https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Global_attributes/exportparts)


Quelques questions relatives au composant et customElements

### A - Possibilités de la technologie

Depuis le composant Peut on accéder a 
- window A1 : oui / non
- les api comme speechsynthesis A2 : oui / non
- fetch A3 : oui / non
- declencher des evenemts dans le composant A4 : oui / non
- declencher des evenemts exploitable dans la page A5 : oui / non
- utiliser canvas ou svg A6 : oui / non
- importer des modules A7 : oui / non
- utiliser des librairie comme threejs A8 : oui / non
- utiliser element.dataset ( DOMStringMap) A9 : oui / non

### B - limitations de la technologie
Quelles sont les limitations ?

### C - Showcase et projets
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


### D mise en oeuvre
Puis je déclarer les composants dans un module  ? que faire du html ?
- on initialise la page cree les noeuds tempalte dans le dom
- puis on execute le script customElements.define()
- enfin on ajoute les noeuds composant dans le dom

Puis je déclarer les composants dans un module et des sous composant dans un autre modules? 
si besoin on emploie un script commun qui importe les deux?

si je place le composant dans un div caché jusqu'a la fin du chargment des scripts customElements.define ça peut passer ?

## Méthodes

on crée le template
on crée le script
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


