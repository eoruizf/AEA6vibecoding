@extends('layouts.app')
@section('title', 'Editar centro veterinario')
@section('content')
<div class="card">
    <h2>Editar centro veterinario</h2>
    <form method="POST" action="{{ route('admin.veterinary-centers.update', $veterinaryCenter) }}" enctype="multipart/form-data">
        @csrf @method('PUT')
        @include('veterinary-centers._form')
    </form>
</div>
@endsection
