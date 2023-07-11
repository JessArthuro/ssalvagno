@extends('layouts.master')

@section('content')
    <h3 class="mt-3 mb-5">Nueva Empresa</h3>

    @include('companies.form', [
      'action' => route('companies.store'),
      'method' => 'POST',
      'nameValue' => old('nombre'),
      'titleBtn' => 'Crear'
    ])

@endsection