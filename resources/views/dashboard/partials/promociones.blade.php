<!--views/dashboard/partials/promociones.blade.php -->
<style>
    .promo-card {
        border-radius: 12px;
        overflow: hidden;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid #e9ecef;
        background: #fff;
    }

    .promo-card:hover {

        box-shadow: 0 12px 24px rgba(0,0,0,0.12);
    }

    .promo-image-container {
        position: relative;
        overflow: hidden;
        height: 200px;
        background: #f8f9fa;
    }

    .promo-image-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .promo-card:hover .promo-image-container img {
        transform: scale(1.05);
    }

    .status-badge {
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.7rem;
        font-weight: 600;
        backdrop-filter: blur(4px);
        z-index: 2;
    }

    .promo-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        padding: 30px 15px 15px;
        background: linear-gradient(transparent, rgba(0,0,0,0.7));
        z-index: 1;
    }

    .promo-title {
        color: #fff;
        font-weight: 600;
        font-size: 0.95rem;
        text-shadow: 0 1px 3px rgba(0,0,0,0.3);
        margin: 0;
    }

    .promo-price {
        background: rgba(255, 193, 7, 0.9);
        color: #000;
        padding: 2px 10px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 700;
    }

    .promo-actions {
        display: flex;
        gap: 5px;
        align-items: center;
        flex-wrap: wrap;
    }

    .promo-actions .btn {
        font-size: 0.75rem;
        padding: 4px 10px;
    }

    .promo-actions .form-check {
        margin: 0;
        padding: 0;
    }

    .promo-actions .form-check-input {
        width: 36px;
        height: 20px;
        cursor: pointer;
    }

    .promo-tags {
        display: flex;
        gap: 5px;
        flex-wrap: wrap;
        margin-top: 8px;
    }

    .promo-tags .badge {
        font-size: 0.65rem;
        padding: 3px 8px;
    }

    .promo-card-wrapper {
        animation: fadeInUp 0.3s ease forwards;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
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
        padding: 60px 20px;
        text-align: center;
    }

    .promo-empty-state i {
        font-size: 4rem;
        color: #dee2e6;
        display: block;
        margin-bottom: 20px;
    }

    .promo-empty-state h5 {
        color: #6c757d;
        margin-bottom: 10px;
    }

    .promo-empty-state p {
        color: #adb5bd;
        margin-bottom: 20px;
    }

    /* Filtros */
    .filters-row {
        padding: 10px 0;
    }

    .filters-row .form-control,
    .filters-row .form-select {
        border-radius: 8px;
        border-color: #e9ecef;
    }

    .filters-row .form-control:focus,
    .filters-row .form-select:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.1);
    }

    /* Scroll personalizado */
    .promo-grid-container::-webkit-scrollbar {
        width: 6px;
    }

    .promo-grid-container::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 3px;
    }

    .promo-grid-container::-webkit-scrollbar-thumb {
        background: #c1c7cd;
        border-radius: 3px;
    }

    .promo-grid-container::-webkit-scrollbar-thumb:hover {
        background: #a8b0b8;
    }
</style>

<div class="card">
    <div class="card-header bg-white border-bottom">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-2">
            <h5 class="mb-0 fw-bold">
                <i class="bi bi-tags me-2 text-primary"></i>Gestión de Promociones
                <span class="badge bg-primary ms-2" id="totalPromos">{{count($promociones)}}</span>
            </h5>
            <div class="d-flex gap-2">
                <a href="{{route('promos.create',['tienda'=>$tienda ?? 'SanCristobal'])}}" class="btn btn-success btn-sm">
                    <i class="bi bi-plus-circle me-1"></i> Crear Promo
                </a>
                <button type="button" class="btn btn-warning btn-sm" onclick="if(confirm('¿Estás seguro de limpiar todas las promociones?')){ window.location.href='{{route('limpiar.promociones')}}' }">
                    <i class="bi bi-trash me-1"></i> Limpiar
                </button>
            </div>
        </div>

        <!-- Filtros y búsqueda -->
        <div class="row g-2 mt-3 filters-row">
            <div class="col-md-4">
                <div class="input-group input-group-sm">
                    <span class="input-group-text bg-white border-end-0">
                        <i class="bi bi-search"></i>
                    </span>
                    <input type="text" class="form-control border-start-0" id="searchPromo" placeholder="Buscar promoción...">
                </div>
            </div>

            <div class="col-md-3">
                <select class="form-select form-select-sm" id="filterStatus">
                    <option value="all">Todos los estados</option>
                    <option value="active">Activas</option>
                    <option value="inactive">Inactivas</option>
                </select>
            </div>
            <div class="col-md-2">
                <button class="btn btn-sm btn-outline-secondary w-100" id="clearFilters">
                    <i class="bi bi-arrow-counterclockwise"></i> Limpiar
                </button>
            </div>
        </div>
    </div>

    <div class="card-body p-3 promo-grid-container" style="max-height: 600px; overflow-y: auto;">
        <!-- Grid de promociones -->
        <div class="row g-3" id="promoGrid">
            @forelse($promociones as $promo)
                <div class="col-xl-4 col-lg-6 col-md-6 col-12 promo-card-wrapper"
                     data-id="{{$promo->id}}"
                     data-tienda="{{$promo->tienda}}"
                     data-status="{{$promo->activo ? 'active' : 'inactive'}}"
                     data-search="{{strtolower($promo->descrip)}}">

                    <div class="promo-card h-100">
                        <!-- Imagen -->
                        <div class="promo-image-container">
                            @php
                                $imagePath = $promo->imagen ? asset('img/promociones/th'.$promo->imagen) : asset('img/no-image.png');
                            @endphp
                            <img src="{{$imagePath}}" alt="{{$promo->descrip}}" loading="lazy">

                            <!-- Badge de estado -->
                            <span class="status-badge badge position-absolute top-0 end-0 m-2 {{$promo->activo ? 'bg-success' : 'bg-secondary'}}">
                                {{$promo->activo ? 'Activa' : 'Inactiva'}}
                            </span>

                            <!-- Overlay inferior -->
                            <div class="promo-overlay">
                                <div class="d-flex justify-content-between align-items-end">
                                    <p class="promo-title mb-0 promo-title-text">{{Str::limit($promo->descrip, 45)}}</p>
                                    @if($promo->monto > 0)
                                        <span class="promo-price">$ {{number_format($promo->monto, 0, ',', '.')}}</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Body -->
                        <div class="card-body p-3">
                            <!-- Información -->
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

                            <!-- Tags -->
                            <div class="promo-tags mb-2">
                                @if($promo->combo)
                                    <span class="badge bg-info">
                                        <i class="bi bi-box me-1"></i>Combo
                                    </span>
                                @endif
                                @if($promo->destacada)
                                    <span class="badge bg-danger">
                                        <i class="bi bi-star-fill me-1"></i>Destacada
                                    </span>
                                @endif
                                @if($promo->pendiente)
                                    <span class="badge bg-warning text-dark">
                                        <i class="bi bi-clock me-1"></i>Pendiente
                                    </span>
                                @endif
                            </div>

                            <!-- Acciones -->
                            <div class="promo-actions d-flex justify-content-between align-items-center pt-2 border-top">
                                <div class="d-flex gap-1">
                                    <button class="btn btn-outline-primary btn-sm open-promo-edit"
                                            data-id="{{$promo->id}}"
                                            data-bs-toggle="modal"
                                            data-bs-target="#promoEditModal">
                                        <i class="bi bi-pencil"></i>
                                    </button>

                                </div>

                                <div class="form-check form-switch m-0">
                                    <input class="form-check-input promo-toggle-active"
                                           type="checkbox"
                                           data-id="{{$promo->id}}"
                                        {{$promo->activo ? 'checked' : ''}}>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="promo-empty-state">
                        <i class="bi bi-box-seam"></i>
                        <h5>No hay promociones creadas</h5>
                        <p>Comienza creando tu primera promoción</p>
                        <a href="{{route('promos.create',['tienda'=>$tienda ?? 'SanCristobal'])}}" class="btn btn-primary">
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
            <div class="modal-header bg-light">
                <h5 class="modal-title">
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

                // Filtro de tienda
                if (show && filterTienda !== 'all') {
                    if ($card.data('tienda') !== filterTienda) {
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

        // Filtro por tienda
        $('#filterTienda').on('change', function() {
            filterTienda = $(this).val();
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
            $('#filterTienda').val('all');
            $('#filterStatus').val('all');
            searchTerm = '';
            filterTienda = 'all';
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
                    // Re-inicializar eventos del modal
                    if (typeof initModalEvents === 'function') {
                        initModalEvents();
                    }
                },
                error: function(xhr) {
                    content.html(`
                    <div class="alert alert-danger m-3">
                        <i class="bi bi-exclamation-triangle me-2"></i>
                        Error al cargar la promoción. Por favor, intenta de nuevo.
                    </div>
                `);
                    console.error('Error:', xhr);
                }
            });
        });

        // Toggle activo/inactivo
        $(document).on('change', '.promo-toggle-active', function() {
            let $toggle = $(this);
            let id = $toggle.data('id');
            let checked = $toggle.is(':checked') ? 1 : 0;
            let $card = $('.promo-card-wrapper[data-id="'+id+'"]');

            // Deshabilitar temporalmente
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
                    // Actualizar datos
                    $card.data('status', checked ? 'active' : 'inactive');

                    // Actualizar badge
                    let badge = $card.find('.status-badge');
                    if(checked) {
                        badge.removeClass('bg-secondary').addClass('bg-success').text('Activa');
                    } else {
                        badge.removeClass('bg-success').addClass('bg-secondary').text('Inactiva');
                    }

                    // Re-aplicar filtros
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

            if(confirm('¿Estás seguro de eliminar esta promoción? Esta acción no se puede deshacer.')) {
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
                            // Actualizar contador
                            let total = $('.promo-card-wrapper:visible').length;
                            $('#totalPromos').text(total);

                            // Mostrar mensaje de vacío si no hay promociones
                            if ($('.promo-card-wrapper').length === 0) {
                                $('#promoGrid').html(`
                                <div class="col-12">
                                    <div class="promo-empty-state">
                                        <i class="bi bi-box-seam"></i>
                                        <h5>No hay promociones creadas</h5>
                                        <p>Comienza creando tu primera promoción</p>
                                        <a href="{{route('promos.create',['tienda'=>$tienda ?? 'SanCristobal'])}}" class="btn btn-primary">
                                            <i class="bi bi-plus-circle me-1"></i> Crear promoción
                                        </a>
                                    </div>
                                </div>
                            `);
                            }
                        }, 300);
                    },
                    error: function() {
                        alert('Error al eliminar la promoción');
                    }
                });
            }
        });

        // Función para refrescar la lista (disponible globalmente)
        window.refreshPromos = function() {
            $.ajax({
                url: '{{route("promos.index")}}',
                type: 'GET',
                success: function(response) {
                    if(response.view) {
                        // Actualizar solo el grid
                        let $newGrid = $(response.view).find('#promoGrid');
                        $('#promoGrid').html($newGrid.html());
                        applyFilters();
                    }
                }
            });
        };

        // Inicializar filtros
        applyFilters();
    });

    // Función para inicializar eventos del modal
    function initModalEvents() {


        ////////////////////////////////////////

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
                            // Actualizar el título en la lista
                            if(field === 'descrip') {
                                $('.promo-card-wrapper[data-id="'+id+'"] .promo-title-text').text(value.substring(0, 45) + (value.length > 45 ? '...' : ''));
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
                            // Actualizar el badge de estado
                            if(field === 'activo') {
                                let badge = $('.promo-card-wrapper[data-id="'+id+'"] .status-badge');
                                if(value) {
                                    badge.removeClass('bg-secondary').addClass('bg-success').text('Activa');
                                } else {
                                    badge.removeClass('bg-success').addClass('bg-secondary').text('Inactiva');
                                }
                            }
                            // Actualizar tags
                            if(field === 'combo') {
                                let $card = $('.promo-card-wrapper[data-id="'+id+'"]');
                                let $tags = $card.find('.promo-tags');
                                if(value) {
                                    if(!$tags.find('.badge.bg-info').length) {
                                        $tags.append('<span class="badge bg-info"><i class="bi bi-box me-1"></i>Combo</span>');
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
                                        $tags.append('<span class="badge bg-danger"><i class="bi bi-star-fill me-1"></i>Destacada</span>');
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
                let $preview = $area.find('img');

                // Mostrar preview local
                let reader = new FileReader();
                reader.onload = function(e) {
                    if($preview.length) {
                        $preview.attr('src', e.target.result);
                    } else {
                        $area.prepend(`
                    <div class="position-relative d-inline-block">
                        <img src="${e.target.result}" class="img-fluid mb-2" style="max-height: 120px; border-radius: 5px;">
                        <button class="btn btn-danger btn-sm position-absolute top-0 end-0 delete-image-btn"
                                data-id="${id}"
                                data-url="${url.replace('upload', 'destroy')}"
                                style="transform: translate(50%, -50%);">
                            <i class="bi bi-x-lg"></i>
                        </button>
                    </div>
                    <br>
                `);
                        // Ocultar el mensaje "Sin imagen"
                        $area.find('.py-3').hide();
                    }
                };
                reader.readAsDataURL(file);

                // Mostrar loading
                $area.css('opacity', '0.6');

                // Subir imagen
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if(response.success || response.view) {
                            // Recargar el modal para mostrar la imagen subida
                            $.get('/promo/open/' + id, function(data) {
                                $('#promoEditContent').html(data);
                            });
                        }
                    },
                    error: function(xhr) {
                        alert('Error al subir la imagen: ' + (xhr.responseJSON?.error || 'Error desconocido'));
                        // Restaurar el área
                        $area.css('opacity', '1');
                    },
                    complete: function() {
                        $area.css('opacity', '1');
                    }
                });
            });

            // Eliminar imagen (delegación de eventos)
            $(document).on('click', '.delete-image-btn', function() {
                let url = $(this).data('url');
                let id = $(this).data('id');
                let $btn = $(this);

                if(confirm('¿Eliminar esta imagen?')) {
                    $btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm"></span>');

                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        headers: {
                            'X-CSRF-Token': '{{csrf_token()}}'
                        },
                        success: function() {
                            // Recargar el modal
                            $.get('/promo/open/' + id, function(data) {
                                $('#promoEditContent').html(data);
                            });
                        },
                        error: function() {
                            alert('Error al eliminar la imagen');
                            $btn.prop('disabled', false).html('<i class="bi bi-x-lg"></i>');
                        }
                    });
                }
            });

            // Eliminar promoción desde modal
            $(document).on('click', '.delete-promo-modal-btn', function() {
                let id = $(this).data('id');
                if(confirm('¿Estás seguro de eliminar esta promoción? Esta acción no se puede deshacer.')) {
                    $.ajax({
                        url: '{{route("promo.delete")}}',
                        type: 'POST',
                        data: {
                            id: id,
                            _token: '{{csrf_token()}}'
                        },
                        success: function() {
                            $('#promoEditModal').modal('hide');
                            // Eliminar card con animación
                            let $card = $('.promo-card-wrapper[data-id="'+id+'"]');
                            $card.addClass('fade-out');
                            setTimeout(function() {
                                $card.remove();
                                // Actualizar contador
                                let total = $('.promo-card-wrapper:visible').length;
                                $('#totalPromos').text(total);

                                // Si no hay promociones, mostrar mensaje
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

        ////////////////////////////////////////

    }

    // Función global para abrir el modal desde otros lugares
    window.openPromoEdit = function(id) {
        $('.open-promo-edit[data-id="'+id+'"]').click();
    };
</script>
