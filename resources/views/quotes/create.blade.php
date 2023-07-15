@extends('layouts.master')

@section('content')
    <form action="{{ route('quotes.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-12 mt-3 mb-5">
                <div class="card">
                    <div class="card-body">
                        <h3 class="mb-3">Nueva Cotización</h3>

                        <div class="row g-3">
                            <div class="col-md-4">
                                <label for="date" class="form-label">Fecha</label>
                                <input name="fecha_cot" value="{{ date('Y-m-d') }}" type="date" class="form-control"
                                    id="date">
                            </div>

                            <div class="col-md-4">
                                <label for="quoteNum" class="form-label">No. Cotización</label>
                                <input name="num_cotizacion" value="{{ old('num_cotizacion', $folio) }}" type="text"
                                    class="form-control" id="quoteNum">
                            </div>

                            <div class="col-md-4">
                                <label for="numOrder" class="form-label">No. Orden</label>
                                <input name="num_orden" type="text" class="form-control" id="numOrder">
                            </div>

                            <div class="col-md-6">
                                <label for="name" class="form-label">Nombre</label>
                                <input name="nombre" type="text" class="form-control" id="name">
                            </div>

                            <div class="col-md-6">
                                <label for="company" class="form-label">Empresa</label>
                                <select name="empresa_id" id="company" class="form-control">
                                    <option selected disabled>Selecciona una opción...</option>
                                    @foreach ($companies as $company)
                                        <option value="{{ $company->id }}">{{ $company->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-3">
                                <label for="deliveryDate" class="form-label">Fecha de Entrega</label>
                                <input name="fecha_ent" type="date" class="form-control" id="deliveryDate">
                            </div>

                            <div class="col-md-3">
                                <label for="deliveryTime" class="form-label">Hora de Entrega</label>
                                <input name="hora_ent" type="time" class="form-control" id="deliveryTime">
                            </div>

                            <div class="col-md-6">
                                <label for="deliveryPlace" class="form-label">Lugar de Entrega</label>
                                <input name="lugar_ent" type="text" class="form-control" id="deliveryPlace">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h3 class="mb-3">Servicios</h3>

                        <div class="row" id="serviciosContainer">
                            <div class="col-12">
                                <div class="row g-3">
                                    <div class="col-md-1">
                                        <label for="firstNum" class="form-label">Num.</label>
                                        <input type="text" value="1" class="form-control" id="firstNum" readonly>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="service" class="form-label">Servicio</label>
                                        <input name="servicios[0][servicio]" type="text" class="form-control"
                                            id="service">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="dateService" class="form-label">Fecha</label>
                                        <input name="servicios[0][fecha_serv]" type="date" class="form-control"
                                            id="dateService">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="boat" class="form-label">Embarcación</label>
                                        <input type="text" class="form-control" id="boat">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="host" class="form-label">Huesped</label>
                                        <input name="servicios[0][huesped]" type="text" class="form-control"
                                            id="host">
                                    </div>
                                    <div class="col-md-2">
                                        <label for="quantity" class="form-label">Cantidad</label>
                                        <input name="servicios[0][cantidad]" type="text" class="form-control"
                                            id="quantity">
                                    </div>
                                    <div class="col-md-2">
                                        <label for="unitPrice" class="form-label">Precio Unitario</label>
                                        <input name="servicios[0][precio_unitario]" type="text" class="form-control"
                                            id="unitPrice">
                                    </div>
                                    <div class="col-md-2">
                                        <label for="total" class="form-label">Total</label>
                                        <input name="servicios[0][total]" type="text" class="form-control"
                                            id="total">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-12 d-grid">
                                <button class="btn btn-success" type="button" id="addRowBtn">Agregar Servicio</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 d-flex flex-wrap gap-2">
                <button class="btn btn-primary" type="submit">Crear Cotización</button>
                <div class="vr"></div>
                <a href="{{ route('quotes.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </div>
    </form>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            let rowCount = 2;
            $('#addRowBtn').click(function() {
                let newService = `
                <div class="col-12 mt-5">
                    <div class="row g-3">  
                        <div class="col-md-1">
                            <label class="form-label">Num.</label>
                            <input type="text" value="${rowCount}" class="form-control" id="num" readonly>
                        </div>
                        <div class="col-md-4">
                            <label for="service" class="form-label">Servicio</label>
                            <input name="servicios[${rowCount}][servicio]" type="text" class="form-control"
                                id="service">
                        </div>
                        <div class="col-md-3">
                            <label for="dateService" class="form-label">Fecha</label>
                            <input name="servicios[${rowCount}][fecha_serv]" type="date" class="form-control"
                                id="dateService">
                        </div>
                        <div class="col-md-4">
                            <label for="boat" class="form-label">Embarcación</label>
                            <input type="text" class="form-control" id="boat">
                        </div>
                        <div class="col-md-4">
                            <label for="host" class="form-label">Huesped</label>
                            <input name="servicios[${rowCount}][huesped]" type="text" class="form-control"
                                id="host">
                        </div>
                        <div class="col-md-2">
                            <label for="quantity" class="form-label">Cantidad</label>
                            <input name="servicios[${rowCount}][cantidad]" type="text" class="form-control"
                                id="quantity">
                        </div>
                        <div class="col-md-2">
                            <label for="unitPrice" class="form-label">Precio Unitario</label>
                            <input name="servicios[${rowCount}][precio_unitario]" type="text" class="form-control"
                                id="unitPrice">
                        </div>
                        <div class="col-md-2">
                            <label for="total" class="form-label">Total</label>
                            <input name="servicios[${rowCount}][total]" type="text" class="form-control"
                                id="total">
                        </div>
                        <div class="col-md-2 d-grid align-items-end">
                            <button type="button" class="btn btn-outline-danger btn-eliminar">Remover</button>
                        </div>
                    </div>
                </div>
                `;
                $('#serviciosContainer').append(newService);
                rowCount++;
            });

            $(document).on('click', '.btn-eliminar', function() {
                $(this).closest('.col-12').remove();
                rowCount = 2;
                actualizarNumerosID();
            });

            function actualizarNumerosID(){
                let idInputs = $('#serviciosContainer').find('input[id="num"]');
                idInputs.each(function(index, input){
                    $(input).val(index + 2);
                });
            }
        });

        // document.addEventListener('DOMContentLoaded', function() {
        //     let addRowBtn = document.getElementById('addRowBtn');
        //     let serviciosContainer = document.getElementById('serviciosContainer');
        //     let rowCount = 2;

        //     addRowBtn.addEventListener('click', function() {
        //         let servicioRow = document.createElement('div');
        //         servicioRow.classList.add('row', 'border');

        //         servicioRow.innerHTML = `
    //             <div class="col-md-1">
    //                 <label for="id" class="form-label">ID</label>
    //                 <input type="text" value="${rowCount}" class="form-control" id="id" readonly>
    //             </div>
    //             <div class="col-md-4">
    //                 <label for="service" class="form-label">Servicio</label>
    //                 <input name="servicios[${rowCount}][servicio]" type="text" class="form-control">
    //             </div>
    //             <div class="col-md-3">
    //                 <label for="dateService" class="form-label">Fecha</label>
    //                 <input name="servicios[${rowCount}][fecha_serv]" type="date" class="form-control">
    //             </div>
    //             <div class="col-md-4">
    //                 <label class="form-label">Embarcación</label>
    //                 <input type="text" class="form-control">
    //             </div>
    //             <div class="col-md-5">
    //                 <label for="host" class="form-label">Huesped</label>
    //                 <input name="servicios[${rowCount}][huesped]" type="text" class="form-control">
    //             </div>
    //             <div class="col-md-2">
    //                 <label for="quantity" class="form-label">Cantidad</label>
    //                 <input name="servicios[${rowCount}][cantidad]" type="text" class="form-control"> 
    //             </div>
    //             <div class="col-md-2">
    //                 <label for="unitPrice" class="form-label">Precio Unitario</label>
    //                 <input name="servicios[${rowCount}][precio_unitario]" type="text" class="form-control">    
    //             </div>
    //             <div class="col-md-2">
    //                 <label for="total" class="form-label">Total</label>
    //                 <input name="servicios[${rowCount}][total]" type="text" class="form-control">     
    //             </div>
    //             <div class="col-md-1">
    //                 <label class="form-label"></label>
    //                 <button class="btn btn-danger" type="button" onclick="eliminarFila(this)">X</button>
    //             </div>
    //         `;

        //         serviciosContainer.appendChild(servicioRow);
        //         rowCount++;
        //     });

        //     function eliminarFila(btnEliminar) {
        //         let fila = btnEliminar.closest('.row');
        //         fila.remove();
        //     }
        // });
    </script>
@endsection
