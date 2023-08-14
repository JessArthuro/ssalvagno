@extends('layouts.master')

@section('content')
    <h3 class="mt-3 mb-5">Nueva Embarcación</h3>

    @include('boats.form', [
      'action' => route('boats.store'),
      'method' => 'POST',
      'nameValue' => old('nombre'),
      'icon' => 'save',
      'titleBtn' => 'Crear',
    ])
@endsection