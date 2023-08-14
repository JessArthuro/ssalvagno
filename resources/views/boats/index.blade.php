@extends('layouts.master')

@section('content')
    <div class="d-flex justify-content-between mt-3 mb-5">
        <h3>Lista de Embarcaciones</h3>
        <a href="{{ route('boats.create') }}" class="btn btn-primary"><i class="las la-plus"></i> Nueva Embarcación</a>
    </div>

    <div class="card">
        <div class="card-body">
            <table class="table table-hover text-center pt-3" id="example">
                <thead>
                    <tr class="table-dark">
                        <th class="text-light text-center">Nombre</th>
                        <th class="text-light text-center">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($boats as $boat)
                        <tr>
                            <td class="text-capitalize">{{ $boat->nombre }}</td>
                            <td>
                                @include('layouts.partials.actions', [
                                    'editAction' => route('boats.edit', $boat),
                                    'deleteAction' => route('boats.destroy', $boat),
                                ])
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
