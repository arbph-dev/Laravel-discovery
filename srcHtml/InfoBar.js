class InfoBar extends HTMLElement {
    constructor() {
        super()
    
        this.attachShadow({ mode: "open" })

        this.shadowRoot.innerHTML = `
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/5/w3.css">
        <aside class="w3-panel w3-red">
        <h3>Alarme! ce</h3>
        <p>Rouge pour indiquer une anomalie</p>
        </aside>
        `
    }

    connectedCallback() { console.log("Custom element added to page.") }

    disconnectedCallback() { console.log("Custom element removed from page.") }

    connectedMoveCallback() { console.log("Custom element moved with moveBefore()") }

    adoptedCallback() { console.log("Custom element moved to new page.") }

    attributeChangedCallback(name, oldValue, newValue) { console.log(`Attribute ${name} has changed.`) }

}
customElements.define("info-bar", InfoBar);