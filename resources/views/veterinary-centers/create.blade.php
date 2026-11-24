@extends('layouts.app')
@section('title', 'Nuevo centro veterinario')
@section('content')
<div class="card">
    <h2>Nuevo centro veterinario</h2>
    <form method="POST" action="{{ route('admin.veterinary-centers.store') }}" enctype="multipart/form-data">
        @include('veterinary-centers._form')
    </form>
</div>
@endsection
