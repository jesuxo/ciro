<!-- views/dashboard/partials/promo_edit.blade.php -->
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

