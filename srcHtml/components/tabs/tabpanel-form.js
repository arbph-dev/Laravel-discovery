// tabpanel-form.js -- autonomous form for create/edit
class TabpanelForm extends HTMLElement {
  constructor() {
    super();
    this._record = null;
  }

  connectedCallback() {
    this.setAttribute('role', 'tabpanel');
    this.hidden = true;
    this._render();
    this._bindEvents();
  }

  _render() {
    this.innerHTML = `
      <div class="tb-form">
        <form>
          <input type="hidden" name="id" value="">
          <label>Adresse: <input type="text" name="label" value=""></label>
          <div>
            <button type="submit">Enregistrer</button>
            <button type="button" id="cancel">Annuler</button>
          </div>
        </form>
      </div>
    `;
  }

  _bindEvents() {
    const form = this.querySelector('form');
    form.addEventListener('submit', (e) => {
      e.preventDefault();
      const fd = new FormData(form);
      const record = {
        id: fd.get('id') ? Number(fd.get('id')) : null,
        label: fd.get('label') || ''
      };
      // The component is autonomous: it can dispatch an internal event that other panels listen to.
      this.dispatchEvent(new CustomEvent('record-saved', { bubbles: true, detail: { record } }));
      // clear or keep as desired
      this._clear();
    });

    this.querySelector('#cancel').addEventListener('click', () => {
      this._clear();
    });

    // listen for internal open-edit/open-create events (from sibling list)
    this.addEventListener('open-edit', (e) => {
      if (e.detail && e.detail.record) this.loadData(e.detail.record);
    });
    this.addEventListener('open-create', () => {
      this.loadData({ id: null, label: '' });
    });
  }

  loadData(record) {
    this._record = record || { id: null, label: '' };
    const form = this.querySelector('form');
    form.id.value = this._record.id ?? '';
    form.label.value = this._record.label ?? '';
  }

  _clear() {
    this.loadData({ id: null, label: '' });
  }
}
customElements.define('tabpanel-form', TabpanelForm);
