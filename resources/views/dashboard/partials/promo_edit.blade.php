<div class="card">
    <div class="card-body">
        <div class="row">
            <!-- Nombre -->
            <div class="col-12 mb-3">
                <label class="form-label fw-bold">Nombre de la promoción <span class="text-danger">*</span></label>
                <input type="text"
                       class="form-control promo-input"
                       name="descrip"
                       value="{{$promo->descrip}}"
                       data-url="{{route('promo.update')}}"
                       data-id="{{$promo->id}}"
                       data-field="descrip"
                       placeholder="Ej: 2x1 en Hamburguesas">
            </div>

            <!-- Precio -->
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Precio</label>
                <div class="input-group">
                    <span class="input-group-text">$</span>
                    <input type="number"
                           class="form-control promo-input"
                           name="monto"
                           value="{{$promo->monto}}"
                           data-url="{{route('promo.update')}}"
                           data-id="{{$promo->id}}"
                           data-field="monto"
                           step="0.01"
                           placeholder="0.00">
                </div>
            </div>

            <!-- Tienda -->
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Tienda</label>
                <select class="form-select promo-input"
                        name="tienda"
                        data-url="{{route('promo.update')}}"
                        data-id="{{$promo->id}}"
                        data-field="tienda">
                    <option value="SanCristobal" {{$promo->tienda == 'SanCristobal' ? 'selected' : ''}}>San Cristóbal</option>
                    <option value="ElVigia" {{$promo->tienda == 'ElVigia' ? 'selected' : ''}}>El Vigía</option>
                </select>
            </div>

            <!-- Opciones -->
            <div class="col-md-6 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title fw-bold mb-3"><i class="bi bi-gear"></i> Opciones</h6>
                        <div class="form-check form-switch mb-2">
                            <input class="form-check-input promo-switch"
                                   type="checkbox"
                                   id="comboSwitch{{$promo->id}}"
                                   data-url="{{route('promo.update')}}"
                                   data-id="{{$promo->id}}"
                                   data-field="combo"
                                {{$promo->combo ? 'checked' : ''}}>
                            <label class="form-check-label" for="comboSwitch{{$promo->id}}">
                                <i class="bi bi-box"></i> Es un combo
                            </label>
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input promo-switch"
                                   type="checkbox"
                                   id="destacadaSwitch{{$promo->id}}"
                                   data-url="{{route('promo.update')}}"
                                   data-id="{{$promo->id}}"
                                   data-field="destacada"
                                {{$promo->destacada ? 'checked' : ''}}>
                            <label class="form-check-label" for="destacadaSwitch{{$promo->id}}">
                                <i class="bi bi-star-fill text-warning"></i> Destacar en inicio
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Estado -->
            <div class="col-md-6 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title fw-bold mb-3"><i class="bi bi-toggle-on"></i> Estado</h6>
                        <div class="form-check form-switch">
                            <input class="form-check-input promo-switch"
                                   type="checkbox"
                                   id="activoSwitch{{$promo->id}}"
                                   data-url="{{route('promo.update')}}"
                                   data-id="{{$promo->id}}"
                                   data-field="activo"
                                {{$promo->activo ? 'checked' : ''}}>
                            <label class="form-check-label" for="activoSwitch{{$promo->id}}">
                                {{$promo->activo ? 'Activa' : 'Inactiva'}}
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Imágenes -->
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title fw-bold mb-3"><i class="bi bi-images"></i> Imágenes</h6>

                        <div class="row">
                            <!-- Imagen principal -->
                            <div class="col-md-6">
                                <label class="form-label">Imagen principal</label>
                                <div class="border rounded p-3 text-center" style="min-height: 150px; background: #f8f9fa;">
                                    @if($promo->imagen)
                                        <div class="position-relative d-inline-block">
                                            <img src="{{asset('img/promociones/th'.$promo->imagen)}}"
                                                 class="img-fluid mb-2"
                                                 style="max-height: 120px; border-radius: 5px;">
                                            <button class="btn btn-danger btn-sm position-absolute top-0 end-0 delete-image-btn"
                                                    data-id="{{$promo->id}}"
                                                    data-url="{{route('promo.destroyimagen', $promo->id)}}"
                                                    data-type="principal"
                                                    style="transform: translate(50%, -50%);">
                                                <i class="bi bi-x-lg"></i>
                                            </button>
                                        </div>
                                        <br>
                                    @else
                                        <div class="py-3">
                                            <i class="bi bi-image" style="font-size: 2rem; color: #ccc;"></i>
                                            <p class="text-muted small mb-0">Sin imagen</p>
                                        </div>
                                    @endif
                                    <div class="mt-2">
                                        <label class="btn btn-outline-primary btn-sm w-100">
                                            <i class="bi bi-upload me-1"></i> Subir imagen
                                            <input type="file"
                                                   class="d-none promo-image-upload"
                                                   data-id="{{$promo->id}}"
                                                   data-url="{{route('upload.imagen', $promo->id)}}"
                                                   data-type="principal"
                                                   accept="image/*">
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!-- Imagen home -->
                            <div class="col-md-6">
                                <label class="form-label">Imagen para inicio</label>
                                <div class="border rounded p-3 text-center" style="min-height: 150px; background: #f8f9fa;">
                                    @if($promo->imagen_home)
                                        <div class="position-relative d-inline-block">
                                            <img src="{{asset('img/promociones/'.$promo->imagen_home)}}"
                                                 class="img-fluid mb-2"
                                                 style="max-height: 120px; border-radius: 5px;">
                                            <button class="btn btn-danger btn-sm position-absolute top-0 end-0 delete-image-btn"
                                                    data-id="{{$promo->id}}"
                                                    data-url="{{route('promo.destroyimagenhome', $promo->id)}}"
                                                    data-type="home"
                                                    style="transform: translate(50%, -50%);">
                                                <i class="bi bi-x-lg"></i>
                                            </button>
                                        </div>
                                        <br>
                                    @else
                                        <div class="py-3">
                                            <i class="bi bi-house" style="font-size: 2rem; color: #ccc;"></i>
                                            <p class="text-muted small mb-0">Sin imagen</p>
                                        </div>
                                    @endif
                                    <div class="mt-2">
                                        <label class="btn btn-outline-primary btn-sm w-100">
                                            <i class="bi bi-upload me-1"></i> Subir imagen
                                            <input type="file"
                                                   class="d-none promo-image-upload"
                                                   data-id="{{$promo->id}}"
                                                   data-url="{{route('upload.imagenhome', $promo->id)}}"
                                                   data-type="home"
                                                   accept="image/*">
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Botones -->
            <div class="col-12 mt-3">
                <div class="d-flex gap-2 justify-content-end">
                    <button class="btn btn-danger delete-promo-modal-btn" data-id="{{$promo->id}}">
                        <i class="bi bi-trash"></i> Eliminar promoción
                    </button>
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
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
    });
</script>
