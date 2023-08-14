@extends('layouts.master')

@section('content')
    <h3 class="mt-3 mb-5">Editar Embarcación</h3>

    @include('boats.form', [
      'action' => route('boats.update', $boat),
      'method' => 'PUT',
      'nameValue' => old('nombre', $boat->nombre),
      'icon' => 'sync',
      'titleBtn' => 'Actualizar',
    ])
@endsection