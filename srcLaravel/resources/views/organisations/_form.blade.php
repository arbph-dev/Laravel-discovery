@csrf
@if(isset($organisation))
  @method('PUT')
@endif

<label for="nom" class="cp_form-label">Raison sociale</label>
<input type="text" class="cp_form-field" name="lbl" value="{{ old('lbl', $organisation->lbl ?? '') }}">
<br/>

<label for="adville" class="cp_form-label" >Ville</label>
<input type="text" class="cp_form-field" name="adville" value="{{ old('adville', $organisation->adville ?? '') }}">
<br/>

<label for="addep" class="cp_form-label" >Département</label>
<input type="text" class="cp_form-field" name="addep" value="{{ old('addep', $organisation->addep ?? '') }}">
<br/>

<label for="codeape" class="cp_form-label">Code APE</label>
<input type="text" class="cp_form-field" name="codeape" value="{{ old('codeape', $organisation->codeape ?? '') }}">
<br/>

<label for="lblape" class="cp_form-label">Activité APE</label>
<input type="text" class="cp_form-field" name="lblape" value="{{ old('lblape', $organisation->lblape ?? '') }}">
<br/>

<label for="urlweb" class="cp_form-label">Site web</label>
<input type="url" class="cp_form-field" name="urlweb" value="{{ old('urlweb', $organisation->urlweb ?? '') }}">
<br/>

<label for="urlreg" class="cp_form-label">Site registre</label>
<input type="url" class="cp_form-field" name="urlreg" value="{{ old('urlreg', $organisation->urlreg ?? '') }}">
<br/>

<label for="pich" class="cp_form-label">Image horizontale (nom du fichier)</label>
<input type="text" class="cp_form-field" name="pich" value="{{ old('pich', $organisation->pich ?? '') }}">
<br/>

<label for="picl"class="cp_form-label">Logo vertical (nom du fichier)</label>
<input type="text" class="cp_form-field" name="picl" value="{{ old('picl', $organisation->picl ?? '') }}">
<br/>

<input type="submit" class="cp_form-submit">

