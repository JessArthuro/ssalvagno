@extends('layouts.master')

@section('content')
    @include('companies.form', [
        'title' => 'Editar',
        'action' => route('companies.update', $company),
        'method' => 'PUT',
        'nameValue' => old('nombre', $company->nombre),
        'icon' => 'sync',
        'titleBtn' => 'Actualizar',
    ])
@endsection
