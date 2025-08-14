@props(['image' => null])

@csrf
@if($image)
    @method('PUT')
@endif

<label for="filename">Fichier image</label><br>
<input type="file" name="filename" id="filename">
@if($errors->has('filename'))
    <div style="color:red">{{ $errors->first('filename') }}</div>
@endif
<br>

{{-- Champ path supprimé, il sera généré après upload --}}

<label for="description">Description (SEO / alt)</label><br>
<textarea name="description" id="description">{{ old('description', $image->description ?? '') }}</textarea>
@if($errors->has('description'))
    <div style="color:red">{{ $errors->first('description') }}</div>
@endif
<br>

{{-- Champ w supprimé, il sera généré après upload --}}

{{-- Champ h supprimé, il sera généré après upload --}}

{{-- Champ ext supprimé, il sera généré après upload --}}

<button type="submit">{{ $image ? 'Mettre à jour' : 'Enregistrer' }}</button>
