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
                                <div class="border rounded p-3 text-center" style="min-height: 150px;">
                                    @if($promo->imagen)
                                        <img src="{{asset('img/promociones/th'.$promo->imagen)}}"
                                             class="img-fluid mb-2"
                                             style="max-height: 120px;">
                                        <br>
                                        <button class="btn btn-danger btn-sm delete-image-btn"
                                                data-id="{{$promo->id}}"
                                                data-url="{{route('promo.destroyimagen', $promo->id)}}"
                                                data-type="principal">
                                            <i class="bi bi-trash"></i> Eliminar
                                        </button>
                                    @else
                                        <p class="text-muted">Sin imagen</p>
                                    @endif
                                    <div class="mt-2">
                                        <input type="file"
                                               class="form-control promo-image-upload"
                                               data-id="{{$promo->id}}"
                                               data-url="{{route('upload.imagen', $promo->id)}}"
                                               data-type="principal"
                                               accept="image/*">
                                    </div>
                                </div>
                            </div>

                            <!-- Imagen home -->
                            <div class="col-md-6">
                                <label class="form-label">Imagen para inicio</label>
                                <div class="border rounded p-3 text-center" style="min-height: 150px;">
                                    @if($promo->imagen_home)
                                        <img src="{{asset('img/promociones/'.$promo->imagen_home)}}"
                                             class="img-fluid mb-2"
                                             style="max-height: 120px;">
                                        <br>
                                        <button class="btn btn-danger btn-sm delete-image-btn"
                                                data-id="{{$promo->id}}"
                                                data-url="{{route('promo.destroyimagenhome', $promo->id)}}"
                                                data-type="home">
                                            <i class="bi bi-trash"></i> Eliminar
                                        </button>
                                    @else
                                        <p class="text-muted">Sin imagen</p>
                                    @endif
                                    <div class="mt-2">
                                        <input type="file"
                                               class="form-control promo-image-upload"
                                               data-id="{{$promo->id}}"
                                               data-url="{{route('upload.imagenhome', $promo->id)}}"
                                               data-type="home"
                                               accept="image/*">
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
                    <button class="btn btn-danger delete-promo-btn" data-id="{{$promo->id}}">
                        <i class="bi bi-trash"></i> Eliminar
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
                            $('.promo-card-wrapper[data-id="'+id+'"] .promo-title').text(value);
                        }
                        if(field === 'monto') {
                            $('.promo-card-wrapper[data-id="'+id+'"] .precio').text('$ ' + parseFloat(value).toLocaleString());
                        }
                        // Recargar la lista de promociones
                        refreshPromos();
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
                        refreshPromos();
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
            let type = $(this).data('type');
            let formData = new FormData();
            formData.append('image', file);
            formData.append('_token', '{{csrf_token()}}');

            // Mostrar preview
            let area = $(this).closest('.border');
            let reader = new FileReader();
            reader.onload = function(e) {
                let img = area.find('img');
                if(img.length) {
                    img.attr('src', e.target.result);
                } else {
                    area.prepend('<img src="'+e.target.result+'" class="img-fluid mb-2" style="max-height: 120px;">');
                }
            };
            reader.readAsDataURL(file);

            // Subir imagen
            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if(response.success) {
                        refreshPromos();
                        // Recargar el modal después de un momento
                        setTimeout(function() {
                            let promoId = id;
                            $.get('/promo/open/' + promoId, function(data) {
                                $('#promoEditContent').html(data);
                            });
                        }, 1000);
                    }
                },
                error: function() {
                    alert('Error al subir la imagen');
                }
            });
        });

        // Eliminar imagen
        $('.delete-image-btn').on('click', function() {
            let url = $(this).data('url');
            let id = $(this).data('id');
            let type = $(this).data('type');

            if(confirm('¿Eliminar esta imagen?')) {
                $.ajax({
                    url: url,
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-Token': '{{csrf_token()}}'
                    },
                    success: function() {
                        refreshPromos();
                        // Recargar el modal
                        $.get('/promo/open/' + id, function(data) {
                            $('#promoEditContent').html(data);
                        });
                    }
                });
            }
        });

        // Eliminar promoción
        $('.delete-promo-btn').on('click', function() {
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
                        // Eliminar la card
                        $('.promo-card-wrapper[data-id="'+id+'"]').fadeOut(300, function() {
                            $(this).remove();
                        });
                    }
                });
            }
        });
    });

    function refreshPromos() {
        // Recargar la lista de promociones
        $.ajax({
            url: '{{route("promos.index")}}',
            type: 'GET',
            success: function(response) {
                if(response.view) {
                    $('.listar_productos').html(response.view);
                    // Re-inicializar eventos
                    if(typeof functions === 'function') {
                        functions();
                    }
                }
            }
        });
    }
</script>
