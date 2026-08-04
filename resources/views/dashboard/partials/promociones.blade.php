<!-- views/dashboard/partials/promociones.blade.php -->
<style>
    .promo-card {
        border-radius: 8px;
        overflow: hidden;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid #e9ecef;
        background: #fff;
        height: 100%;
    }

    .promo-card:hover {
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        transform: translateY(-2px);
    }

    .promo-image-container {
        position: relative;
        overflow: hidden;
        height: 140px;
        background: #f8f9fa;
    }

    .promo-image-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .promo-card:hover .promo-image-container img {
        transform: scale(1.05);
    }

    .status-badge {
        padding: 2px 10px;
        border-radius: 12px;
        font-size: 0.6rem;
        font-weight: 600;
        backdrop-filter: blur(4px);
        z-index: 2;
    }

    .promo-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        padding: 20px 10px 10px;
        background: linear-gradient(transparent, rgba(0,0,0,0.7));
        z-index: 1;
    }

    .promo-title {
        color: #fff;
        font-weight: 600;
        font-size: 0.8rem;
        text-shadow: 0 1px 3px rgba(0,0,0,0.3);
        margin: 0;
        line-height: 1.2;
    }

    .promo-price {
        background: rgba(255, 193, 7, 0.9);
        color: #000;
        padding: 1px 8px;
        border-radius: 12px;
        font-size: 0.7rem;
        font-weight: 700;
    }

    .promo-card-body {
        padding: 8px 10px 10px;
    }

    .promo-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 4px;
        font-size: 0.6rem;
    }

    .promo-meta .text-muted {
        font-size: 0.6rem;
    }

    .promo-meta i {
        font-size: 0.6rem;
    }

    .promo-tags {
        display: flex;
        gap: 3px;
        flex-wrap: wrap;
        margin-bottom: 4px;
    }

    .promo-tags .badge {
        font-size: 0.55rem;
        padding: 2px 6px;
    }

    .promo-tags .badge i {
        font-size: 0.5rem;
        margin-right: 2px;
    }

    .promo-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 4px;
        border-top: 1px solid #e9ecef;
    }

    .promo-actions .btn {
        font-size: 0.65rem;
        padding: 2px 8px;
    }

    .promo-actions .btn i {
        font-size: 0.7rem;
    }

    .promo-actions .form-check-input {
        width: 30px;
        height: 17px;
        cursor: pointer;
        margin-top: 0;
    }

    .promo-card-wrapper {
        animation: fadeInUp 0.3s ease forwards;
        margin-bottom: 12px;
    }

    /* Grid personalizado para cards compactos */
    .promo-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 12px;
    }

    @media (max-width: 576px) {
        .promo-grid {
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 8px;
        }
        .promo-image-container {
            height: 110px;
        }
        .promo-title {
            font-size: 0.7rem;
        }
        .promo-card-body {
            padding: 6px 8px 8px;
        }
    }

    @media (min-width: 768px) and (max-width: 992px) {
        .promo-grid {
            grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
        }
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .promo-card-wrapper.fade-out {
        animation: fadeOut 0.3s ease forwards;
    }

    @keyframes fadeOut {
        to {
            opacity: 0;
            transform: scale(0.95);
        }
    }

    .promo-empty-state {
        padding: 40px 20px;
        text-align: center;
    }

    .promo-empty-state i {
        font-size: 3rem;
        color: #dee2e6;
        display: block;
        margin-bottom: 15px;
    }

    .promo-empty-state h5 {
        color: #6c757d;
        margin-bottom: 8px;
        font-size: 1rem;
    }

    .promo-empty-state p {
        color: #adb5bd;
        margin-bottom: 15px;
        font-size: 0.9rem;
    }

    /* Filtros compactos */
    .filters-row {
        padding: 5px 0;
    }

    .filters-row .form-control,
    .filters-row .form-select {
        border-radius: 6px;
        border-color: #e9ecef;
        font-size: 0.8rem;
        padding: 0.25rem 0.5rem;
        height: 32px;
    }

    .filters-row .input-group-text {
        padding: 0.25rem 0.5rem;
        font-size: 0.8rem;
        background: #fff;
    }

    .filters-row .btn {
        font-size: 0.75rem;
        padding: 0.25rem 0.5rem;
        height: 32px;
    }

    /* Scroll personalizado */
    .promo-grid-container::-webkit-scrollbar {
        width: 4px;
    }

    .promo-grid-container::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 2px;
    }

    .promo-grid-container::-webkit-scrollbar-thumb {
        background: #c1c7cd;
        border-radius: 2px;
    }

    .promo-grid-container::-webkit-scrollbar-thumb:hover {
        background: #a8b0b8;
    }

    /* Header compacto */
    .card-header-compact {
        padding: 10px 15px;
    }

    .card-header-compact h5 {
        font-size: 1rem;
    }

    .card-header-compact .badge {
        font-size: 0.7rem;
        padding: 0.25rem 0.5rem;
    }

    .card-header-compact .btn {
        font-size: 0.75rem;
        padding: 0.2rem 0.6rem;
    }

    .card-body-compact {
        padding: 10px;
    }
</style>

<div class="card">
    <div class="card-header bg-white border-bottom card-header-compact">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-2">
            <h5 class="mb-0 fw-bold">
                <i class="bi bi-tags me-1 text-primary"></i>Promociones
                <span class="badge bg-primary ms-1" id="totalPromos">{{count($promociones)}}</span>
            </h5>
            <div class="d-flex gap-1">
                <a href="{{route('promos.create',['tienda'=>$tienda ?? 'SanCristobal'])}}" class="btn btn-success btn-sm">
                    <i class="bi bi-plus-circle me-1"></i> Crear
                </a>
                <button type="button" class="btn btn-warning btn-sm" onclick="if(confirm('¿Estás seguro de limpiar todas las promociones?')){ window.location.href='{{route('limpiar.promociones')}}' }">
                    <i class="bi bi-trash"></i>
                </button>
            </div>
        </div>

        <!-- Filtros compactos -->
        <div class="row g-1 mt-2 filters-row">
            <div class="col-md-5 col-6">
                <div class="input-group input-group-sm">
                    <span class="input-group-text bg-white border-end-0">
                        <i class="bi bi-search" style="font-size: 0.7rem;"></i>
                    </span>
                    <input type="text" class="form-control border-start-0" id="searchPromo" placeholder="Buscar...">
                </div>
            </div>
            <div class="col-md-4 col-4">
                <select class="form-select form-select-sm" id="filterStatus">
                    <option value="all">Todos</option>
                    <option value="active">Activas</option>
                    <option value="inactive">Inactivas</option>
                </select>
            </div>
            <div class="col-md-3 col-2">
                <button class="btn btn-sm btn-outline-secondary w-100" id="clearFilters" style="font-size: 0.7rem; padding: 0.25rem 0.3rem;">
                    <i class="bi bi-arrow-counterclockwise"></i>
                </button>
            </div>
        </div>
    </div>

    <div class="card-body card-body-compact promo-grid-container" style="max-height: 600px; overflow-y: auto;">
        <!-- Grid de promociones con CSS Grid -->
        <div class="promo-grid" id="promoGrid">
            @forelse($promociones as $promo)
                <div class="promo-card-wrapper"
                     data-id="{{$promo->id}}"
                     data-tienda="{{$promo->tienda}}"
                     data-status="{{$promo->activo ? 'active' : 'inactive'}}"
                     data-search="{{strtolower($promo->descrip)}}">

                    <div class="promo-card">
                        <!-- Imagen -->
                        <div class="promo-image-container">
                            @php
                                $imagePath = $promo->imagen ? asset('img/promociones/th'.$promo->imagen) : asset('img/no-image.png');
                            @endphp
                            <img src="{{$imagePath}}" alt="{{$promo->descrip}}" loading="lazy">

                            <!-- Badge de estado -->
                            <span class="status-badge badge position-absolute top-0 end-0 m-1 {{$promo->activo ? 'bg-success' : 'bg-secondary'}}">
                                {{$promo->activo ? 'Activa' : 'Inactiva'}}
                            </span>

                            <!-- Precio en overlay -->
                            @if($promo->monto > 0)
                                <div class="position-absolute bottom-0 end-0 m-1">
                                    <span class="promo-price">$ {{number_format($promo->monto, 0, ',', '.')}}</span>
                                </div>
                            @endif
                        </div>

                        <!-- Body compacto -->
                        <div class="promo-card-body">
                            <!-- Título -->
                            <p class="promo-title-text mb-1" style="font-size: 0.75rem; font-weight: 600; color: #333; line-height: 1.2; min-height: 18px;">
                                {{Str::limit($promo->descrip, 30)}}
                            </p>

                            <!-- Meta información -->
                            <div class="promo-meta">
                                <small class="text-muted">
                                    <i class="bi bi-calendar3"></i> {{$promo->created_at->diffForHumans()}}
                                </small>
                                <small class="text-muted">
                                    <i class="bi bi-shop"></i> {{$promo->tienda == 'SanCristobal' ? 'SC' : 'EV'}}
                                </small>
                            </div>

                            <!-- Tags -->
                            <div class="promo-tags">
                                @if($promo->combo)
                                    <span class="badge bg-info">
                                        <i class="bi bi-box"></i>Combo
                                    </span>
                                @endif
                                @if($promo->destacada)
                                    <span class="badge bg-danger">
                                        <i class="bi bi-star-fill"></i>Destacada
                                    </span>
                                @endif
                                @if($promo->pendiente)
                                    <span class="badge bg-warning text-dark">
                                        <i class="bi bi-clock"></i>Pendiente
                                    </span>
                                @endif
                            </div>

                            <!-- Acciones -->
                            <div class="promo-actions">
                                <div class="d-flex gap-1">
                                    <button class="btn btn-outline-primary btn-sm open-promo-edit"
                                            data-id="{{$promo->id}}"
                                            data-bs-toggle="modal"
                                            data-bs-target="#promoEditModal"
                                            title="Editar">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button class="btn btn-outline-danger btn-sm delete-promo-btn"
                                            data-id="{{$promo->id}}"
                                            title="Eliminar">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>

                                <div class="form-check form-switch m-0">
                                    <input class="form-check-input promo-toggle-active"
                                           type="checkbox"
                                           data-id="{{$promo->id}}"
                                           {{$promo->activo ? 'checked' : ''}}
                                           title="Activar/Desactivar">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="promo-empty-state">
                        <i class="bi bi-box-seam"></i>
                        <h5>No hay promociones</h5>
                        <p>Comienza creando tu primera promoción</p>
                        <a href="{{route('promos.create',['tienda'=>$tienda ?? 'SanCristobal'])}}" class="btn btn-primary btn-sm">
                            <i class="bi bi-plus-circle me-1"></i> Crear promoción
                        </a>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</div>

<!-- Modal para editar promociones -->
<div class="modal fade" id="promoEditModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light py-2">
                <h5 class="modal-title" style="font-size: 1rem;">
                    <i class="bi bi-pencil-square me-2 text-primary"></i>Editar Promoción
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0" id="promoEditContent">
                <div class="text-center p-5">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Cargando...</span>
                    </div>
                    <p class="mt-3 text-muted">Cargando promoción...</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Variables para filtros
        let searchTerm = '';
        let filterTienda = 'all';
        let filterStatus = 'all';

        // Función para aplicar todos los filtros
        function applyFilters() {
            $('.promo-card-wrapper').each(function() {
                let $card = $(this);
                let show = true;

                // Filtro de búsqueda
                if (searchTerm) {
                    let text = $card.data('search') || '';
                    if (!text.includes(searchTerm)) {
                        show = false;
                    }
                }

                // Filtro de estado
                if (show && filterStatus !== 'all') {
                    if ($card.data('status') !== filterStatus) {
                        show = false;
                    }
                }

                $card.toggle(show);
            });

            // Actualizar contador visible
            let visible = $('.promo-card-wrapper:visible').length;
            $('#totalPromos').text(visible);
        }

        // Búsqueda en tiempo real
        $('#searchPromo').on('keyup', function() {
            searchTerm = $(this).val().toLowerCase().trim();
            applyFilters();
        });

        // Filtro por estado
        $('#filterStatus').on('change', function() {
            filterStatus = $(this).val();
            applyFilters();
        });

        // Limpiar filtros
        $('#clearFilters').on('click', function() {
            $('#searchPromo').val('');
            $('#filterStatus').val('all');
            searchTerm = '';
            filterStatus = 'all';
            applyFilters();
        });

        // Abrir modal de edición
        $(document).on('click', '.open-promo-edit', function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            let modal = $('#promoEditModal');
            let content = $('#promoEditContent');

            content.html(`
                <div class="text-center p-5">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Cargando...</span>
                    </div>
                    <p class="mt-3 text-muted">Cargando promoción...</p>
                </div>
            `);

            modal.modal('show');

            $.ajax({
                url: '/promo/open/' + id,
                type: 'GET',
                success: function(data) {
                    content.html(data);
                    if (typeof initModalEvents === 'function') {
                        initModalEvents();
                    }
                },
                error: function(xhr) {
                    content.html(`
                        <div class="alert alert-danger m-3">
                            <i class="bi bi-exclamation-triangle me-2"></i>
                            Error al cargar la promoción.
                        </div>
                    `);
                }
            });
        });

        // Toggle activo/inactivo
        $(document).on('change', '.promo-toggle-active', function() {
            let $toggle = $(this);
            let id = $toggle.data('id');
            let checked = $toggle.is(':checked') ? 1 : 0;
            let $card = $('.promo-card-wrapper[data-id="'+id+'"]');

            $toggle.prop('disabled', true);

            $.ajax({
                url: '{{route("promo.update")}}',
                type: 'POST',
                data: {
                    id: id,
                    n: 'activo',
                    v: checked,
                    _token: '{{csrf_token()}}'
                },
                success: function() {
                    $card.data('status', checked ? 'active' : 'inactive');
                    let badge = $card.find('.status-badge');
                    if(checked) {
                        badge.removeClass('bg-secondary').addClass('bg-success').text('Activa');
                    } else {
                        badge.removeClass('bg-success').addClass('bg-secondary').text('Inactiva');
                    }
                    applyFilters();
                },
                error: function() {
                    alert('Error al actualizar el estado');
                    $toggle.prop('checked', !$toggle.is(':checked'));
                },
                complete: function() {
                    $toggle.prop('disabled', false);
                }
            });
        });

        // Eliminar promoción
        $(document).on('click', '.delete-promo-btn', function() {
            let id = $(this).data('id');

            if(confirm('¿Estás seguro de eliminar esta promoción?')) {
                let $card = $('.promo-card-wrapper[data-id="'+id+'"]');

                $.ajax({
                    url: '{{route("promo.delete")}}',
                    type: 'POST',
                    data: {
                        id: id,
                        _token: '{{csrf_token()}}'
                    },
                    success: function() {
                        $card.addClass('fade-out');
                        setTimeout(function() {
                            $card.remove();
                            let total = $('.promo-card-wrapper:visible').length;
                            $('#totalPromos').text(total);

                            if ($('.promo-card-wrapper').length === 0) {
                                location.reload();
                            }
                        }, 300);
                    },
                    error: function() {
                        alert('Error al eliminar la promoción');
                    }
                });
            }
        });

        // Inicializar filtros
        applyFilters();
    });

    // Función para inicializar eventos del modal
    function initModalEvents() {
        // Auto-guardar al cambiar inputs
        $('.promo-input').on('change', function() {
            let id = $(this).data('id');
            let field = $(this).data('field');
            let value = $(this).val();

            $.ajax({
                url: '{{route("promo.update")}}',
                type: 'POST',
                data: {
                    id: id,
                    n: field,
                    v: value,
                    _token: '{{csrf_token()}}'
                },
                success: function(response) {
                    if(response.success) {
                        if(field === 'descrip') {
                            $('.promo-card-wrapper[data-id="'+id+'"] .promo-title-text').text(value.substring(0, 30) + (value.length > 30 ? '...' : ''));
                        }
                        if(field === 'monto') {
                            let $card = $('.promo-card-wrapper[data-id="'+id+'"]');
                            if(value > 0) {
                                $card.find('.promo-price').text('$ ' + parseFloat(value).toLocaleString());
                            } else {
                                $card.find('.promo-price').hide();
                            }
                        }
                    }
                }
            });
        });

        // Switches
        $('.promo-switch').on('change', function() {
            let id = $(this).data('id');
            let field = $(this).data('field');
            let value = $(this).is(':checked') ? 1 : 0;

            $.ajax({
                url: '{{route("promo.update")}}',
                type: 'POST',
                data: {
                    id: id,
                    n: field,
                    v: value,
                    _token: '{{csrf_token()}}'
                },
                success: function(response) {
                    if(response.success) {
                        if(field === 'activo') {
                            let badge = $('.promo-card-wrapper[data-id="'+id+'"] .status-badge');
                            if(value) {
                                badge.removeClass('bg-secondary').addClass('bg-success').text('Activa');
                            } else {
                                badge.removeClass('bg-success').addClass('bg-secondary').text('Inactiva');
                            }
                        }
                        if(field === 'combo') {
                            let $card = $('.promo-card-wrapper[data-id="'+id+'"]');
                            let $tags = $card.find('.promo-tags');
                            if(value) {
                                if(!$tags.find('.badge.bg-info').length) {
                                    $tags.append('<span class="badge bg-info"><i class="bi bi-box"></i>Combo</span>');
                                }
                            } else {
                                $tags.find('.badge.bg-info').remove();
                            }
                        }
                        if(field === 'destacada') {
                            let $card = $('.promo-card-wrapper[data-id="'+id+'"]');
                            let $tags = $card.find('.promo-tags');
                            if(value) {
                                if(!$tags.find('.badge.bg-danger').length) {
                                    $tags.append('<span class="badge bg-danger"><i class="bi bi-star-fill"></i>Destacada</span>');
                                }
                            } else {
                                $tags.find('.badge.bg-danger').remove();
                            }
                        }
                    }
                }
            });
        });

        // Upload de imágenes
        $('.promo-image-upload').on('change', function() {
            let file = this.files[0];
            if(!file) return;

            let url = $(this).data('url');
            let id = $(this).data('id');
            let formData = new FormData();
            formData.append('file', file);
            formData.append('_token', '{{csrf_token()}}');

            let $area = $(this).closest('.border');

            // Mostrar preview local
            let reader = new FileReader();
            reader.onload = function(e) {
                let img = $area.find('img');
                if(img.length) {
                    img.attr('src', e.target.result);
                } else {
                    $area.prepend(`
                        <img src="${e.target.result}" class="img-fluid mb-2" style="max-height: 100px; border-radius: 5px;">
                    `);
                    $area.find('.py-3').hide();
                }
            };
            reader.readAsDataURL(file);

            $area.css('opacity', '0.6');

            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if(response.success || response.view) {
                        $.get('/promo/open/' + id, function(data) {
                            $('#promoEditContent').html(data);
                        });
                    }
                },
                error: function(xhr) {
                    alert('Error al subir la imagen');
                    $area.css('opacity', '1');
                },
                complete: function() {
                    $area.css('opacity', '1');
                }
            });
        });

        // Eliminar promoción desde modal
        $(document).on('click', '.delete-promo-modal-btn', function() {
            let id = $(this).data('id');
            if(confirm('¿Estás seguro de eliminar esta promoción?')) {
                $.ajax({
                    url: '{{route("promo.delete")}}',
                    type: 'POST',
                    data: {
                        id: id,
                        _token: '{{csrf_token()}}'
                    },
                    success: function() {
                        $('#promoEditModal').modal('hide');
                        let $card = $('.promo-card-wrapper[data-id="'+id+'"]');
                        $card.addClass('fade-out');
                        setTimeout(function() {
                            $card.remove();
                            let total = $('.promo-card-wrapper:visible').length;
                            $('#totalPromos').text(total);
                            if($('.promo-card-wrapper').length === 0) {
                                location.reload();
                            }
                        }, 300);
                    },
                    error: function() {
                        alert('Error al eliminar la promoción');
                    }
                });
            }
        });
    }

    // Función global para abrir el modal
    window.openPromoEdit = function(id) {
        $('.open-promo-edit[data-id="'+id+'"]').click();
    };
</script>
