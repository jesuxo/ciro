<!-- views/dashboard/partials/promociones.blade.php -->
<style>
    .promo-card {
        border-radius: 10px;
        overflow: hidden;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid #e9ecef;
        background: #fff;
        height: 100%;
        position: relative;
    }

    .promo-card:hover {
        box-shadow: 0 8px 25px rgba(0,0,0,0.12);
        transform: translateY(-4px);
    }

    /* Contenedor de imagen más grande */
    .promo-image-container {
        position: relative;
        overflow: hidden;
        height: 200px;
        background: #f8f9fa;
        cursor: pointer;
    }

    .promo-image-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .promo-card:hover .promo-image-container img {
        transform: scale(1.08);
    }

    /* Overlay de acciones en la imagen */
    .promo-image-actions {
        position: absolute;
        top: 8px;
        right: 8px;
        display: flex;
        gap: 6px;
        z-index: 5;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .promo-card:hover .promo-image-actions {
        opacity: 1;
    }

    .promo-image-actions .btn {
        width: 28px;
        height: 28px;
        padding: 0;
        border-radius: 50%;
        font-size: 0.75rem;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(255,255,255,0.9);
        backdrop-filter: blur(4px);
        border: none;
        box-shadow: 0 2px 8px rgba(0,0,0,0.15);
        transition: all 0.2s ease;
    }

    .promo-image-actions .btn:hover {
        transform: scale(1.1);
    }

    .promo-image-actions .btn-edit {
        color: #0d6efd;
    }

    .promo-image-actions .btn-edit:hover {
        background: #0d6efd;
        color: #fff;
    }

    .promo-image-actions .btn-delete {
        color: #dc3545;
    }

    .promo-image-actions .btn-delete:hover {
        background: #dc3545;
        color: #fff;
    }

    .promo-image-actions .btn-toggle {
        color: #6c757d;
    }

    .promo-image-actions .btn-toggle.active {
        color: #198754;
    }

    .promo-image-actions .btn-toggle:hover {
        background: #198754;
        color: #fff;
    }

    /* Badge de estado en la imagen */
    .status-badge {
        position: absolute;
        top: 8px;
        left: 8px;
        padding: 3px 10px;
        border-radius: 12px;
        font-size: 0.6rem;
        font-weight: 600;
        backdrop-filter: blur(4px);
        z-index: 5;
        letter-spacing: 0.3px;
        text-transform: uppercase;
    }

    /* Overlay inferior con título y precio */
    .promo-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        padding: 30px 12px 12px;
        background: linear-gradient(transparent, rgba(0,0,0,0.75));
        z-index: 2;
    }

    .promo-title {
        color: #fff;
        font-weight: 600;
        font-size: 0.9rem;
        text-shadow: 0 1px 3px rgba(0,0,0,0.4);
        margin: 0;
        line-height: 1.2;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .promo-price-badge {
        display: inline-block;
        background: rgba(255, 193, 7, 0.95);
        color: #000;
        padding: 2px 10px;
        border-radius: 12px;
        font-size: 0.75rem;
        font-weight: 700;
        margin-top: 4px;
    }

    /* Body del card - más compacto */
    .promo-card-body {
        padding: 8px 12px 10px;
        background: #fff;
    }

    .promo-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 0.6rem;
        color: #6c757d;
        margin-bottom: 4px;
    }

    .promo-meta i {
        font-size: 0.6rem;
        margin-right: 3px;
    }

    /* Tags compactos */
    .promo-tags {
        display: flex;
        gap: 3px;
        flex-wrap: wrap;
        margin-bottom: 4px;
    }

    .promo-tags .badge {
        font-size: 0.5rem;
        padding: 2px 6px;
        font-weight: 500;
    }

    .promo-tags .badge i {
        font-size: 0.45rem;
        margin-right: 2px;
    }

    /* Grid */
    .promo-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
        gap: 16px;
    }

    /* Responsive */
    @media (max-width: 576px) {
        .promo-grid {
            grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
            gap: 10px;
        }
        .promo-image-container {
            height: 150px;
        }
        .promo-title {
            font-size: 0.75rem;
        }
        .promo-card-body {
            padding: 6px 8px 8px;
        }
        .promo-image-actions {
            opacity: 1;
        }
        .promo-image-actions .btn {
            width: 24px;
            height: 24px;
            font-size: 0.65rem;
        }
    }

    @media (min-width: 768px) and (max-width: 992px) {
        .promo-grid {
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        }
    }

    @media (min-width: 1200px) {
        .promo-grid {
            grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
        }
    }

    /* Animaciones */
    .promo-card-wrapper {
        animation: fadeInUp 0.3s ease forwards;
    }

    .promo-card-wrapper.fade-out {
        animation: fadeOut 0.3s ease forwards;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(15px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fadeOut {
        to {
            opacity: 0;
            transform: scale(0.95);
        }
    }

    /* Estado vacío */
    .promo-empty-state {
        padding: 50px 20px;
        text-align: center;
        grid-column: 1 / -1;
    }

    .promo-empty-state i {
        font-size: 3.5rem;
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

    /* Scroll */
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

    /* Header */
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
        padding: 12px;
    }

    /* Tooltip para acciones en hover */
    .promo-image-actions .btn[title]:hover::after {
        content: attr(title);
        position: absolute;
        bottom: -22px;
        left: 50%;
        transform: translateX(-50%);
        background: rgba(0,0,0,0.8);
        color: #fff;
        padding: 2px 8px;
        border-radius: 4px;
        font-size: 0.55rem;
        white-space: nowrap;
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

        <!-- Filtros -->
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
        <div class="promo-grid" id="promoGrid">
            @forelse($promociones as $promo)
                <div class="promo-card-wrapper"
                     data-id="{{$promo->id}}"
                     data-tienda="{{$promo->tienda}}"
                     data-status="{{$promo->activo ? 'active' : 'inactive'}}"
                     data-search="{{strtolower($promo->descrip)}}">

                    <div class="promo-card">
                        <!-- IMAGEN -->
                        <div class="promo-image-container">
                            @php
                                $imagePath = $promo->imagen ? asset('img/promociones/'.$promo->imagen) : asset('img/no-image.png');
                            @endphp
                            <img src="{{$imagePath}}" alt="{{$promo->descrip}}" loading="lazy">

                            <!-- Badge de estado -->
                            <span class="status-badge {{$promo->activo ? 'bg-success' : 'bg-secondary'}} text-white">
                                {{$promo->activo ? '● Activa' : '○ Inactiva'}}
                            </span>

                            <!-- ACCIONES SOBRE LA IMAGEN (aparecen al hover) -->
                            <div class="promo-image-actions">
                                <button class="btn btn-edit open-promo-edit"
                                        data-id="{{$promo->id}}"
                                        data-bs-toggle="modal"
                                        data-bs-target="#promoEditModal"
                                        title="Editar">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button class="btn btn-delete delete-promo-btn"
                                        data-id="{{$promo->id}}"
                                        title="Eliminar">
                                    <i class="bi bi-trash"></i>
                                </button>
                                <button class="btn btn-toggle promo-toggle-active {{$promo->activo ? 'active' : ''}}"
                                        data-id="{{$promo->id}}"
                                        title="{{$promo->activo ? 'Desactivar' : 'Activar'}}">
                                    <i class="bi {{$promo->activo ? 'bi-toggle-on' : 'bi-toggle-off'}}"></i>
                                </button>
                            </div>

                            <!-- Overlay con título y precio -->
                            <div class="promo-overlay">
                                <p class="promo-title">{{Str::limit($promo->descrip, 50)}}</p>
                                @if($promo->monto > 0)
                                    <span class="promo-price-badge">$ {{number_format($promo->monto, 0, ',', '.')}}</span>
                                @endif
                            </div>
                        </div>

                        <!-- BODY COMPACTO -->
                        <div class="promo-card-body">
                            <div class="promo-meta">
                                <span>
                                    <i class="bi bi-calendar3"></i> {{$promo->created_at->diffForHumans()}}
                                </span>
                                <span>
                                    <i class="bi bi-shop"></i> {{$promo->tienda == 'SanCristobal' ? 'San Cristóbal' : 'El Vigía'}}
                                </span>
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
                        </div>
                    </div>
                </div>
            @empty
                <div class="promo-empty-state">
                    <i class="bi bi-box-seam"></i>
                    <h5>No hay promociones</h5>
                    <p>Comienza creando tu primera promoción</p>
                    <a href="{{route('promos.create',['tienda'=>$tienda ?? 'SanCristobal'])}}" class="btn btn-primary btn-sm">
                        <i class="bi bi-plus-circle me-1"></i> Crear promoción
                    </a>
                </div>
            @endforelse
        </div>
    </div>
</div>

<!-- Modal para editar -->
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
        let filterStatus = 'all';

        function applyFilters() {
            $('.promo-card-wrapper').each(function() {
                let $card = $(this);
                let show = true;

                if (searchTerm) {
                    let text = $card.data('search') || '';
                    if (!text.includes(searchTerm)) {
                        show = false;
                    }
                }

                if (show && filterStatus !== 'all') {
                    if ($card.data('status') !== filterStatus) {
                        show = false;
                    }
                }

                $card.toggle(show);
            });

            let visible = $('.promo-card-wrapper:visible').length;
            $('#totalPromos').text(visible);
        }

        $('#searchPromo').on('keyup', function() {
            searchTerm = $(this).val().toLowerCase().trim();
            applyFilters();
        });

        $('#filterStatus').on('change', function() {
            filterStatus = $(this).val();
            applyFilters();
        });

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
                error: function() {
                    content.html(`
                        <div class="alert alert-danger m-3">
                            <i class="bi bi-exclamation-triangle me-2"></i>
                            Error al cargar la promoción.
                        </div>
                    `);
                }
            });
        });

        // Toggle activo/inactivo (desde el botón en la imagen)
        $(document).on('click', '.promo-toggle-active', function(e) {
            e.stopPropagation();
            let $btn = $(this);
            let id = $btn.data('id');
            let currentlyActive = $btn.hasClass('active');
            let newStatus = currentlyActive ? 0 : 1;
            let $card = $('.promo-card-wrapper[data-id="'+id+'"]');

            $btn.prop('disabled', true);

            $.ajax({
                url: '{{route("promo.update")}}',
                type: 'POST',
                data: {
                    id: id,
                    n: 'activo',
                    v: newStatus,
                    _token: '{{csrf_token()}}'
                },
                success: function() {
                    // Actualizar card
                    $card.data('status', newStatus ? 'active' : 'inactive');

                    // Actualizar badge
                    let badge = $card.find('.status-badge');
                    if(newStatus) {
                        badge.removeClass('bg-secondary').addClass('bg-success').text('● Activa');
                        $btn.removeClass('active').addClass('active');
                        $btn.find('i').removeClass('bi-toggle-off').addClass('bi-toggle-on');
                        $btn.attr('title', 'Desactivar');
                    } else {
                        badge.removeClass('bg-success').addClass('bg-secondary').text('○ Inactiva');
                        $btn.removeClass('active');
                        $btn.find('i').removeClass('bi-toggle-on').addClass('bi-toggle-off');
                        $btn.attr('title', 'Activar');
                    }

                    applyFilters();
                },
                error: function() {
                    alert('Error al actualizar el estado');
                },
                complete: function() {
                    $btn.prop('disabled', false);
                }
            });
        });

        // Eliminar promoción (desde el botón en la imagen)
        $(document).on('click', '.delete-promo-btn', function(e) {
            e.stopPropagation();
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

        applyFilters();
    });

    // Función para inicializar eventos del modal
    function initModalEvents() {
        // Auto-guardar inputs
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
                success: function() {
                    if(field === 'descrip') {
                        $('.promo-card-wrapper[data-id="'+id+'"] .promo-title').text(value.substring(0, 50) + (value.length > 50 ? '...' : ''));
                    }
                    if(field === 'monto') {
                        let $card = $('.promo-card-wrapper[data-id="'+id+'"]');
                        if(value > 0) {
                            $card.find('.promo-price-badge').text('$ ' + parseFloat(value).toLocaleString()).show();
                        } else {
                            $card.find('.promo-price-badge').hide();
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
                success: function() {
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
            let reader = new FileReader();
            reader.onload = function(e) {
                let img = $area.find('img');
                if(img.length) {
                    img.attr('src', e.target.result);
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
                success: function() {
                    $.get('/promo/open/' + id, function(data) {
                        $('#promoEditContent').html(data);
                    });
                },
                error: function() {
                    alert('Error al subir la imagen');
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
                        }, 300);
                    }
                });
            }
        });
    }
</script>
