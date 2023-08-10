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

            <div class="col-12" id="servicios-sections">
                <div class="row servicio-section">
                    {{-- <div class="col-md-9 mb-4">
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
                                                <select name="alimentos_ids[]" id="service"
                                                    class="form-control select_a" multiple onchange="updateUnitPrice()">
                                                    @foreach ($foods as $food)
                                                        <option value="{{ $food->id }}" id="food_{{ $food->id }}"
                                                            data-price="{{ $food->precio }}">{{ $food->nombre }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="dateService" class="form-label">Fecha</label>
                                                <input name="fecha_serv[]" type="date" class="form-control"
                                                    id="dateService">
                                            </div>

                                            <div class="col-md-2">
                                                <label for="quantity" class="form-label">Cantidad</label>
                                                <input name="cantidad[]" type="number" value="1" min="1"
                                                    class="form-control" id="quantity" onchange="updateTotal()">
                                            </div>
                                            <div class="col-md-3">
                                                <label for="unitPrice" class="form-label">Precio Unitario</label>
                                                <input name="precio_unitario[]" type="text" placeholder="0.00"
                                                    class="form-control" id="unitPrice" readonly
                                                    onchange="updateTotal()">
                                            </div>
                                            <div class="col-md-2">
                                                <label for="total" class="form-label">Total</label>
                                                <input name="total[]" type="text" class="form-control"
                                                    id="total">
                                            </div>
                                            <div class="col-md-3" id="shippingCostContainer" style="display: none">
                                                <label for="shippingCost" class="form-label">Costo de Envío</label>
                                                <input name="costo_envio[]" type="text" class="form-control"
                                                    id="shippingCost">
                                            </div>
                                        </div>
                                    </div>
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
                                <!-- Contenedor del listado de huespedes por servicio -->
                                <div class="row g-3 huespedes-section">

                                    <!-- A partir de este espacio se iran agregando mas col-12 de forma dinamica dependiendo del numero de huespedes que requiera el servicio -->
                                </div>
                            </div>
                        </div>
                    </div> --}}
                </div>

                {{-- A partir de este espacio se crearan las demas secciones de servicios de manera dinamica --}}
            </div>

            <div class="col-12 d-grid mb-4">
                <button class="btn btn-success" type="button" id="add-servicio-btn">Agregar Servicio</button>
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
    <script>
        $(document).ready(function() {
            let servicioIndex = 0;

            // Agregar servicio
            $("#add-servicio-btn").click(function() {
                let servicioSection = `
                <div class="servicio-section">
                    <!-- Campos del servicio (alimentos_ids, fecha_serv, cantidad, precio_unitario, total, costo_envio) -->
                    <input type="text" name="servicios[${servicioIndex}][servicio_id]" value="${servicioIndex}" placeholder="ID del servicio">
                    <input type="text" name="servicios[${servicioIndex}][alimentos_ids]" placeholder="Alimentos">
                    <input type="date" name="servicios[${servicioIndex}][fecha_serv]" placeholder="Fecha">
                    <input type="number" name="servicios[${servicioIndex}][cantidad]" placeholder="Cantidad" min="1" value="1">
                    <input type="number" name="servicios[${servicioIndex}][precio_unitario]" placeholder="Precio unitario">
                    <input type="number" name="servicios[${servicioIndex}][total]" placeholder="Total">
                    <input type="number" name="servicios[${servicioIndex}][costo_envio]" placeholder="Costo de envío">

                    <!-- Secciones dinámicas de huéspedes (generadas automáticamente por JavaScript) -->
                    <div class="huespedes-section"></div>

                    <!-- Botón para eliminar servicio -->
                    <button type="button" class="remove-servicio-btn">Eliminar servicio</button>
                </div>
                `;

                $("#servicios-sections").append(servicioSection);
                servicioIndex++;
            });

            // Eliminar servicio
            $("#servicios-sections").on("click", ".remove-servicio-btn", function() {
                $(this).parent(".servicio-section").remove();
            });

            // Generar automaticamente secciones de huespedes al cambiar el valor de cantidad
            $("#servicios-sections").on("change", ".servicio-section input[name^='servicios'][name$='[cantidad]']",
                function() {
                    let cantidad = parseInt($(this).val());
                    let servicioIndex = $(this).siblings("[name^='servicios'][name$='[servicio_id]']").val();
                    let huespedesSection = $(this).siblings(".huespedes-section");
                    huespedesSection.empty();

                    for (let i = 0; i < cantidad; i++) {
                        let huesped = `
                        <div class="huesped">
                            <!-- Campos del huésped (nombre, embarcacion_id, desayunos, comidas, cenas) -->
                            <input type="text" name="servicios[${servicioIndex}][huespedes][${i}][servicio_id]" value="${servicioIndex}" placeholder="ID del servicio">
                            <input type="text" name="servicios[${servicioIndex}][huespedes][${i}][nombre_h]" placeholder="Nombre del huésped">
                            <input type="number" name="servicios[${servicioIndex}][huespedes][${i}][embarcacion_id]" placeholder="ID de embarcación">
                            <input type="number" name="servicios[${servicioIndex}][huespedes][${i}][desayunos]" placeholder="Desayunos">
                            <input type="number" name="servicios[${servicioIndex}][huespedes][${i}][comidas]" placeholder="Comidas">
                            <input type="number" name="servicios[${servicioIndex}][huespedes][${i}][cenas]" placeholder="Cenas">
                            </div>
                            `;
                        huespedesSection.append(huesped);
                    }
                })
        });
    </script>
@endsection
