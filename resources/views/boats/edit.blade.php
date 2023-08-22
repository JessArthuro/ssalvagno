@extends('layouts.master')

@section('content')
    @include('boats.form', [
        'title' => 'Editar',
        'action' => route('boats.update', $boat),
        'method' => 'PUT',
        'nameValue' => old('nombre', $boat->nombre),
        'icon' => 'sync',
        'titleBtn' => 'Actualizar',
    ])
@endsection
