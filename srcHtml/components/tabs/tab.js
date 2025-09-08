// tab.js
class Tab extends HTMLElement {
  constructor() {
    super();
    this.addEventListener('click', () => this.select());
    this.addEventListener('keydown', (e) => this._onKeyDown(e));
  }

  connectedCallback() {
    this.setAttribute('role', 'tab');
    if (!this.hasAttribute('tabindex')) this.setAttribute('tabindex', '-1');
  }

  select() {
    // internal selection event (bubbles so Tabs component can handle)
    this.dispatchEvent(new CustomEvent('tab-select', { bubbles: true, detail: { tab: this } }));
  }

  _onKeyDown(event) {
    const key = event.key;
    if (['ArrowLeft','ArrowRight','Home','End'].includes(key)) {
      event.preventDefault();
      this.dispatchEvent(new CustomEvent('tab-key-nav', { bubbles: true, detail: { tab: this, key } }));
    }
  }
}

customElements.define('my-tab', Tab);
