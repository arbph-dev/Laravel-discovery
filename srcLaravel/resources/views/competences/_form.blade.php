<form action="{{ $route }}" method="POST">
    @csrf
    @if($method === 'PUT')
        @method('PUT')
    @endif

    <div class="mb-3">
        <label for="nom" class="form-label">Nom</label>
        <input type="text" name="nom" class="form-control" value="{{ old('nom', $competence->nom) }}" required>
    </div>

    <div class="mb-3">
        <label for="idp" class="form-label">Compétence parente</label>
        <select name="idp" class="form-control">
            <option value="">-- Aucune --</option>
            @foreach(App\Models\Competence::where('id', '!=', $competence->id ?? 0)->get() as $parent)
                <option value="{{ $parent->id }}" {{ old('idp', $competence->idp) == $parent->id ? 'selected' : '' }}>
                    {{ $parent->nom }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Code ROME</label>
        <input type="text" name="code_rome" class="form-control" value="{{ old('code_rome', $competence->code_rome) }}">
    </div>

    <div class="mb-3">
        <label class="form-label">Code Formacode</label>
        <input type="text" name="code_formacode" class="form-control" value="{{ old('code_formacode', $competence->code_formacode) }}">
    </div>

    <div class="mb-3">
        <label class="form-label">Code NSF</label>
        <input type="text" name="code_nsf" class="form-control" value="{{ old('code_nsf', $competence->code_nsf) }}">
    </div>

    <div class="mb-3">
        <label class="form-label">Code RNCP</label>
        <input type="text" name="code_rncp" class="form-control" value="{{ old('code_rncp', $competence->code_rncp) }}">
    </div>

    <div class="mb-3">
        <label class="form-label">Description</label>
        <textarea name="description" class="form-control" rows="4">{{ old('description', $competence->description) }}</textarea>
    </div>

    <button type="submit" class="btn btn-success">Enregistrer</button>
    <a href="{{ route('competences.index') }}" class="btn btn-secondary">Annuler</a>
</form>