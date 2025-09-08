// tabs.js
class Tabs extends HTMLElement {
  constructor() {
    super();
    this._onTabSelect = this._onTabSelect.bind(this);
    this._onKeyNav = this._onKeyNav.bind(this);
  }

  connectedCallback() {
    this.setAttribute('role', 'tablist');
    this.addEventListener('tab-select', this._onTabSelect);
    this.addEventListener('tab-key-nav', this._onKeyNav);
    // select first tab by default
    const first = this.querySelector('my-tab');
    if (first) first.select();
  }

  disconnectedCallback() {
    this.removeEventListener('tab-select', this._onTabSelect);
    this.removeEventListener('tab-key-nav', this._onKeyNav);
  }

  _onTabSelect(event) {
    const selectedTab = event.detail.tab;
    const tabs = Array.from(this.querySelectorAll('my-tab'));
    const panels = Array.from(this.querySelectorAll('my-tab-panel'));

    tabs.forEach((tab, idx) => {
      const panel = panels[idx];
      const isSelected = tab === selectedTab;
      tab.setAttribute('aria-selected', isSelected ? 'true' : 'false');
      tab.setAttribute('tabindex', isSelected ? '0' : '-1');
      if (panel) panel.hidden = !isSelected;
      if (isSelected) tab.focus();
    });
  }

  _onKeyNav(event) {
    const { tab, key } = event.detail;
    const tabs = Array.from(this.querySelectorAll('my-tab'));
    const current = tabs.indexOf(tab);
    if (current === -1) return;
    let next;
    switch (key) {
      case 'ArrowLeft': next = (current - 1 + tabs.length) % tabs.length; break;
      case 'ArrowRight': next = (current + 1) % tabs.length; break;
      case 'Home': next = 0; break;
      case 'End': next = tabs.length - 1; break;
    }
    if (typeof next === 'number') tabs[next].select();
  }
}

customElements.define('my-tabs', Tabs);
