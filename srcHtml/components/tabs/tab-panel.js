// tab-panel.js
class TabPanel extends HTMLElement {
  connectedCallback() {
    this.setAttribute('role', 'tabpanel');
    if (this.hasAttribute('hidden') === false) this.hidden = true;
  }

  // Hook: override in subclasses to receive data objects
  loadData(data) {
    // default: replace content
    this.innerHTML = JSON.stringify(data, null, 2);
  }
}
customElements.define('my-tab-panel', TabPanel);
