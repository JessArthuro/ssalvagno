@extends('layouts.master')

@section('content')
    <h3 class="mt-3 mb-5">Editar Empresa</h3>

    @include('companies.form', [
      'action' => route('companies.update', $company),
      'method' => 'PUT',
      'nameValue' => old('nombre', $company->nombre),
      'icon' => 'sync',
      'titleBtn' => 'Actualizar'
    ])

@endsection