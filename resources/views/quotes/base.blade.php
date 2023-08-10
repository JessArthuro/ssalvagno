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

                                  {{-- A partir de este espacio se iran agregando mas col-12 de forma dinamica dependiendo del numero de huespedes que requiera el servicio --}}
                              </div>
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