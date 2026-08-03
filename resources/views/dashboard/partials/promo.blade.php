<style>


    .inputfile{
        width:0.1px;
        height:0.1px;
        opacity:0;
        overflow:hidden;
        position:absolute;
        z-index:-1;
    }
    .rounded-circle {
        border-radius: 5px !important;
    }
</style>

<div class="card">
    <div class="card-header" id="customer-support{{$promo->id}}">
        <h5 class="mb-0">
            Nombre de esta promocion
            <div class="btn btn-link d-flex align-items-center justify-content-between flex-grow" data-toggle="collapse" data-target="#customer-support-collapse-{{$promo->id}}" aria-expanded="true" aria-controls="customer-support-collapse-{{$promo->id}}">
                <div>

                    <input class="promoinputs" placeholder="**Requerido" name="descrip"
                           value="{{$promo->descrip}}" data-url="{{route('promo.update')}}"
                           data-idpromo="{{$promo->id}}"
                           data-promo="1" data-method="post"  size="20" style="width: 400px; font-weight: 200"
                    />

                </div>
                @if($promo->monto > 0)
                    <span  class="precio"  > $  {{number_format($promo->monto)}} </span>
                @endif
            </div>
        </h5>
    </div>
    <div id="customer-support-collapse-{{$promo->id}}"  aria-labelledby="customer-support{{$promo->id}}" data-parent="#accordion-1" style="">
        <div class="card-body">


            <div class="field-content mb-3" style="display: none">
                <div class="mr-3">Destacada en el home</div>
                <div>
                    <input type="checkbox" name="destacada"
                           data-promo="1" {{($promo->destacada)? 'checked': ''}}
                           value="1"  data-url="{{route('promos.update', $promo->id)}}" >
                </div>
            </div>
            <div class="row">

                <div class="col-lg-6"   >
                    <div class="mr-3 open-promo-delete cursor-pointer" data-promo="{{$promo->id}}">Eliminar ?</div>
                    <div class="display_none btn-promo-delete{{$promo->id}}">
                        <button type="button" class="btn btn-outline-success promo_eliminece" data-promoid="{{$promo->id}}" data-action="{{route('promo.delete')}}">Eliminece</button>
                    </div>
                </div>

                <div class="col-lg-6"   >
                    <div class="form-check form-switch form-switch-lg mb-3" dir="ltr">
                        <input type="checkbox" class="form-check-input"

                               value="1" data-url="{{route('promo.update')}}"
                               data-idpromo="{{$promo->id}}"
                               data-promo="1" data-method="post"
                               id="combo" name="combo"  {{($promo->combo)?'checked':''}} >
                        <label class="form-check-label" for="combo">Este combo?</label>
                    </div>
                </div>
                <div class="col-lg-12"   >
                    <div class="image-content" style="display: none">
                        <div class="mr-3">Imagen para el inicio de la pagina</div><br>
                        <img src="{{asset('img/addpicture.png')}}" class="imageth cursor_pointer rounded-circle upload_imagenhome_promo"   data-id="{{$promo->id}}" data-url="{{route('upload.imagenhome', $promo->id)}}" >
                        <div class="imageneshome{{$promo->id}} d-flex">
                            @include('dashboard.partials.promo_imagen_home')
                        </div>
                    </div>
                </div>
                <div class="col-lg-12"   >
                    <div class="mr-3">Imagen de promo</div><br>

                    <img src="{{asset('img/addpicture.png')}}" class="imageth cursor_pointer rounded-circle upload_imagen_promo"
                         data-id="{{$promo->id}}" data-url="{{route('upload.imagen', $promo->id)}}" >
                    <div class="imagenes{{$promo->id}} d-flex">
                        @include('dashboard.partials.promo_imagen')
                    </div>
                </div>
            </div>



        </div>
    </div>
</div>
