<style>
    .dropdown-toggle::before {
        display: none !important;
    }
</style>

<div class="btn-group dropstart">
    <button class="btn rounded-circle btn-icon btn-sm dropdown-toggle" type="button" id="dropdownMenu"
        data-bs-toggle="dropdown" aria-expanded="false" style="box-shadow: none;">
        <i data-feather="more-vertical" class="icon-xs"></i>
    </button>
    <ul class="dropdown-menu" aria-labelledby="dropdownMenu">
        @if (isset($showAction))
            <li>
                <a href="{{ $showAction }}" class="dropdown-item">
                    <i data-feather="eye" class="nav-icon icon-xs me-1">
                    </i>
                    Ver
                </a>
            </li>
        @endif
        @if (isset($editAction))
            <li>
                <a href="{{ $editAction }}" class="dropdown-item">
                    <i data-feather="edit" class="nav-icon icon-xs me-1">
                    </i>
                    Editar
                </a>
            </li>
        @endif
        @if (isset($deleteAction))
            <li>
                <form action="{{ $deleteAction }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="dropdown-item" type="submit">
                        <i data-feather="trash" class="nav-icon icon-xs me-1">
                        </i>
                        Eliminar
                    </button>
                </form>
            </li>
        @endif
    </ul>
</div>
