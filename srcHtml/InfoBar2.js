class InfoBar2 extends HTMLElement {
    
    //------------------------------------------------
    //this._type = null;
    constructor() {

        

        super()
        this._type = null // ajout propriété type pour gérer danger etc...
        this._nodAside = null
        this.attachShadow({ mode: "open" })

        this.shadowRoot.innerHTML = `
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/5/w3.css">
        <aside class="w3-panel w3-red">
        <h3>Alarme! ce</h3>
        <p>Rouge pour indiquer une anomalie</p>
        </aside>
        `
        this.addEventListener('click', this._onClick.bind(this));
        
    }
    static get observedAttributes() {
        return ['type'];//observedAttributes = ["type"] // ajout propriété type pour gérer danger etc...
    }
    //--------------------------------------------------------
    connectedCallback() { 
        console.log("Component added to page, spawn redraw.")
        //this._nodAside = this.shadowRoot.querySelectorAll("aside.w3-panel")[0];

        setTimeout(() => this._reDraw(), 0); // attend que le DOM soit prêt
    }

    disconnectedCallback() { console.log("Custom element removed from page.") }

    connectedMoveCallback() { console.log("Custom element moved with moveBefore()") }

    adoptedCallback() { console.log("Custom element moved to new page.") }

    attributeChangedCallback(name, oldValue, newValue) { 
        console.log(`Attribute ${name} has changed.`)
        
        if ( name === "type") { this._type = newValue }
        
        this._reDraw()
    }

    // ajout propriété type pour gérer danger etc...
    get type() { return this._type; } 
    // 1 getter 1 setter par attribut à géré
    set type(v) { this.setAttribute("type", v); }
    
    _reDraw(){
      this._nodAside = this.shadowRoot.querySelector("aside")
      
      if (!this._nodAside) return;

      this._nodAside.classList.remove("w3-blue", "w3-yellow", "w3-red", "w3-green" )
      // const cells = table.getElementsByTagName("td")      
      switch( this._type )
      {
        case "alert":
          this._nodAside.classList.add( "w3-red" )
          //H3Info.innerHTML = "Alert"
          break;
        case "information":
          this._nodAside.classList.add( "w3-blue" )
          //H3Info.innerHTML = "Information"
          break;
        case "success":
          this._nodAside.classList.add( "w3-green" )
          //H3Info.innerHTML = "Success"
          break;
        case "warning":
          this._nodAside.classList.add( "w3-yellow" )
          //H3Info.innerHTML = "Warning"
          break;
        default: break;                      
      }

    }

    
    _onClick(event) { console.log("Custom element onClick event") }

}
customElements.define("info-bar2", InfoBar2);