@extends('layouts.master')

@section('content')
    @include('foods.form', [
        'title' => 'Nuevo',
        'action' => route('foods.store'),
        'method' => 'POST',
        'nameValue' => old('nombre'),
        'priceValue' => old('precio'),
        'icon' => 'save',
        'titleBtn' => 'Crear',
    ])
@endsection
