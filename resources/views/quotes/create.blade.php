@extends('layouts.master')

@section('css')
    <style>
        .select2-container--bootstrap4 .select2-selection--multiple {
            min-height: calc(1.75em + 0.75rem + 2px) !important;
        }
    </style>
@endsection

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
                                        <select name="servicios[0][servicio][]" id="service" class="form-control select_a"
                                            multiple onchange="updateUnitPrice()">
                                            @foreach ($foods as $food)
                                                <option value="{{ $food->id }}" id="food_{{ $food->id }}"
                                                    data-price="{{ $food->precio }}">{{ $food->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="dateService" class="form-label">Fecha</label>
                                        <input name="servicios[0][fecha_serv]" type="date" class="form-control"
                                            id="dateService">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="boat" class="form-label">Embarcación</label>
                                        <select name="servicios[0][embarcacion_id]" id="boat" class="form-control">
                                            <option selected disabled>Selecciona una opción...</option>
                                            @foreach ($boats as $boat)
                                                <option value="{{ $boat->id }}">{{ $boat->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="host" class="form-label">Huesped</label>
                                        <input name="servicios[0][huesped]" type="text" class="form-control"
                                            id="host">
                                    </div>
                                    <div class="col-md-2">
                                        <label for="quantity" class="form-label">Cantidad</label>
                                        <input name="servicios[0][cantidad]" type="number" value="1"
                                            min="1" class="form-control" id="quantity" onchange="updateTotal()">
                                    </div>
                                    <div class="col-md-2">
                                        <label for="unitPrice" class="form-label">Precio Unitario</label>
                                        <input name="servicios[0][precio_unitario]" type="text" placeholder="0.00"
                                            class="form-control" id="unitPrice" readonly onchange="updateTotal()">
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
                <a href="{{ route('quotes.index') }}" class="btn btn-outline-secondary">Cancelar</a>
            </div>
        </div>
    </form>
@endsection

@section('js')
    <script>
        $('.select_a').select2({
            theme: "bootstrap4",
            placeholder: "",
            allowClear: true,
        });

        // Funciones para calcular el precio unitario y total de los servicios
        document.addEventListener('DOMContentLoaded', function() {
            updateUnitPrice();
            updateTotal();
        });

        function updateUnitPrice() {
            let opcionesSeleccionadas = document.querySelectorAll('#service option:checked');
            let precioUnitario = 0;

            for (let i = 0; i < opcionesSeleccionadas.length; i++) {
                let opcion = opcionesSeleccionadas[i].getAttribute('data-price');
                precioUnitario += parseFloat(opcion);
            }

            document.getElementById('unitPrice').value = precioUnitario.toFixed(2);
            updateTotal();
        }

        function updateTotal() {
            let cantidad = parseInt(document.getElementById('quantity').value);
            let precioUnitario = parseFloat(document.getElementById('unitPrice').value);
            let total = cantidad * precioUnitario;

            document.getElementById('total').value = total.toFixed(2);
        }

        $(document).ready(function() {
            let rowCount = 2;

            // Funcion para actualizar el precio unitario y total
            function updateUnitPriceAndTotal(rowIndex) {
                let quantity = parseInt($(`#quantity_${rowIndex}`).val()) || 0;
                let unitPrice = 0;

                $(`#service${rowIndex} option:selected`).each(function() {
                    unitPrice += parseFloat($(this).data('price')) || 0;
                });

                $(`#unitPrice_${rowIndex}`).val(unitPrice.toFixed(2) || 0);

                let total = quantity * unitPrice;
                $(`#total_${rowIndex}`).val(total.toFixed(2)) || 0;
            }

            // Funcion para agregar una nueva fila de servicios de manera dinamica
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
                            <select name="servicios[${rowCount}][servicio][]"
                                        class="form-control dynamic-select" id="service${rowCount}" multiple>
                                @foreach ($foods as $food)
                                    <option value="{{ $food->id }}" id="food_${rowCount}_{{ $food->id }}"
                                        data-price="{{ $food->precio }}">{{ $food->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="dateService" class="form-label">Fecha</label>
                            <input name="servicios[${rowCount}][fecha_serv]" type="date" class="form-control"
                                id="dateService">
                        </div>
                        <div class="col-md-4">
                            <label for="boat" class="form-label">Embarcación</label>
                            <select name="servicios[${rowCount}][embarcacion_id]" id="boat" class="form-control">
                                <option selected disabled>Selecciona una opción...</option>
                                @foreach ($boats as $boat)
                                    <option value="{{ $boat->id }}">{{ $boat->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="host" class="form-label">Huesped</label>
                            <input name="servicios[${rowCount}][huesped]" type="text" class="form-control"
                                id="host">
                        </div>
                        <div class="col-md-2">
                            <label for="quantity" class="form-label">Cantidad</label>
                            <input name="servicios[${rowCount}][cantidad]" type="number" min="1" value="1" class="form-control"
                                id="quantity_${rowCount}">
                        </div>
                        <div class="col-md-2">
                            <label for="unitPrice" class="form-label">Precio Unitario</label>
                            <input name="servicios[${rowCount}][precio_unitario]" type="text" class="form-control"
                                id="unitPrice_${rowCount}">
                        </div>
                        <div class="col-md-2">
                            <label for="total" class="form-label">Total</label>
                            <input name="servicios[${rowCount}][total]" type="text" class="form-control"
                                id="total_${rowCount}">
                        </div>
                        <div class="col-md-2 d-grid align-items-end">
                            <button type="button" class="btn btn-outline-danger btn-eliminar">Remover</button>
                        </div>
                    </div>
                </div>
                `;

                $('#serviciosContainer').append(newService);

                let currentRowCount = rowCount;

                // Inicializar el plugin Select2
                initializeSelect2(currentRowCount);

                // Asignar evento onchange a los inputs de cantidad y precio unitario
                $(`#quantity_${currentRowCount}`).on('change', function() {
                    updateUnitPriceAndTotal(currentRowCount);
                });

                $(`#unitPrice_${currentRowCount}`).on('change', function() {
                    updateUnitPriceAndTotal(currentRowCount);
                });

                // Actualizar el precio unitario y el total al agregar una nueva fila
                updateUnitPriceAndTotal(currentRowCount);
                rowCount++;
            });

            function initializeSelect2(rowIndex) {
                $(`#service${rowIndex}`).select2({
                    theme: "bootstrap4",
                    placeholder: "",
                    allowClear: true,
                }).on('change', function() {
                    updateUnitPriceAndTotal(rowIndex);
                });
            }

            // Funcion para eliminar una fila de servicios
            $(document).on('click', '.btn-eliminar', function() {
                $(this).closest('.col-12').remove();
                rowCount = 2;
                actualizarNumerosID();
                initializeSelect2(rowCount - 1);
            });

            // Funcion para actualizar los numeros de ID despues de eliminar una fila
            function actualizarNumerosID() {
                let idInputs = $('#serviciosContainer').find('input[id="num"]');
                idInputs.each(function(index, input) {
                    $(input).val(index + 2);
                });
            }
        });
    </script>
@endsection
