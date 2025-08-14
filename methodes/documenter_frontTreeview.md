
Gestion Treeview

modifer vue vaeexps.index et modiier controller(?)
- [vaeexps.index](../srcLaravel/resources/views/vaeexps/index.blade.php)

modif style
- voir ci dessous
- [pure_style.css](../srcLaravel/public/build/assets/pure_style.css) 
ajout script
- la fonction js est associé a window et doit etre anonyme (module)


## Style css
```
.TreeCmp_tree {
    list-style: none;
    padding-left: 0;
    font-family: sans-serif;
}

.TreeCmp_node {
    margin: 5px 0;
    position: relative;
}

.TreeCmp_toggle {
    cursor: pointer;
    margin-right: 5px;
    color: #007BFF;
    font-weight: bold;
}

.TreeCmp_toggle::after {
    content: "";
}

.TreeCmp_count {
    color: #666;
    font-size: 0.9em;
    margin-left: 5px;
}

.TreeCmp_children {
    padding-left: 20px;
    margin-top: 5px;
}

.TreeCmp_hidden {
    display: none;
}
```

