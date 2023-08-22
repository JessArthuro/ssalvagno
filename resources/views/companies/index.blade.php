@extends('layouts.master')

@section('content')
    <section class="px-5 py-4 mb-5">
        <div class="d-flex justify-content-between mt-3 mb-5">
            <h3>Lista de Empresas</h3>
            <a href="{{ route('companies.create') }}" class="btn btn-primary"><i class="las la-plus"></i> Nueva Empresa</a>
        </div>

        <div class="card">
            <div class="card-body">
                <table class="table table-hover text-center pt-3" id="example">
                    <thead>
                        <tr class="table-dark">
                            <th class="text-light text-center">Nombre</th>
                            <th class="text-light text-center">Logo</th>
                            <th class="text-light text-center">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($companies as $company)
                            <tr>
                                <td>{{ $company->nombre }}</td>
                                <td>{{ $company->logo }}</td>
                                <td>
                                    @include('layouts.partials.actions', [
                                        'editAction' => route('companies.edit', $company),
                                        'deleteAction' => route('companies.destroy', $company),
                                    ])
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
