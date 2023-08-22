@extends('layouts.master')

@section('content')
    @include('foods.form', [
        'title' => 'Editar',
        'action' => route('foods.update', $food),
        'method' => 'PUT',
        'nameValue' => old('nombre', $food->nombre),
        'priceValue' => old('precio', $food->precio),
        'icon' => 'sync',
        'titleBtn' => 'Actualizar',
    ])
@endsection
