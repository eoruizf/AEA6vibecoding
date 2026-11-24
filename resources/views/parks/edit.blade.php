@extends('layouts.app')
@section('title', 'Editar parque')
@section('content')
<div class="card">
    <h2>Editar parque</h2>
    <form method="POST" action="{{ route('admin.parks.update', $park) }}" enctype="multipart/form-data">
        @csrf @method('PUT')
        @include('parks._form')
    </form>
</div>
@endsection
