@extends('layouts.master')

@section('content')
    @include('boats.form', [
        'title' => 'Nueva',
        'action' => route('boats.store'),
        'method' => 'POST',
        'nameValue' => old('nombre'),
        'icon' => 'save',
        'titleBtn' => 'Crear',
    ])
@endsection
