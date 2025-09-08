// tabpanel-liste.js -- autonomous list panel with search + CRUD buttons
class TabpanelListe extends HTMLElement {
  constructor() {
    super();
    this._items = [];
  }

  connectedCallback() {
    this.setAttribute('role', 'tabpanel');
    this.hidden = true;
    this.render();
  }

  render() {
    this.innerHTML = `
      <div class="tb-search">
        <label>Adresse:
          <input type="text" name="stext" value="">
        </label>
        <button id="search">Rechercher</button>
        <button id="load">Charger exemple</button>
      </div>
      <div><button id="create">Créer</button></div>
      <ul class="tb-list"></ul>
    `;
    this._bind();
  }

  _bind() {
    this.querySelector('#search').addEventListener('click', () => {
      const q = this.querySelector('input[name=stext]').value.trim();
      this.loadFromApi(q || '7 rue nationale');
    });
    this.querySelector('#load').addEventListener('click', () => {
      this.loadFromApi('7 rue nationale');
    });
    this.querySelector('#create').addEventListener('click', () => {
      // open form internally by dispatching a self-event that Tabs will handle
      // but to remain autonomous we trigger the internal method that the form listens to
      this._dispatchInternal('open-create', { });
    });
  }

  _dispatchInternal(name, detail={}) {
    // Internal custom event (bubbles to allow sibling panels inside same <my-tabs> to react)
    this.dispatchEvent(new CustomEvent(name, { bubbles: true, detail }));
  }

  async loadFromApi(query) {
    const url = 'https://api-adresse.data.gouv.fr/search/?q=' + encodeURIComponent(query);
    try {
      const res = await fetch(url);
      if (!res.ok) throw new Error('HTTP ' + res.status);
      const data = await res.json();
      this._items = data.features.map((f, idx) => ({ id: idx, label: f.properties.label, raw: f }));
      this._renderList();
    } catch (err) {
      this._renderError(err);
    }
  }

  _renderList() {
    const ul = this.querySelector('.tb-list');
    ul.innerHTML = '';
    this._items.forEach((it) => {
      const li = document.createElement('li');
      li.textContent = it.label;

      const edit = document.createElement('button');
      edit.textContent = 'Modifier';
      edit.addEventListener('click', () => this._dispatchInternal('open-edit', { record: it }));

      const del = document.createElement('button');
      del.textContent = 'Supprimer';
      del.addEventListener('click', () => {
        this._items = this._items.filter(x => x !== it);
        li.remove();
      });

      li.append(' ', edit, ' ', del);
      ul.appendChild(li);
    });
  }

  _renderError(err) {
    const ul = this.querySelector('.tb-list');
    ul.innerHTML = '<li style="color:red">Erreur: ' + err.message + '</li>';
  }

  // Optional API for parent usage: get current items
  get items() { return this._items.slice(); }
}
customElements.define('tabpanel-liste', TabpanelListe);
