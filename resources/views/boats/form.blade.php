<section class="px-5 py-4">
    <h3 class="mt-3 mb-5">{{ $title }} Embarcación</h3>

    <div class="card">
        <div class="card-body">
            <form class="row g-3" method="POST" action="{{ $action }}">
                @csrf
                @method($method)
                <div class="col-12">
                    <label for="nameFood" class="form-label">Nombre</label>
                    <input name="nombre" value="{{ $nameValue }}" type="text"
                        class="form-control @error('nombre') is-invalid @enderror" id="nameFood">

                    @error('nombre')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="col-12 mt-5">
                    <div class="d-flex flex-wrap gap-2">
                        <button class="btn btn-primary" type="submit"><i class="las la-{{ $icon }} la-lg"></i>
                            {{ $titleBtn }} Embarcación</button>
                        <div class="vr"></div>
                        <a href="{{ route('boats.index') }}" class="btn btn-outline-secondary"><i
                                class="las la-times"></i> Cancelar</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
