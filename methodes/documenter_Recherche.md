# Recherche ( dans les réalisation )

```blade
	<form method="GET" action="{{ route('vaeexps.index') }}">
		<input type="text" name="q" value="{{ $q }}" placeholder="Texte libre (titre, description...)">

		<select name="organisation_id">
			<option value="">Tous clients</option>
			@foreach($organisations as $org)
				<option value="{{ $org->id }}" @selected($organisationId == $org->id)>{{ $org->lbl }}</option>
			@endforeach
		</select>

		<select name="competence_id">
			<option value="">Toutes compétences</option>
			@foreach($competences as $comp)
				<option value="{{ $comp->id }}" @selected($competenceId == $comp->id)>{{ $comp->nom }}</option>
			@endforeach
		</select>

		<button type="submit">Rechercher</button>
	</form>	
```
