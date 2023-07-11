@extends('layouts.master')

@section('content')
  <div class="d-flex justify-content-between mt-3 mb-5">
    <h3>Lista de Empresas</h3>
    <a href="{{ route('companies.create') }}" class="btn btn-primary">+ Nueva Empresa</a>
</div>

<div class="card">
    <div class="card-body">
        <table class="table table-hover text-center pt-3" id="example">
            <thead>
                <tr class="table-dark">
                    <th class="text-light text-center">ID</th>
                    <th class="text-light text-center">Nombre</th>
                    <th class="text-light text-center">Logo</th>
                    <th class="text-light text-center">Opciones</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
@endsection