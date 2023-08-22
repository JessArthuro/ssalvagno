@extends('layouts.master')

@section('css')
    <style>
        .select2-container--bootstrap4 .select2-selection--multiple {
            min-height: calc(1.75em + 0.75rem + 2px) !important;
        }
    </style>
@endsection

@section('content')
    <section class="px-5 py-4">
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

                {{-- Secciones dinamicas --}}
                <div class="col-12" id="servicios-sections"></div>

                <div class="col-12 d-grid mb-5">
                    <button class="btn btn-success" type="button" id="add-servicio-btn"><i class="las la-plus"></i> Agregar
                        Servicio</button>
                </div>
            </div>

            {{-- Botones de accion --}}
            <div class="row">
                <div class="col-12 d-flex flex-wrap gap-2">
                    <button class="btn btn-primary" type="submit"><i class="las la-save la-lg"></i> Crear
                        Cotización</button>
                    <div class="vr"></div>
                    <a href="{{ route('quotes.index') }}" class="btn btn-outline-secondary"><i class="las la-times"></i>
                        Cancelar</a>
                </div>
            </div>
        </form>
    </section>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            let servicioIndex = 0;

            function agregarHuespedesSection(servicioIndex, cantidad) {
                let huespedesSection = '';

                for (let i = 0; i < cantidad; i++) {
                    huespedesSection += `
                        <tr class="huesped_${servicioIndex}">
                            <td class="d-none">
                                <input name="servicios[${servicioIndex}][huespedes][${i}][servicio_id]" type="hidden" value="${servicioIndex}" class="form-control"
                                    readonly>
                            </td>
                            <td>
                                <input name="servicios[${servicioIndex}][huespedes][${i}][nombre_h]" type="text" class="form-control">
                            </td>
                            <td>
                                <select name="servicios[${servicioIndex}][huespedes][${i}][embarcacion_id]" class="form-control">
                                    <option selected disabled>Selecciona una opción...</option>
                                    @foreach ($boats as $boat)
                                        <option value="{{ $boat->id }}">{{ $boat->nombre }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="d-none">
                                <input name="servicios[${servicioIndex}][huespedes][${i}][desayunos]" type="text" 
                                    class="form-control" id="breakfasts_${servicioIndex}_${i}">
                            </td>
                            <td class="d-none">
                                <input name="servicios[${servicioIndex}][huespedes][${i}][comidas]" type="text" 
                                    class="form-control" id="foods_${servicioIndex}_${i}">
                            </td>
                            <td class="d-none">
                                <input name="servicios[${servicioIndex}][huespedes][${i}][cenas]" type="text" 
                                    class="form-control" id="dinners_${servicioIndex}_${i}">
                            </td>
                        </tr>
                    `;
                }
                return huespedesSection;
            }

            function updateUnitPriceAndTotal(servicioIndex) {
                let quantity = parseInt($(`#quantity_${servicioIndex}`).val()) || 0;
                let unitPrice = 0;

                $(`#select_foods_${servicioIndex} option:selected`).each(function() {
                    unitPrice += parseFloat($(this).data('price')) || 0;
                })

                $(`#unitPrice_${servicioIndex}`).val(unitPrice.toFixed(2)) || 0;

                let total = quantity * unitPrice;
                $(`#total_${servicioIndex}`).val(total.toFixed(2)) || 0;

                if (quantity > 10) {
                    $(`#shippingCostContainer_${servicioIndex}`).hide();
                } else {
                    $(`#shippingCostContainer_${servicioIndex}`).show();
                }

                // Logica para capturar el precio de los alimentos y asignarlos a los huespedes
                const selectFoods = document.getElementById(`select_foods_${servicioIndex}`);
                const selectedOptions = Array.from(selectFoods.selectedOptions);
                const guestsRows = document.querySelectorAll(`.huesped_${servicioIndex}`);

                guestsRows.forEach((row, index) => {
                    const breakfastsInput = row.querySelector(`#breakfasts_${servicioIndex}_${index}`);
                    const foodsInput = row.querySelector(`#foods_${servicioIndex}_${index}`);
                    const dinnersInput = row.querySelector(`#dinners_${servicioIndex}_${index}`);

                    let breakfastsPrice = 0;
                    let foodsPrice = 0;
                    let dinnersPrice = 0;

                    selectedOptions.forEach(option => {
                        const foodId = option.value;
                        const price = parseFloat(option.dataset.price);

                        if (foodId === '1') {
                            breakfastsPrice += price;
                        } else if (foodId === '2') {
                            foodsPrice += price;
                        } else if (foodId === '3') {
                            dinnersPrice += price;
                        }
                    });

                    breakfastsInput.value = breakfastsPrice;
                    foodsInput.value = foodsPrice;
                    dinnersInput.value = dinnersPrice;
                })

            }

            // Agregar servicio
            $("#add-servicio-btn").click(function() {
                let servicioSection = `
                <div class="card mb-6 servicio-section">
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-1 d-none">
                                <label class="form-label">No.</label>
                                <input name="servicios[${servicioIndex}][servicio_id]" type="text" value="${servicioIndex}" class="form-control" readonly>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Fecha</label>
                                <input name="servicios[${servicioIndex}][fecha_serv]" type="date" class="form-control">
                            </div>
                            <div class="col-md-5">
                                <label for="service" class="form-label">Alimentos</label>
                                <select name="servicios[${servicioIndex}][alimentos_ids][]" class="form-control" id="select_foods_${servicioIndex}" multiple>
                                    @foreach ($foods as $food)
                                        <option value="{{ $food->id }}" data-price="{{ $food->precio }}">
                                            {{ $food->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3"></div>
                            <div class="col-md-2">
                                <label class="form-label">Cantidad</label>
                                <input name="servicios[${servicioIndex}][cantidad]" type="number" value="1" min="1"
                                    class="form-control" id="quantity_${servicioIndex}">
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Precio Unitario</label>
                                <input name="servicios[${servicioIndex}][precio_unitario]" type="text" 
                                    class="form-control" id="unitPrice_${servicioIndex}" readonly>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Total</label>
                                <input name="servicios[${servicioIndex}][total]" type="text" 
                                    class="form-control" id="total_${servicioIndex}">
                            </div>
                            <div class="col-md-2" id="shippingCostContainer_${servicioIndex}">
                                <label class="form-label">Costo de Envío</label>
                                <input name="servicios[${servicioIndex}][costo_envio]" type="text" class="form-control">
                            </div>
                            <div class="col-md-4 d-grid align-items-end">
                                <button type="button" class="btn btn-outline-danger remove-servicio-btn"><i class="las la-minus"></i> Remover Servicio</button>
                            </div>
                        </div>

                        <table class="table text-center mt-5 caption-top">
                            <caption>Lista de huespedes</caption>
                            <thead>
                                <tr>
                                    <th>Nombre de Huesped</th>
                                    <th style="width: 400px;">Embarcación</th>
                                    <th class="d-none" style="width: 100px;">Desayunos</th>
                                    <th class="d-none" style="width: 100px;">Comidas</th>
                                    <th class="d-none" style="width: 120px;">Cenas</th>
                                </tr>
                            </thead>
                            <tbody class="huespedes-section">
                            </tbody>
                        </table>
                    </div>
                </div>
                `;

                $("#servicios-sections").append(servicioSection);

                let currentServiceIndex = servicioIndex;

                initializeSelect2(servicioIndex);

                let cantidadInput = $(`input[name="servicios[${servicioIndex}][cantidad]"]`);
                let cantidad = parseInt(cantidadInput.val());
                let huespedesSection = agregarHuespedesSection(servicioIndex, cantidad);
                cantidadInput.closest('.servicio-section').find('.huespedes-section').html(
                    huespedesSection);

                $(`#quantity_${currentServiceIndex}`).on('change', function() {
                    updateUnitPriceAndTotal(currentServiceIndex);
                });

                $(`#unitPrice_${currentServiceIndex}`).on('change', function() {
                    updateUnitPriceAndTotal(currentServiceIndex);
                });

                updateUnitPriceAndTotal(currentServiceIndex);

                servicioIndex++;
            });

            function initializeSelect2(id) {
                $(`#select_foods_${id}`).select2({
                    theme: "bootstrap4",
                    placeholder: "",
                    allowClear: true,
                }).on('change', function() {
                    updateUnitPriceAndTotal(id);
                });
            }

            // Eliminar servicio
            $("#servicios-sections").on("click", ".remove-servicio-btn", function() {
                $(this).closest(".servicio-section").remove();
            });

            // Generar mas secciones de huespedes al cambiar el valor de cantidad
            $("#servicios-sections").on("change", ".servicio-section input[name^='servicios'][name$='[cantidad]']",
                function() {
                    let cantidad = parseInt($(this).val());
                    let servicioIndex = $(this).closest('.servicio-section').find(
                        "[name^='servicios'][name$='[servicio_id]']").val();
                    let huespedesSection = $(this).closest('.servicio-section').find('.huespedes-section');
                    huespedesSection.empty();

                    for (let i = 0; i < cantidad; i++) {
                        let huesped = `
                        <tr class="huesped_${servicioIndex}">
                            <td class="d-none">
                                <input name="servicios[${servicioIndex}][huespedes][${i}][servicio_id]" type="hidden" value="${servicioIndex}" class="form-control"
                                    readonly>
                            </td>
                            <td>
                                <input name="servicios[${servicioIndex}][huespedes][${i}][nombre_h]" type="text" class="form-control">
                            </td>
                            <td>
                                <select name="servicios[${servicioIndex}][huespedes][${i}][embarcacion_id]" class="form-control">
                                    <option selected disabled>Selecciona una opción...</option>
                                    @foreach ($boats as $boat)
                                        <option value="{{ $boat->id }}">{{ $boat->nombre }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="d-none">
                                <input name="servicios[${servicioIndex}][huespedes][${i}][desayunos]" type="text" 
                                    class="form-control" id="breakfasts_${servicioIndex}_${i}">
                            </td>
                            <td class="d-none">
                                <input name="servicios[${servicioIndex}][huespedes][${i}][comidas]" type="text" 
                                    class="form-control" id="foods_${servicioIndex}_${i}">
                            </td>
                            <td class="d-none">
                                <input name="servicios[${servicioIndex}][huespedes][${i}][cenas]" type="text" 
                                    class="form-control" id="dinners_${servicioIndex}_${i}">
                            </td>
                        </tr>
                            `;
                        huespedesSection.append(huesped);
                        updateUnitPriceAndTotal(servicioIndex);
                    }
                })
        });
    </script>
@endsection
