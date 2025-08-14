
# Gestion Treeview


## modifer vue vaeexps.index et modiier controller(?)
- [vaeexps.index](../srcLaravel/resources/views/vaeexps/index.blade.php)

le code 
```blade
<ul class="TreeCmp_tree">
	@foreach($vaeexps as $exp)
		@php
			$grouped = $exp->realisations->groupBy(function($r) {
				return $r->client?->lbl ?? '_autres';
			});
			$totalCount = $exp->realisations->count();
		@endphp

		<li class="TreeCmp_node">
			<span class="TreeCmp_toggle" onclick="TreeCmp_toggle(this)">▶</span>
			<strong>{{ $exp->fonction }}</strong>
			chez 
			<a href="{{ route('organisations.show', $exp->organisation) }}">{{ $exp->organisation->lbl }}</a>
			({{ $exp->dd }} → {{ $exp->df }}) <span class="TreeCmp_count">[{{ $totalCount }}]</span>

			@auth
				@if (Auth::user()->role === 'admin')
					<a href="{{ route('realisations.create', ['vaeexp_id' => $exp->id]) }}">Ajouter une réalisation</a>
				@endif
			@endauth




			@if($totalCount > 0)
			<ul class="TreeCmp_children TreeCmp_hidden">
				@foreach($grouped as $client => $realisations)
					<li class="TreeCmp_node">
						<span class="TreeCmp_toggle" onclick="TreeCmp_toggle(this)">▶</span>
						@if($client !== '_autres')
							Réalisations pour <strong>{{ $client }}</strong>
						@else
							<em>Autres réalisations</em>
						@endif
						<span class="TreeCmp_count">[{{ $realisations->count() }}]</span>
						<ul class="TreeCmp_children TreeCmp_hidden">
							@foreach($realisations->sortBy('titre') as $rexp)
								<li>
									<a href="{{ route('realisations.show', $rexp) }}">
										{{ $rexp->titre }} [{{ $rexp->id }}]
									</a>
								</li>
							@endforeach
						</ul>
					</li>
				@endforeach
			</ul>
			@endif
		</li>
		<hr/>
	@endforeach
	</ul>
```


## modif style
- voir ci dessous
- [pure_style.css](../srcLaravel/public/build/assets/pure_style.css) 

##ajout script
- la fonction js est associé a window et doit etre anonyme (module)
- on inclue le script : **TreeCmp_toggleAll** dans la vue [vaeexps.index](../srcLaravel/resources/views/vaeexps/index.blade.php)
```
	<button id="TreeCmp_toggleAll" class="TreeCmp_expandBtn" onclick="TreeCmp_toggleAll()">Tout déplier</button>
```

le code js suivant est implémenté dans [pure_script.js](../srcLaravel/public/build/assets/pure_script.js) au ligne 150 à 185 (20250814)
```js
// Treeview
//doit etre affecte a window pour etre appelele depusi HTML
// doit etre une fonction anomyne

//affiche masque un element
window.TreeCmp_toggle = (element) => {
    const node = element.parentElement;
    const children = node.querySelector('.TreeCmp_children');

    if (!children) return;

    if (children.classList.contains('TreeCmp_hidden')) {
        children.classList.remove('TreeCmp_hidden');
        element.textContent = '▼';
    } else {
        children.classList.add('TreeCmp_hidden');
        element.textContent = '▶';
    }
}
//affiche masque tous les elements
window.TreeCmp_toggleAll = () => {
    const btn = document.getElementById('TreeCmp_toggleAll');
    const expand = btn.dataset.state !== 'expanded';

    document.querySelectorAll('.TreeCmp_children').forEach(el => {
        el.classList.toggle('TreeCmp_hidden', !expand);
    });

    document.querySelectorAll('.TreeCmp_toggle').forEach(el => {
        el.textContent = expand ? '▼' : '▶';
    });

    btn.textContent = expand ? 'Tout replier' : 'Tout déplier';
    btn.dataset.state = expand ? 'expanded' : 'collapsed';
}

```



## Style css
Voir [pure_style.css](../srcLaravel/public/build/assets/pure_style.css) lignes 200 à 250 (20280814)
manque ici : 
- TreeCmp_expandBtn et TreeCmp_expandBtn:hover

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

