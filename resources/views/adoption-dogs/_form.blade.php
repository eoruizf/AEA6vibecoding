@csrf
<label>Nombre</label>
<input name="name" value="{{ old('name', $dog->name ?? '') }}" required>

<label>Descripción</label>
<textarea name="description" rows="4">{{ old('description', $dog->description ?? '') }}</textarea>

<label>Fecha de nacimiento</label>
<input type="date" name="date_of_birth" value="{{ old('date_of_birth', isset($dog) ? $dog->date_of_birth?->format('Y-m-d') : '') }}">

<label>Raza</label>
<input name="breed" value="{{ old('breed', $dog->breed ?? '') }}">

<label>Sexo</label>
<select name="sex" required>
    @foreach(\App\Models\AdoptionDog::SEXES as $k => $l)
        <option value="{{ $k }}" @selected(old('sex', $dog->sex ?? '') === $k)>{{ $l }}</option>
    @endforeach
</select>

<label>Tamaño</label>
<select name="size">
    <option value="">-</option>
    @foreach(\App\Models\AdoptionDog::SIZES as $k => $l)
        <option value="{{ $k }}" @selected(old('size', $dog->size ?? '') === $k)>{{ $l }}</option>
    @endforeach
</select>

<label>Peso (kg)</label>
<input type="number" step="0.01" name="weight" value="{{ old('weight', $dog->weight ?? '') }}">

<label>Color</label>
<input name="color" value="{{ old('color', $dog->color ?? '') }}">

<label>Ciudad</label>
<input name="city" value="{{ old('city', $dog->city ?? '') }}">

<label>Estado</label>
<select name="status" required>
    @foreach(\App\Models\AdoptionDog::STATUSES as $k => $l)
        <option value="{{ $k }}" @selected(old('status', $dog->status ?? 'available') === $k)>{{ $l }}</option>
    @endforeach
</select>

<label>Características</label>
@foreach([
    'is_neutered' => 'Esterilizado/a', 'is_vaccinated' => 'Vacunado/a', 'is_microchipped' => 'Con microchip',
    'good_with_kids' => 'Bueno con niños', 'good_with_dogs' => 'Bueno con otros perros',
] as $field => $text)
    <label style="font-weight:400">
        <input type="checkbox" name="{{ $field }}" value="1" @checked(old($field, $dog->$field ?? false))> {{ $text }}
    </label>
@endforeach

<label>Requisitos de adopción</label>
<textarea name="adoption_requirements" rows="3">{{ old('adoption_requirements', $dog->adoption_requirements ?? '') }}</textarea>

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

<label>Añadir fotos (máx. 6, 2 MB cada una)</label>
<input type="file" name="photos[]" accept="image/*" multiple>

<br><br>
<button class="btn">Guardar</button>
<a class="btn btn-gray" href="{{ route('adoption-dogs.index') }}">Volver</a>