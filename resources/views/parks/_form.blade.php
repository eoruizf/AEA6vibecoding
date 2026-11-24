@csrf
<label>Nombre</label>
<input name="name" value="{{ old('name', $park->name ?? '') }}" required>

<label>Descripción</label>
<textarea name="description" rows="4">{{ old('description', $park->description ?? '') }}</textarea>

<label>Dirección</label>
<input name="address" value="{{ old('address', $park->address ?? '') }}" required>

<label>Ciudad</label>
<input name="city" value="{{ old('city', $park->city ?? '') }}" required>

<label>Latitud</label>
<input type="number" step="0.0000001" min="-90" max="90" name="latitude" value="{{ old('latitude', $park->latitude ?? '') }}">

<label>Longitud</label>
<input type="number" step="0.0000001" min="-180" max="180" name="longitude" value="{{ old('longitude', $park->longitude ?? '') }}">

<label>Teléfono</label>
<input name="phone" value="{{ old('phone', $park->phone ?? '') }}">

<label>Email</label>
<input type="email" name="email" value="{{ old('email', $park->email ?? '') }}">

<label>Sitio web</label>
<input type="url" name="website" value="{{ old('website', $park->website ?? '') }}">

<label>Horarios</label>
<textarea name="opening_hours" rows="3">{{ old('opening_hours', $park->opening_hours ?? '') }}</textarea>

<label>Servicios</label>
@foreach(['Agua', 'Canchas', 'Bancos', 'Bolsas para residuos', 'Zona vallada'] as $service)
    <label style="font-weight:400">
        <input type="checkbox" name="services[]" value="{{ $service }}" @checked(in_array($service, old('services', $park->services ?? []), true))>
        {{ $service }}
    </label>
@endforeach

<label style="font-weight:400">
    <input type="checkbox" name="has_dog_zone" value="1" @checked(old('has_dog_zone', $park->has_dog_zone ?? false))>
    Tiene zona canina
</label>

@if(isset($park) && $park->image_url)
    <label>Fotografía actual</label>
    <img src="{{ $park->image_url }}" alt="{{ $park->name }}" style="width:200px;height:200px;object-fit:cover;border-radius:8px;display:block;margin-bottom:8px">
@endif

<label>Fotografía (máx. 2 MB, JPG, PNG o WebP)</label>
<input type="file" name="image" accept="image/jpeg,image/png,image/webp">

<br><br>
<button class="btn">Guardar</button>
<a class="btn btn-gray" href="{{ route('parks.index') }}">Volver</a>
