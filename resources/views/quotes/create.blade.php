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

            {{-- Secciones dinamicas --}}
            <div class="col-12" id="servicios-sections"></div>

            <div class="col-12 d-grid mb-5">
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

            function agregarHuespedesSection(servicioIndex, cantidad) {
                let huespedesSection = '';

                for (let i = 0; i < cantidad; i++) {
                    huespedesSection += `
                        <tr class="huesped">
                            <td>
                                <input name="servicios[${servicioIndex}][huespedes][${i}][servicio_id]" type="text" value="${servicioIndex}" class="form-control"
                                    readonly>
                            </td>
                            <td>
                                <input name="servicios[${servicioIndex}][huespedes][${i}][nombre_h]" type="text" class="form-control">
                            </td>
                            <td>
                                <input name="servicios[${servicioIndex}][huespedes][${i}][embarcacion_id]" type="text" class="form-control">
                            </td>
                            <td>
                                <input name="servicios[${servicioIndex}][huespedes][${i}][desayunos]" type="text" class="form-control">
                            </td>
                            <td>
                                <input name="servicios[${servicioIndex}][huespedes][${i}][comidas]" type="text" class="form-control">
                            </td>
                            <td>
                                <input name="servicios[${servicioIndex}][huespedes][${i}][cenas]" type="text" class="form-control">
                            </td>
                        </tr>
                    `;
                }
                return huespedesSection;
            }

            // Agregar servicio
            $("#add-servicio-btn").click(function() {
                let servicioSection = `
                <div class="card mb-6 servicio-section">
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-1">
                                <label class="form-label">No.</label>
                                <input name="servicios[${servicioIndex}][servicio_id]" type="text" value="${servicioIndex}" class="form-control" readonly>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Fecha</label>
                                <input name="servicios[${servicioIndex}][fecha_serv]" type="date" class="form-control">
                            </div>
                            <div class="col-md-5">
                                <label for="service" class="form-label">Alimentos</label>
                                <input name="servicios[${servicioIndex}][alimentos_ids]" type="text" class="form-control">
                            </div>
                            <div class="col-md-3"></div>
                            <div class="col-md-2">
                                <label class="form-label">Cantidad</label>
                                <input name="servicios[${servicioIndex}][cantidad]" type="number" value="1" min="1"
                                    class="form-control">
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Precio Unitario</label>
                                <input name="servicios[${servicioIndex}][precio_unitario]" type="text" class="form-control">
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Total</label>
                                <input name="servicios[${servicioIndex}][total]" type="text" class="form-control">
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Costo de Envío</label>
                                <input name="servicios[${servicioIndex}][costo_envio]" type="text" class="form-control">
                            </div>
                            <div class="col-md-4 d-flex align-items-end">
                                <button type="button" class="btn btn-outline-danger remove-servicio-btn">Remover Servicio</button>
                            </div>
                        </div>

                        <table class="table text-center mt-5 caption-top">
                            <caption>Lista de huespedes</caption>
                            <thead>
                                <tr>
                                    <th style="width: 100px">ID</th>
                                    <th>Huesped</th>
                                    <th style="width: 120px">Embarcacion</th>
                                    <th style="width: 100px">Desayunos</th>
                                    <th style="width: 100px">Comidas</th>
                                    <th style="width: 120px">Cenas</th>
                                </tr>
                            </thead>
                            <tbody class="huespedes-section">
                            </tbody>
                        </table>
                    </div>
                </div>
                `;

                $("#servicios-sections").append(servicioSection);

                let cantidadInput = $(`input[name="servicios[${servicioIndex}][cantidad]"]`);
                let cantidad = parseInt(cantidadInput.val());
                let huespedesSection = agregarHuespedesSection(servicioIndex, cantidad);
                cantidadInput.closest('.servicio-section').find('.huespedes-section').html(
                    huespedesSection);
                servicioIndex++;
            });

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
                        <tr class="huesped">
                            <td>
                                <input name="servicios[${servicioIndex}][huespedes][${i}][servicio_id]" type="text" value="${servicioIndex}" class="form-control"
                                    readonly>
                            </td>
                            <td>
                                <input name="servicios[${servicioIndex}][huespedes][${i}][nombre_h]" type="text" class="form-control">
                            </td>
                            <td>
                                <input name="servicios[${servicioIndex}][huespedes][${i}][embarcacion_id]" type="text" class="form-control">
                            </td>
                            <td>
                                <input name="servicios[${servicioIndex}][huespedes][${i}][desayunos]" type="text" class="form-control">
                            </td>
                            <td>
                                <input name="servicios[${servicioIndex}][huespedes][${i}][comidas]" type="text" class="form-control">
                            </td>
                            <td>
                                <input name="servicios[${servicioIndex}][huespedes][${i}][cenas]" type="text" class="form-control">
                            </td>
                        </tr>
                            `;
                        huespedesSection.append(huesped);
                    }
                })
        });
    </script>
@endsection
