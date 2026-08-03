@extends('layouts.master')
@section('title')
    Inicio
@endsection
@section('css')
    <style>
        .cursor_pointer{
            cursor: pointer;
        }
        .display_none{
            display: none;
        }
        .botoncal{
            background: transparent;
            border: none;
            color: white;
        }
        .botoncal:hover{
            font-size: 13px;
        }
        .linkunderline:hover{
            text-decoration: underline;
        }
        .imageth{
            max-height: 80px;
            margin-bottom: 10px;
            margin-left: 10px;
        }

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
        /* Estilos para el modal de edición */
        .promo-edit-modal .modal-dialog {
            max-width: 800px;
        }

        .promo-edit-modal .modal-body {
            padding: 0;
        }

        /* Estilos para las imágenes */
        .image-preview-container {
            position: relative;
            display: inline-block;
        }

        .image-preview-container .delete-image-btn {
            position: absolute;
            top: -10px;
            right: -10px;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            padding: 0;
            font-size: 12px;
        }

        /* Animaciones */
        .promo-card-wrapper {
            transition: all 0.3s ease;
        }

        .promo-card-wrapper.fade-out {
            opacity: 0;
            transform: scale(0.9);
        }

        /* Spinner de carga */
        .spinner-border-sm {
            width: 1rem;
            height: 1rem;
            border-width: 0.2em;
        }
    </style>
@endsection
@section('content')
    <div class="row">
        <div class=" col-lg-12  ">
            {!! $vista !!}
        </div>

        <div class=" col-lg-4 ">
            <form name="uploadform" enctype="multipart/form-data" role="form" method="post" style="display: none;">
                <input name="fileimagen" id="fileimagen" class="inputfile" multiple="multiple" type="file">
                <input name="fileimagenhome" id="fileimagenhome" class="inputfile" multiple="multiple" type="file">
            </form>
        </div>
    </div>

    <!-- Modal para editar promociones -->
    <div class="modal fade promo-edit-modal" id="promoEditModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body p-0" id="promoEditContent">
                    <!-- Contenido cargado vía AJAX -->
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')


    <!-- App js -->
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
    <script>

        var busquedaActual  = '';
        var categoriaActual = '';
        var tab             = 1;

        var imageUrl        = '';
        var product_id      = 0;
        var promo_id        = 0;
        var producto        = 0;

        $('.categoria').click(function () {
            categoriaActual = $(this).data('codinst');
            $('.remove_by_category').slideDown();
            buscarProductos('categoria'+categoriaActual);
        });

        $('.btn-search').click(function () {
            busquedaActual  = '';
            $('#busqueda').val('');
            $('.btn-search').removeClass('ti-close').addClass('ti-search');
            buscarProductos('');
        });

        $('.abrirHijos').click(function () {
            var nivel = $(this).data('nivel');
            var padre = $(this).data('codinst');

            for(var i = nivel; i < 20; i++)
                $('.nivel'+i).addClass('display_none');

            $('.hijos'+padre).removeClass('display_none');

            $('html,body').animate({scrollTop : $('.categoria'+padre).offset().top - 200}, 1000);
        });

        function buscarProductos(loading) {
            $('.paginar_productos').removeClass('display_none').addClass('display_none');

            $.ajax({
                type        : 'post',
                headers     : { 'X-CSRF-Token' : $('meta[name="csrf-token"]').attr('content') },
                url         : '{{route('dashboard')}}',
                dataType    : "html",
                data        : {  busqueda: busquedaActual, categoria: categoriaActual, id: producto },
                evalScripts : true,
                element_to_overlay : '#accordion-1',
                success     : function(response){

                    producto = 0;
                    var json = JSON.parse(response);
                    $('#accordion-1').html(json.vista_prod);

                    if(json.nextPage)
                        nextPage = json.nextPage;

                    if(json.count == 9)
                        $('.paginar_productos').removeClass('display_none');
                    else
                        $('.paginar_productos').addClass('display_none');

                    functions();
                    pictures();

                },
                error : function () {

                }
            });
        }

        $('.paginar_productos').click(function () {

            $.ajax({
                type        : 'post',
                headers     : { 'X-CSRF-Token' : $('meta[name="csrf-token"]').attr('content') },
                url         : nextPage,
                dataType    : "html",
                data        : { busqueda: busquedaActual, categoria: categoriaActual },
                evalScripts : true,
                element_to_overlay : '#accordion-1',
                success     : function(response){

                    var json = JSON.parse(response);

                    $('#accordion-1').html(json.vista_prod);

                    if(json.nextPage)
                        nextPage = json.nextPage;

                    if(json.count == 9)
                        $('.paginar_productos').removeClass('display_none');
                    else
                        $('.paginar_productos').addClass('display_none');

                    var hidden = $('.shop_grid_area').hasClass('display_none');

                    functions();
                    pictures();

                },
                error : function () {

                }
            });

        });

        function functions() {

            $('.abrir-promociones').unbind('click').bind('click', function(event) {

                $.ajax({
                    type        : 'get',
                    headers     : { 'X-CSRF-Token' : $('meta[name="csrf-token"]').attr('content') },
                    url         : '{{route('promos.index')}}',
                    dataType    : "html",
                    evalScripts : true,
                    element_to_overlay : '.listar_productos',
                    success     : function(response){

                        var json = JSON.parse(response);

                        $('.listar_productos').html(json.view);

                        functions();
                    },
                    error : function () {

                    }
                });

            });



            $('.eliminece').unbind('click').bind('click', function(event) {
                var action = $(this).data('action');

                $.ajax({
                    type        : 'delete',
                    headers     : { 'X-CSRF-Token' : $('meta[name="csrf-token"]').attr('content') },
                    url         : action,
                    dataType    : "html",
                    evalScripts : true,
                    element_to_overlay : '#accordion-1',
                    success     : function(data){
                        buscarProductos('');

                    }
                });
            });

            $('.promo_eliminece').unbind('click').bind('click', function(event) {
                var action = $(this).data('action');
                var promoid = $(this).data('promoid');

                $.ajax({
                    type        : 'post',
                    headers     : { 'X-CSRF-Token' : $('meta[name="csrf-token"]').attr('content') },
                    url         : action,
                    dataType    : "html",
                    evalScripts : true,
                    data        : {'id' : promoid},
                    element_to_overlay : '#accordion-1',
                    success     : function(data){
                        buscarProductos('');
                        refreshPromo(promoid)
                    }
                });
            });

            $('.open-delete').unbind('click').bind('click', function(event) {
                var prod = $(this).data('prod');
                $('.btn-delete'+prod).removeClass('display_none');
            });

            $('.open-promo-delete').unbind('click').bind('click', function(event) {
                var promo = $(this).data('promo');
                $('.btn-promo-delete'+promo).removeClass('display_none');
            });

            $('.productomodal').unbind('click').bind('click', function(event) {

                var url = $(this).data('url');

                modalopen = 1;

                $('#content_modal-producto').html('Cargando producto');

                $.ajax({
                    type        : 'get',
                    url         : url,
                    dataType    : "html",
                    headers     : { 'X-CSRF-Token' : $('meta[name="csrf-token"]').attr('content') },
                    evalScripts : true,
                    element_to_overlay : '#content_modal-producto',
                    success     : function(response){

                        var json = JSON.parse(response);
                        $('#content_modal-producto').html(json.data);

                        var pr_image = $('.pr_image');

                        if (pr_image.length) {
                            pr_image.owlCarousel({
                                loop: true,
                                items: 1,
                                autoplay: true,
                                dots: true,
                                thumbs: true,
                                thumbImage: true,
                            });
                        }
                        functions();
                    },error:function () {
                        functions();
                    }
                });

            });

            $('.ver_instancia').unbind('click').bind('click', function(e) {

                var url = $(this).data('url');


                $.ajax({
                    type        : 'get',
                    headers     : { 'X-CSRF-Token' : $('meta[name="csrf-token"]').attr('content') },
                    url         : url,
                    dataType    : "html",
                    evalScripts : true,
                    element_to_overlay : '.view_instancia',
                    success     : function(response){
                        $('.view_instancia').html(response);

                        functions();
                    },
                    error : function () {

                    }
                });

            });





            $('.open_promo').unbind('click').bind('click', function(e) {
                var id = $(this).data('id');
                $('.promo-data').html('<div class="text-center p-5"><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Cargando...</span></div></div>');

                $.ajax({
                    type: 'get',
                    headers: { 'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content') },
                    url: '/promo/open/' + id,
                    dataType: "html",
                    success: function(response){
                        $('.promo-data').html(response);
                        // Inicializar eventos después de cargar
                        if(typeof initPromoEvents === 'function') {
                            initPromoEvents();
                        }
                        functions();
                    },
                    error: function(xhr, status, error) {
                        console.error('Error al cargar la promoción:', error);
                        $('.promo-data').html('<div class="alert alert-danger">Error al cargar la promoción</div>');
                    }
                });
            });



            $('input, textarea, select').unbind('change').bind('change', function(e) {


                var n = $(this).attr('name'),
                    p = $(this).data('promo'),
                    s = $(this).data('unset'),
                    v = $(this).val(),
                    u = $(this).data('url'),
                    i = $(this).data('instancia'),
                    m = $(this).data('method'),
                    id = 0;
                if(m)
                    id = $(this).data('idpromo');
                else
                    m = "PUT";

                if(s && s == 1){
                    return true;
                }

                if(i && i == 1){


                    if(n == 'destacada' || n == 'combo'){
                        v = 0;

                        var checked = $(this).is(":checked");
                        if(checked)
                            v = 1;

                    }

                    var busqueda = $('#busqueda_instancias').val();

                    $.ajax({
                        headers : { 'X-CSRF-Token' : $('meta[name="csrf-token"]').attr('content') },
                        data    : { n: n, v: v, busqueda: busqueda},
                        type    : m,
                        url     : u,
                        success : function (response) {
                            $('.instancias_listadas').html(response);
                            functions();
                        }
                    });
                    return true;
                }

                if(n == 'file' || n == 'fileimagen' || n == 'fileimagenhome' ){

                    var files = e.target.files;
                    var validExtensions = ['jpg','png','jpeg']; //array of valid extensions
                    var allowed = 1;

                    var l  = files.length;
                    if ( l != 0) {
                        var data = new FormData();
                        for (var i = 0; i < files.length ; i++) {
                            var fileName = files[i].name;
                            var fileNameExt = fileName.substr(fileName.lastIndexOf('.') + 1);
                            if ($.inArray(fileNameExt, validExtensions) == -1) {
                                allowed = 0;
                                break;
                            }
                            else
                            {
                                data.append(files[i].name, files[i]);
                            }

                        }
                    }else{
                        allowed = 0;
                    }

                    if(allowed){
                        var overlayimg = '.imagenes'+product_id;

                        if(p && p == 1){
                            if(n == 'fileimagen')
                                overlayimg = '.imagenes'+promo_id;
                            if(n == 'fileimagenhome')
                                overlayimg = '.imageneshome'+promo_id;

                        }

                        $.ajax({
                            contentType: false,
                            processData: false,
                            type: 'POST',
                            headers: { 'X-CSRF-Token' : $('meta[name="csrf-token"]').attr('content') },
                            data: data,
                            dataType: 'json',
                            url: imageUrl,
                            element_to_overlay : overlayimg,
                            success: function (data) {

                                if(p){
                                    if(n == 'fileimagen')
                                        $('.imagenes'+promo_id).html(data.view);
                                    if(n == 'fileimagenhome')
                                        $('.imageneshome'+promo_id).html(data.view);
                                    refreshPromo(promo_id)
                                    functions();
                                }else{
                                    $('.imagenes'+product_id).html(data.view);
                                }

                                pictures();

                            },error: function (data) {

                            }
                        });
                    }

                    return true;
                }

                if(n == 'busqueda' ){
                    busquedaActual  = $(this).val();
                    $('.btn-search').removeClass('ti-search').addClass('ti-close');
                    buscarProductos('');
                    return true;
                }

                if(n == 'combo' || n == 'destacada' ||   n == 'destacado' || n == 'precio_visible'){
                    v = 0;

                    var checked = $(this).is(":checked");
                    if(checked)
                        v = 1;

                }


                $.ajax({
                    headers : { 'X-CSRF-Token' : $('meta[name="csrf-token"]').attr('content') },
                    data    : { n: n, v: v, id: id},
                    type    : m,
                    url     : u,
                    success : function (response) {

                        if(p && id > 0){
                            refreshPromo(id)
                            functions();
                        }


                    }
                });

            });


            pictures();
        }

        functions();


        // Función para refrescar una promoción específica
        function refreshPromo(id) {
            $.ajax({
                headers: { 'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content') },
                data: { id: id },
                type: 'post',
                url: '{{route("promo.refresh")}}',
                success: function(response) {
                    $('.promoid'+id).html(response);
                    functions();
                }
            });
        }

        function pictures() {

            $('.upload_imagen_promo').unbind('click').bind('click', function(event) {
                $('#fileimagen').click();
                imageUrl   = $(this).data('url');
                promo_id = $(this).data('id');
            });

            $('.upload_imagenhome_promo').unbind('click').bind('click', function(event) {
                $('#fileimagenhome').click();
                imageUrl   = $(this).data('url');
                promo_id = $(this).data('id');
            });

            $('.upload_image').unbind('click').bind('click', function(event) {
                $('#file').click();
                imageUrl   = $(this).data('url');
                product_id = $(this).data('id');
            });

            $('.delete_image').unbind('click').bind('click', function(event) {
                var urlDelete = $(this).data('url');
                product_id = $(this).data('id');

                $.ajax({
                    type        : 'delete',
                    headers     : { 'X-CSRF-Token' : $('meta[name="csrf-token"]').attr('content') },
                    url         : urlDelete,
                    dataType    : "html",
                    evalScripts : true,
                    element_to_overlay : '.imagenes'+product_id,
                    success     : function(data){

                        $('.imagenes'+product_id).html(data);
                        pictures()

                    },
                    error : function () {

                    }
                });

            });

            $('.delete_promo_imagen').unbind('click').bind('click', function(event) {
                var urlDelete = $(this).data('url');
                promo_id = $(this).data('id');

                $.ajax({
                    type        : 'delete',
                    headers     : { 'X-CSRF-Token' : $('meta[name="csrf-token"]').attr('content') },
                    url         : urlDelete,
                    dataType    : "html",
                    evalScripts : true,
                    element_to_overlay : '.imagenes'+promo_id,
                    success     : function(data){

                        $('.imagenes'+promo_id).html('');
                        pictures()
                        refreshPromo(promo_id)
                        functions();

                    },
                    error : function () {

                    }
                });

            });

            $('.delete_promo_imagen_home').unbind('click').bind('click', function(event) {
                var urlDelete = $(this).data('url');
                promo_id = $(this).data('id');

                $.ajax({
                    type        : 'delete',
                    headers     : { 'X-CSRF-Token' : $('meta[name="csrf-token"]').attr('content') },
                    url         : urlDelete,
                    dataType    : "html",
                    evalScripts : true,
                    element_to_overlay : '.imageneshome'+promo_id,
                    success     : function(data){

                        $('.imageneshome'+promo_id).html('');
                        pictures()
                        refreshPromo(promo_id)
                        functions();
                    },
                    error : function () {

                    }
                });

            });

            $('.set_imagen').unbind('click').bind('click', function(event) {
                var url    = $(this).data('url');
                product_id = $(this).data('id');

                $.ajax({
                    type        : 'get',
                    headers     : { 'X-CSRF-Token' : $('meta[name="csrf-token"]').attr('content') },
                    url         : url,
                    dataType    : "html",
                    evalScripts : true,
                    element_to_overlay : '.imagenes'+product_id,
                    success     : function(data){

                        $('.imagenes'+product_id).html(data);
                        pictures()

                    },
                    error : function () {

                    }
                });

            });

            $('.prod_destacado').unbind('click').bind('click', function(event) {
                producto = $(this).data('id');
                buscarProductos('');
            });
        }

        pictures();

    </script>

@endsection
