Tab components (self-contained)
--------------------------------
This archive contains a minimal set of Web Component files implementing:
- my-tab
- my-tabs
- my-tab-panel (base)
- tabpanel-liste (self-contained: search + load from API)
- tabpanel-form (self-contained: form save emits internal handling only)
- index.html demo that imports components via <script type="module">

The components are autonomous: they do not rely on the parent page to handle events.
You can open index.html in a modern browser (served by a static server or via file:// depending on CORS).
