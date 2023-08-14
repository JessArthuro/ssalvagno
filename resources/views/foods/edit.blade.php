@extends('layouts.master')

@section('content')
    <h3 class="mt-3 mb-5">Editar Alimento</h3>

    @include('foods.form', [
      'action' => route('foods.update', $food),
      'method' => 'PUT',
      'nameValue' => old('nombre', $food->nombre),
      'priceValue' => old('precio', $food->precio),
      'icon' => 'sync',
      'titleBtn' => 'Actualizar'
    ])
@endsection
