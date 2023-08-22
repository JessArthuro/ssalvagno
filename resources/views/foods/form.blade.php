<section class="px-5 py-4">
    <h3 class="mt-3 mb-5">{{ $title }} Alimento</h3>

    <div class="card">
        <div class="card-body">
            <form class="row g-3" method="POST" action="{{ $action }}">
                @csrf
                @method($method)
                <div class="col-md-8">
                    <label for="nameFood" class="form-label">Nombre</label>
                    <input name="nombre" value="{{ $nameValue }}" type="text"
                        class="form-control @error('nombre') is-invalid @enderror" id="nameFood">

                    @error('nombre')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="col-md-4">
                    <label for="price" class="form-label">Precio</label>
                    <input name="precio" value="{{ $priceValue }}" type="text"
                        class="form-control @error('precio') is-invalid @enderror" id="price">

                    @error('precio')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="col-12 mt-5">
                    <div class="d-flex flex-wrap gap-2">
                        <button class="btn btn-primary" type="submit"><i class="las la-{{ $icon }} la-lg"></i>
                            {{ $titleBtn }} Alimento</button>
                        <div class="vr"></div>
                        <a href="{{ route('foods.index') }}" class="btn btn-outline-secondary"><i
                                class="las la-times"></i> Cancelar</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
