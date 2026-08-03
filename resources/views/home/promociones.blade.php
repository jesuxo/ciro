@extends('home.layouts.master')
@section('title')
    PROMOCIONES TIENDASCIRO.COM
@endsection
@section('css')


@endsection
@section('content')

    @php $mantenimiento = 0; @endphp

    @if($mantenimiento)

        <div class="container searched_hide section-header searched_hide">
            <div class="row">
                <div class="col-md-6"><img class="" style="width: 100%" src="img/mantenimiento.png" alt=""></div>
                <div class="col-md-6" style="text-align:justify">
                    <h2>P&aacute;gina en Mantenimiento</h2>
                    <p>
                        Actualmente estamos actualizando nuestra secci&oacuten de promociones, pronto estaremos de vuelta con muchas mas promociones
                    </p>
                    <p>
                        <a href="https://www.instagram.com/ciroenlinea/" class="btn btn-primary">@ciroelinea</a>
                    </p>
                </div>
            </div>
        </div>
    @else

        @php
            $combos = 0;
            if(isset($promociones))
                foreach($promociones as $promo){
                        if($promo->combo == 1){
                            $combos++;
                        }
                }
        @endphp

        @if(isset($promociones[0]))
            <div class="container mt-3">
                <div class="row desktop-top">
                    @if($combos>0)
                        <div class=" mb-4 col-13  " style="background-color: var(--tb-danger-bg-subtle) !important;
                        color: #ef476f !important; border: 1px solid #ef476f;   border-radius: 5px;   padding: 10px;   text-align: center;
  font-size: x-large;" > <i class="bi bi-arrow-down-circle" style="margin-right: 20px;"></i>  PROMOCIONES EN COMBO </div>
                    @endif
                    @foreach($promociones as $promo)
                        @if(isset($promo->imagen) and  $promo->imagen != '')
                                @if($combos>0 and $promo->combo == 0)
                                    @php $combos= 0; @endphp
                                    <div class=" mb-4 col-13  " style="background-color: var(--tb-danger-bg-subtle) !important;
                        color: #ef476f !important; border: 1px solid #ef476f;   border-radius: 5px;   padding: 10px;   text-align: center;
  font-size: x-large;" > <i class="bi bi-arrow-down-circle" style="margin-right: 20px;"></i>  NUESTRAS OTRAS PROMOCIONES  </div>
                                @endif
                            <div class=" mb-4 col-3 col-lg-2"  >
                                    <?php
                                    $file = ($promo->imagen)? asset('img/promociones/'.$promo->imagen) : '';

                                    if (file_exists(public_path().'/img/promociones/th'.$promo->imagen)) {
                                        $file = asset('img/promociones/th'.$promo->imagen);
                                    }
                                    ?>
                                <img src="{{$file}}" style="width: 100%; cursor:pointer;" class="promomodal" data-id="{{$promo->id}}" data-url="{{route('ver.promoid', $promo->id)}}" data-bs-toggle="modal" data-bs-target="#verpromo"   >
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        @else
            @if(isset($gosearchpromo) and $gosearchpromo)
                <div class="text-center mt-5">
                    <img src="/img/default.jpg" style="max-width: 200px" class=" mt-5"/>
                    <br>
                    <br>
                    No se encontraron resultados
                </div>
            @endif
        @endif

        <div class="modal fade" id="verpromo" aria-hidden="true" aria-labelledby="..." tabindex="-1">
            <div class="modal-dialog modal-lg modal-dialog-scrollable" >
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="titulorepventasucu">Promoci&oacute;n</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body" id="content_modal-promo">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">  CERRAR</button>
                    </div>
                </div>
            </div>
        </div>


        @include('home.contenthome')
    @endif


@endsection
@section('scripts')
    <script>
        $('.promomodal').unbind('click').bind('click', function(event) {

            var url = $(this).data('url');

            $('#content_modal-promo').html('Cargando promo');

            $.ajax({
                type        : 'get',
                url         : url,
                dataType    : "html",
                headers     : { 'X-CSRF-Token' : $('meta[name="csrf-token"]').attr('content') },
                evalScripts : true,
                element_to_overlay : '#content_modal-promo',
                success     : function(response){

                    $('#content_modal-promo').html(response);

                },error:function () {
                }
            });

        });
    </script>
@endsection
