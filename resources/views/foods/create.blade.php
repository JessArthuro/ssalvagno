@extends('layouts.master')

@section('content')
    <h3 class="mt-3 mb-5">Nuevo Alimento</h3>

    @include('foods.form', [
        'action' => route('foods.store'),
        'method' => 'POST',
        'nameValue' => old('nombre'),
        'priceValue' => old('precio'),
        'icon' => 'save',
        'titleBtn' => 'Crear',
    ])
@endsection
