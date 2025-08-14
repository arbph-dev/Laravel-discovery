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

<label for="w">Largeur (px)</label><br>
<input type="number" name="w" id="w" value="{{ old('w', $image->w ?? '') }}">
@if($errors->has('w'))
    <div style="color:red">{{ $errors->first('w') }}</div>
@endif
<br>

<label for="h">Hauteur (px)</label><br>
<input type="number" name="h" id="h" value="{{ old('h', $image->h ?? '') }}">
@if($errors->has('h'))
    <div style="color:red">{{ $errors->first('h') }}</div>
@endif
<br>

<label for="ext">Extension</label><br>
<input type="text" name="ext" id="ext" value="{{ old('ext', $image->ext ?? '') }}">
@if($errors->has('ext'))
    <div style="color:red">{{ $errors->first('ext') }}</div>
@endif
<br>

<button type="submit">{{ $image ? 'Mettre à jour' : 'Enregistrer' }}</button>
