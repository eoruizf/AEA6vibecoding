@extends('layouts.app')
@section('title', 'Nuevo parque')
@section('content')
<div class="card">
    <h2>Nuevo parque</h2>
    <form method="POST" action="{{ route('admin.parks.store') }}" enctype="multipart/form-data">
        @include('parks._form')
    </form>
</div>
@endsection
