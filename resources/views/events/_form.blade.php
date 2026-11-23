@csrf
<label>Título</label>
<input name="title" value="{{ old('title', $event->title ?? '') }}" required>

<label>Descripción</label>
<textarea name="description" rows="4">{{ old('description', $event->description ?? '') }}</textarea>

<label>Comienza</label>
<input type="datetime-local" name="starts_at" value="{{ old('starts_at', isset($event) ? $event->starts_at->format('Y-m-d\TH:i') : '') }}" required>

<label>Termina (opcional)</label>
<input type="datetime-local" name="ends_at" value="{{ old('ends_at', isset($event) ? $event->ends_at?->format('Y-m-d\TH:i') : '') }}">

<label>Lugar</label>
<input name="location_name" value="{{ old('location_name', $event->location_name ?? '') }}">

<label>Dirección</label>
<input name="address" value="{{ old('address', $event->address ?? '') }}">

<label>Ciudad</label>
<input name="city" value="{{ old('city', $event->city ?? '') }}">

<label>Precio en € (vacío = gratis)</label>
<input type="number" step="0.01" min="0" name="price" value="{{ old('price', $event->price ?? '') }}">

<label>Plazas máximas (opcional)</label>
<input type="number" min="1" name="max_attendees" value="{{ old('max_attendees', $event->max_attendees ?? '') }}">

@isset($event)
    <label>Estado</label>
    <select name="status">
        @foreach(\App\Models\Event::STATUSES as $k => $l)
            <option value="{{ $k }}" @selected(old('status', $event->status) === $k)>{{ $l }}</option>
        @endforeach
    </select>

    @if($event->image_url)
        <label>Imagen actual</label>
        <img src="{{ $event->image_url }}" style="width:200px;border-radius:8px;display:block">
        <label style="font-weight:400"><input type="checkbox" name="remove_image" value="1"> Eliminar imagen</label>
    @endif
@endisset

<label>Imagen de portada (máx. 3 MB)</label>
<input type="file" name="image" accept="image/*">

<br><br>
<button class="btn">Guardar</button>
<a class="btn btn-gray" href="{{ route('events.index') }}">Volver</a>