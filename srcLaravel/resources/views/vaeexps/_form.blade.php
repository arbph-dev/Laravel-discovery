@csrf
@if(isset($vaeexp))
    @method('PUT')
@endif

<label for="dd" class="cp_form-label">Date début</label>
<input type="date" class="cp_form-field" name="dd" value="{{ old('dd', $vaeexp->dd ?? '') }}">
<br/>

<label for="df" class="cp_form-label">Date fin</label>
<input type="date" class="cp_form-field" name="df" value="{{ old('df', $vaeexp->df ?? '') }}">
<br/>

<label for="fonction" class="cp_form-label">Fonction</label>
<input type="text" class="cp_form-field" name="fonction" value="{{ old('fonction', $vaeexp->fonction ?? '') }}">
<br/>

<label for="description" class="cp_form-label">Description</label>
<textarea name="description" class="cp_form-field" >{{ old('description', $vaeexp->description ?? '') }}</textarea>
<br/>

<label for="organisation_id" class="cp_form-label">Organisation</label>
<select name="organisation_id" class="cp_form-field">
    @foreach ($organisations as $organisation)
        <option value="{{ $organisation->id }}"
            {{ old('organisation_id', $organisationId ?? ($vaeexp->organisation_id ?? '')) == $organisation->id ? 'selected' : '' }}>
            {{ $organisation->lbl }}
        </option>
    @endforeach
</select>

<br/>

<input type="submit" class="cp_form-submit">
