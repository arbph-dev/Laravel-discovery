<form action="{{ $route }}" method="POST">
    @csrf
    @if($method === 'PUT')
        @method('PUT')
    @endif

    {{-- Affichage des erreurs de validation --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div>
        <label for="titre" class="cp_form-label">Titre</label>
        <input type="text" name="titre" class="cp_form-field" value="{{ old('titre', $realisation->titre) }}" required>
    </div>

    <div>
        <label for="vaeexp_id" class="cp_form-label">Expérience parente</label>
        <select name="vaeexp_id" class="cp_form-field" required>
            <option value="">-- Aucune --</option>
            @foreach($vaeexps as $vaeexp)
                <option value="{{ $vaeexp->id }}" 
				{{ old('vaeexp_id', $vaeexpId ?? ($realisation->vaeexp_id ?? '')) == $vaeexp->id ? 'selected' : '' }}>				
                {{ $vaeexp->fonction ?? $vaeexp->id }}
                </option>
            @endforeach
        </select>
    </div>









    <div>
        <label for="organisation_id" class="cp_form-label">Organisation (optionnel)</label>
        <select name="organisation_id" class="cp_form-field">
            <option value="">-- Aucune --</option>
            @foreach($organisations as $org)
                <option value="{{ $org->id }}" {{ old('organisation_id', $realisation->organisation_id) == $org->id ? 'selected' : '' }}>
                    {{ $org->lbl ?? $org->id }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label class="cp_form-label">Description</label>
        <textarea name="description" class="cp_form-field" rows="4">{{ old('description', $realisation->description) }}</textarea>
    </div>

    <div>
        <label class="cp_form-label">Résultat</label>
        <input type="text" name="resultat" class="cp_form-field" value="{{ old('resultat', $realisation->resultat) }}">
    </div>

    <div>
        <label class="cp_form-label">Conclusion</label>
        <input type="text" name="conclusion" class="cp_form-field" value="{{ old('conclusion', $realisation->conclusion) }}">
    </div>

    <div>
        <label for="date_realisation" class="cp_form-label">Date</label>
        <input type="date" class="cp_form-field" name="date_realisation" value="{{ old('date_realisation', $realisation->date_realisation ? \Illuminate\Support\Carbon::parse($realisation->date_realisation)->format('Y-m-d') : '') }}">
    </div>

    <div>
        <label for="competences" class="cp_form-label">Compétences associées</label>
        <select name="competences[]" id="competences" class="cp_form-field" multiple>
            @foreach($competences as $competence)
                <option value="{{ $competence->id }}"
                    @if(is_array(old('competences')))
                        {{ in_array($competence->id, old('competences', [])) ? 'selected' : '' }}
                    @elseif(isset($realisation) && $realisation->competences)
                        {{ $realisation->competences->contains('id', $competence->id) ? 'selected' : '' }}
                    @endif
                >
                    {{ $competence->nom ?? $competence->id }}
                </option>
            @endforeach
        </select>
        <small>Utilisez Ctrl (Windows) ou Cmd (Mac) pour sélectionner plusieurs compétences.</small>
    </div>


	<div>
		<label class="cp_form-label">Images associées (IDs séparés par des ;)</label>
		<input type="text" name="images_ids" class="cp_form-field"
			   value="{{ old('images_ids', isset($realisation) ? $realisation->images->pluck('id')->implode(';') : '') }}">
		<small>Exemple : 1;5;9</small>
	</div>

    <br>
    <button type="submit" class="btn btn-success">Enregistrer</button>
    <a href="{{ route('realisations.index') }}">Annuler</a>
</form>
