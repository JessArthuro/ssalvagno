@extends('layouts.master')

@section('content')
    @include('companies.form', [
        'title' => 'Nueva',
        'action' => route('companies.store'),
        'method' => 'POST',
        'nameValue' => old('nombre'),
        'icon' => 'save',
        'titleBtn' => 'Crear',
    ])
@endsection
