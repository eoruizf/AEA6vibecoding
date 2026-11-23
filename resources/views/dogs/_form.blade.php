@csrf
<label>Nombre</label>
<input name="name" value="{{ old('name', $dog->name ?? '') }}" required>

<label>Descripción</label>
<textarea name="description" rows="3" style="width:100%;padding:8px;border:1px solid #ccc;border-radius:6px">{{ old('description', $dog->description ?? '') }}</textarea>

<label>Fecha de nacimiento</label>
<input type="date" name="date_of_birth" value="{{ old('date_of_birth', isset($dog) ? $dog->date_of_birth?->format('Y-m-d') : '') }}">

<label>Raza</label>
<input name="breed" value="{{ old('breed', $dog->breed ?? '') }}">

<label>Sexo</label>
<select name="sex" required>
    @foreach(\App\Models\Dog::SEXES as $s)
        <option value="{{ $s }}" @selected(old('sex', $dog->sex ?? '') === $s)>{{ $s === 'male' ? 'Macho' : 'Hembra' }}</option>
    @endforeach
</select>

<label>Peso (kg)</label>
<input type="number" step="0.01" name="weight" value="{{ old('weight', $dog->weight ?? '') }}">

<label>Color</label>
<input name="color" value="{{ old('color', $dog->color ?? '') }}">

<label>Microchip</label>
<input name="microchip_number" value="{{ old('microchip_number', $dog->microchip_number ?? '') }}">

<label><input type="checkbox" name="is_neutered" value="1" @checked(old('is_neutered', $dog->is_neutered ?? false))> Esterilizado/a</label>

@if(isset($dog) && $dog->photos)
    <label>Fotos actuales (marca las que quieras eliminar)</label>
    <div class="row" style="flex-wrap:wrap">
        @foreach($dog->photos as $i => $path)
            <label style="font-weight:400">
                <img src="{{ $dog->photo_urls[$i] }}" style="width:90px;height:90px;object-fit:cover;border-radius:6px;display:block">
                <input type="checkbox" name="remove_photos[]" value="{{ $path }}"> eliminar
            </label>
        @endforeach
    </div>
@endif

<label>Añadir fotos (máx. 5, 2 MB cada una)</label>
<input type="file" name="photos[]" accept="image/*" multiple>

<br><br>
<button class="btn">Guardar</button>
<a class="btn btn-gray" href="{{ route('dogs.index') }}">Volver</a>