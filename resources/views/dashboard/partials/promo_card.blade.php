<div class="card promo-card shadow-sm hover-shadow mb-4">
    <div class="position-relative">
        <!-- Imagen con overlay de acciones -->
        <div class="promo-image-container" style="position: relative; height: 180px; overflow: hidden; background: #f8f9fa;">
            @php
                $imagePath = $promo->imagen ? asset('img/promociones/th'.$promo->imagen) : asset('img/no-image.png');
            @endphp
            <img src="{{$imagePath}}"
                 class="w-100 h-100 object-fit-cover"
                 alt="{{$promo->descrip}}"
                 style="object-fit: cover;">

            <!-- Badge de estado -->
            <span class="status-badge badge {{$promo->activo ? 'bg-success' : 'bg-secondary'}} position-absolute top-0 end-0 m-2">
                {{$promo->activo ? 'Activa' : 'Inactiva'}}
            </span>

            <!-- Overlay de acciones -->
            <div class="position-absolute bottom-0 start-0 end-0 p-2" style="background: linear-gradient(transparent, rgba(0,0,0,0.6));">
                <div class="d-flex justify-content-between align-items-center">
                    <span class="text-white fw-bold promo-title">{{Str::limit($promo->descrip, 40)}}</span>
                    @if($promo->monto > 0)
                        <span class="badge bg-warning text-dark">$ {{number_format($promo->monto)}}</span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="card-body p-3">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <small class="text-muted">
                <i class="bi bi-calendar3 me-1"></i>
                {{$promo->created_at->diffForHumans()}}
            </small>
            <small class="text-muted">
                <i class="bi bi-shop me-1"></i>
                {{$promo->tienda}}
            </small>
        </div>

        <!-- Acciones rápidas -->
        <div class="d-flex gap-2 flex-wrap">
            <button class="btn btn-outline-primary btn-sm flex-grow-1 open-promo-edit"
                    data-id="{{$promo->id}}">
                <i class="bi bi-pencil"></i> Editar
            </button>

            <div class="form-check form-switch mt-1">
                <input class="form-check-input promo-toggle-active"
                       type="checkbox"
                       data-id="{{$promo->id}}"
                    {{$promo->activo ? 'checked' : ''}}>
            </div>

        </div>

        <!-- Tags o características -->
        @if($promo->combo)
            <span class="badge bg-info mt-2 me-1">Combo</span>
        @endif
        @if($promo->destacada)
            <span class="badge bg-danger mt-2">★ Destacada</span>
        @endif
    </div>
</div>

<style>
    .hover-shadow:hover {
        box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;
        transform: translateY(-2px);
        transition: all 0.3s ease;
    }
    .object-fit-cover {
        object-fit: cover;
    }
    .promo-card {
        transition: all 0.3s ease;
        border: none;
    }
    .promo-image-container {
        border-radius: 8px 8px 0 0;
    }
</style>
