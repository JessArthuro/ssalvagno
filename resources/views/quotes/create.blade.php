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
        {{-- Datos de la Cotizacion --}}
        <div class="row mt-3 mb-5">
            <div class="col-12">
                <h3 class="mb-4">Nueva Cotización</h3>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-12">
                                <label for="date" class="form-label">Fecha</label>
                                <input name="fecha_cot" value="{{ date('Y-m-d') }}" type="date" class="form-control"
                                    id="date">
                            </div>

                            <div class="col-12">
                                <label for="quoteNum" class="form-label">No. Cotización</label>
                                <input name="num_cotizacion" value="{{ old('num_cotizacion', $folio) }}" type="text"
                                    class="form-control" id="quoteNum">
                            </div>

                            <div class="col-12">
                                <label for="numOrder" class="form-label">No. Orden <small
                                        class="text-muted">(Opcional)</small></label>
                                <input name="num_orden" type="text" class="form-control" id="numOrder">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Informacion de Entrega  --}}
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="row g-3">
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

                            <div class="col-md-4">
                                <label for="deliveryDate" class="form-label">Fecha de Entrega</label>
                                <input name="fecha_ent" type="date" class="form-control" id="deliveryDate">
                            </div>

                            <div class="col-md-4">
                                <label for="deliveryTime" class="form-label">Hora de Entrega</label>
                                <input name="hora_ent" type="time" class="form-control" id="deliveryTime">
                            </div>

                            <div class="col-md-4">
                                <label for="departureDate" class="form-label">Fecha de Salida</label>
                                <input name="fecha_sal" type="date" class="form-control" id="departureDate">
                            </div>

                            <div class="col-12">
                                <label for="deliveryPlace" class="form-label">Lugar de Entrega</label>
                                <input name="lugar_ent" type="text" class="form-control" id="deliveryPlace">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Datos del listado de Servicios  --}}
        <div class="row mt-2">
            <div class="col-12">
                <h3 class="mb-4">Servicios</h3>
            </div>

            <div class="col-12" id="serviciosContainer">
                <div class="row">
                    <div class="col-md-9 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row g-3">
                                            <div class="col-md-2">
                                                <label for="firstNum" class="form-label">No.</label>
                                                <input type="text" value="1" class="form-control" id="firstNum"
                                                    readonly>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="service" class="form-label">Alimentos</label>
                                                <select name="servicios[0][alimentos_ids][]" id="service"
                                                    class="form-control select_a" multiple onchange="updateUnitPrice()">
                                                    @foreach ($foods as $food)
                                                        <option value="{{ $food->id }}" id="food_{{ $food->id }}"
                                                            data-price="{{ $food->precio }}">{{ $food->nombre }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="dateService" class="form-label">Fecha</label>
                                                <input name="servicios[0][fecha_serv]" type="date"
                                                    class="form-control" id="dateService">
                                            </div>

                                            <div class="col-md-2">
                                                <label for="quantity" class="form-label">Cantidad</label>
                                                <input name="servicios[0][cantidad]" type="number" value="1"
                                                    min="1" class="form-control" id="quantity"
                                                    onchange="updateTotal()">
                                            </div>
                                            <div class="col-md-3">
                                                <label for="unitPrice" class="form-label">Precio Unitario</label>
                                                <input name="servicios[0][precio_unitario]" type="text"
                                                    placeholder="0.00" class="form-control" id="unitPrice" readonly
                                                    onchange="updateTotal()">
                                            </div>
                                            <div class="col-md-2">
                                                <label for="total" class="form-label">Total</label>
                                                <input name="servicios[0][total]" type="text" class="form-control"
                                                    id="total">
                                            </div>
                                            <div class="col-md-3" id="shippingCostContainer" style="display: none">
                                                <label for="shippingCost" class="form-label">Costo de Envío</label>
                                                <input name="servicios[0][costo_envio]" type="text" class="form-control"
                                                    id="shippingCost">
                                            </div>
                                        </div>
                                    </div>
                                    {{-- Aqui se genera otro col-12 de manera dinamica en cada nuevo servicio --}}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 mb-4">
                        <div class="card">
                            <div class="card-header bg-white">
                                <h4 class="mb-0">Lista de huespedes</h4>
                            </div>
                            <div class="card-body">
                                {{-- Contenedor del listado de huespedes por servicio --}}
                                <div class="row g-3" id="hostContainer">
                                    {{-- <div class="col-12">
                                        <div class="row g-3">
                                            <div class="col-md-2">
                                                <label for="firstNum" class="form-label">No.</label>
                                                <input type="text" value="1" class="form-control" id="firstNum"
                                                    readonly>
                                            </div>

                                            <div class="col-md-10">
                                                <label for="host" class="form-label">Huesped</label>
                                                <input name="servicios[0][huesped]" type="text" class="form-control"
                                                    id="host">
                                            </div>
                                            <div class="col-md-12">
                                                <label for="boat" class="form-label">Embarcación</label>
                                                <select name="servicios[0][embarcacion_id]" id="boat"
                                                    class="form-control">
                                                    <option selected disabled>Selecciona una opción...</option>
                                                    @foreach ($boats as $boat)
                                                        <option value="{{ $boat->id }}">{{ $boat->nombre }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div> --}}

                                    {{-- A partir de este espacio se iran agregando mas col-12 de forma dinamica dependiendo del numero de huespedes que requiera el servicio --}}
                                </div>

                                {{-- <div class="row mt-4">
                                    <div class="col-12 d-grid">
                                        <button class="btn btn-dark" type="button" id="addGuestRow"><i
                                                data-feather="plus" class="nav-icon icon-xs">
                                            </i> Huesped</button>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>

                {{-- A partir de este espacio se crearan las demas secciones de servicios de manera dinamica --}}
            </div>

            <div class="col-12 d-grid mb-4">
                <button class="btn btn-success" type="button" id="addRowBtn">Agregar Servicio</button>
            </div>
        </div>

        {{-- Botones de accion --}}
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
    {{-- Funciones para generar huespedes dependiendo del input cantidad en las secciones dinamica de servicios --}}
    <script>
        function createGuestSection(index) {
            const newGuest = `
            <div class="col-md-6 guest-row">
                <div class="row g-3">
                    <div class="col-md-2">
                        <label for="num${index}" class="form-label">No.</label>
                        <input type="text" value="${ index + 1}" class="form-control" id="num${index}" readonly>
                    </div>

                    <div class="col-md-10">
                        <label for="host${index}" class="form-label">Huesped</label>
                        <input name="huespedes[${index}][nombre]" type="text" class="form-control"
                            id="host${index}">
                    </div>

                    <div class="col-md-12">
                        <label for="boat${index}" class="form-label">Embarcación</label>
                        <select name="huespedes[${index}][embarcacion_id]" id="boat${index}" class="form-control">
                            <option selected disabled>Selecciona una opción...</option>
                            @foreach ($boats as $boat)
                                <option value="{{ $boat->id }}">{{ $boat->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="breakfasts${index}" class="form-label">Desayunos</label>
                        <input name="huespedes[${index}][desayunos]" type="number" class="form-control"
                            id="breakfasts${index}">
                    </div>

                    <div class="col-md-4">
                        <label for="foods${index}" class="form-label">Comidas</label>
                        <input name="huespedes[${index}][comidas]" type="number" class="form-control"
                            id="foods${index}">
                    </div>

                    <div class="col-md-4">
                        <label for="dinners${index}" class="form-label">Cenas</label>
                        <input name="huespedes[${index}][cenas]" type="number" class="form-control"
                            id="dinners${index}">
                    </div>
                </div>
            </div>
            `;

            return newGuest;
        }

        function generateGuestSections(cantidad) {
            const seccionesHuespedesDiv = document.getElementById("hostContainer");
            const shippingCostContainer = document.getElementById("shippingCostContainer");
            seccionesHuespedesDiv.innerHTML = "";

            for (let i = 0; i < cantidad; i++) {
                const seccionHuesped = createGuestSection(i);
                seccionesHuespedesDiv.insertAdjacentHTML("beforeend", seccionHuesped);
            }

            if(cantidad <= 10) {
                shippingCostContainer.style.display = "block";
            } else {
                shippingCostContainer.style.display = "none";
            }
        }

        function onQuantityChange() {
            const quantityInput = document.getElementById("quantity");
            const quantity = parseInt(quantityInput.value);

            if (isNaN(quantity) || quantity <= 0) {
                generateGuestSections(1);
                updateUnitPrice();
            } else {
                generateGuestSections(quantity);
                updateUnitPrice();
            }
        }

        const quantityInput = document.getElementById("quantity");
        quantityInput.addEventListener("change", onQuantityChange);

        onQuantityChange();
    </script>

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

            // Logica para capturar el precio de los alimentos y asignarlo a los huespedes
            const selectElement = document.getElementById("service");
            const selectedOptions = Array.from(selectElement.selectedOptions);
            const guestsRows = document.querySelectorAll('.guest-row');

            guestsRows.forEach((row, index) => {
                const desayunosInput = row.querySelector(`#breakfasts${index}`);
                const comidasInput = row.querySelector(`#foods${index}`);
                const cenasInput = row.querySelector(`#dinners${index}`);

                let precioDesayunos = 0;
                let precioComidas = 0;
                let precioCenas = 0;

                selectedOptions.forEach(option => {
                    const foodId = option.value;
                    const price = parseFloat(option.dataset.price);

                    if(foodId === '1'){
                        precioDesayunos += price;
                    }else if (foodId === '2') {
                        precioComidas += price;
                    } else if (foodId === '3') {
                        precioCenas += price;
                    }
                });

                desayunosInput.value = precioDesayunos;
                comidasInput.value = precioComidas;
                cenasInput.value = precioCenas;
            });
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

            // Funcion para generar un nuevo huesped de manera dinamica
            // $('#addGuestRow').click(function() {
            //     let newGuest = `
            //     <div class="col-12 mt-4">
            //         <div class="row g-3"> 
            //             <div class="col-md-2">
            //                 <label for="firstNum" class="form-label">No.</label>
            //                 <input type="text" value="1" class="form-control" id="firstNum"
            //                     readonly>
            //             </div>

            //             <div class="col-md-10">
            //                 <label for="host" class="form-label">Huesped</label>
            //                 <input name="servicios[0][huesped]" type="text" class="form-control"
            //                     id="host">
            //             </div>
            //             <div class="col-md-8">
            //                 <label for="boat" class="form-label">Embarcación</label>
            //                 <select name="servicios[0][embarcacion_id]" id="boat" class="form-control">
            //                     <option selected disabled>Selecciona una opción...</option>
            //                     @foreach ($boats as $boat)
            //                         <option value="{{ $boat->id }}">{{ $boat->nombre }}</option>
            //                     @endforeach
            //                 </select>
            //             </div>
            //             <div class="col-md-2 d-grid align-items-end">
            //                 <button type="button" class="btn btn-outline-danger btn-eliminar">Remover</button>
            //             </div>
            //         </div>
            //     </div> 
            //     `;

            //     $('#hostContainer').append(newGuest);
            // });

            // Funcion para agregar una nueva fila de servicios de manera dinamica
            $('#addRowBtn').click(function() {
                let newService = `
                <div class="row mt-4">
                    <div class="col-md-7 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="row g-3">  
                                    <div class="col-md-2">
                                        <label class="form-label">No.</label>
                                        <input type="text" value="${rowCount}" class="form-control" id="num" readonly>
                                    </div>
                                    <div class="col-md-10">
                                        <label for="service" class="form-label">Servicio</label>
                                        <select name="servicios[${rowCount}][servicio][]"
                                                    class="form-control dynamic-select" id="service${rowCount}" multiple>
                                            @foreach ($foods as $food)
                                                <option value="{{ $food->id }}" id="food_${rowCount}_{{ $food->id }}"
                                                    data-price="{{ $food->precio }}">{{ $food->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-5">
                                        <label for="dateService" class="form-label">Fecha</label>
                                        <input name="servicios[${rowCount}][fecha_serv]" type="date" class="form-control"
                                            id="dateService">
                                    </div>
                                    <div class="col-md-7"></div>

                                    <div class="col-md-3">
                                        <label for="quantity" class="form-label">Cantidad</label>
                                        <input name="servicios[${rowCount}][cantidad]" type="number" min="1" value="1" class="form-control"
                                            id="quantity_${rowCount}">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="unitPrice" class="form-label">Precio Unitario</label>
                                        <input name="servicios[${rowCount}][precio_unitario]" type="text" class="form-control"
                                            id="unitPrice_${rowCount}">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="total" class="form-label">Total</label>
                                        <input name="servicios[${rowCount}][total]" type="text" class="form-control"
                                            id="total_${rowCount}">
                                    </div>

                                    <div class="col-md-3 d-grid align-items-end">
                                        <button type="button" class="btn btn-outline-danger btn-eliminar">Remover</button>
                                    </div>
                                </div>    
                            </div>
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
            // rowCount = 2;
            // rowCount = currentRowCount - rowIndex;

            // Funcion para eliminar una fila de servicios
            $(document).on('click', '.btn-eliminar', function() {
                $(this).closest('.col-12').remove();
                rowCount--;
                actualizarNumerosID();
                // initializeSelect2(rowCount - rowIndex);

                $('#serviciosContainer').find('.col-12').each(function(index) {
                    let currentRowCount = index + 1;
                    $(this).find('.dynamic-select').attr('id', `service${currentRowCount}`);
                    initializeSelect2(currentRowCount);
                });
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

{{-- <div class="col-md-4">
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
</div> --}}
