@csrf
<label>Nombre</label>
<input name="name" value="{{ old('name', $veterinaryCenter->name ?? '') }}" required>

<label>Descripción</label>
<textarea name="description" rows="4">{{ old('description', $veterinaryCenter->description ?? '') }}</textarea>

<label>Dirección</label>
<input name="address" value="{{ old('address', $veterinaryCenter->address ?? '') }}" required>

<label>Ciudad</label>
<input name="city" value="{{ old('city', $veterinaryCenter->city ?? '') }}" required>

<label>Latitud</label>
<input type="number" step="0.0000001" min="-90" max="90" name="latitude" value="{{ old('latitude', $veterinaryCenter->latitude ?? '') }}">

<label>Longitud</label>
<input type="number" step="0.0000001" min="-180" max="180" name="longitude" value="{{ old('longitude', $veterinaryCenter->longitude ?? '') }}">

<label>Teléfono</label>
<input name="phone" value="{{ old('phone', $veterinaryCenter->phone ?? '') }}">

<label>Email</label>
<input type="email" name="email" value="{{ old('email', $veterinaryCenter->email ?? '') }}">

<label>Sitio web</label>
<input type="url" name="website" value="{{ old('website', $veterinaryCenter->website ?? '') }}">

<label>Horarios de atención</label>
<textarea name="opening_hours" rows="3">{{ old('opening_hours', $veterinaryCenter->opening_hours ?? '') }}</textarea>

<label>Servicios veterinarios</label>
@foreach(\App\Http\Controllers\VeterinaryCenterController::SERVICES as $service)
    <label style="font-weight:400">
        <input type="checkbox" name="services[]" value="{{ $service }}" @checked(in_array($service, old('services', $veterinaryCenter->services ?? []), true))>
        {{ $service }}
    </label>
@endforeach

@if(isset($veterinaryCenter) && $veterinaryCenter->image_url)
    <label>Fotografía actual</label>
    <img src="{{ $veterinaryCenter->image_url }}" alt="{{ $veterinaryCenter->name }}" style="width:200px;height:200px;object-fit:cover;border-radius:8px;display:block;margin-bottom:8px">
@endif

<label>Fotografía (máx. 2 MB, JPG, PNG o WebP)</label>
<input type="file" name="image" accept="image/jpeg,image/png,image/webp">

<br><br>
<button class="btn">Guardar</button>
<a class="btn btn-gray" href="{{ route('veterinary-centers.index') }}">Volver</a>
