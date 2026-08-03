<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="{{asset('img/logo.png')}}" type="image/x-icon">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="author" content="Jesus Celis - celisweb" />
    <meta name="copyright" content="Tiendas Ciro S.A" />
    @include('layouts.head-css')

    <script
        src="https://code.jquery.com/jquery-3.7.0.min.js"
        integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g="
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://unpkg.com/element-ui@2.5.4/lib/theme-chalk/index.css">

    @if(!isset($data->id))

        <title>Tiendas Ciro S.A. - mercadeo@tiendasciro.com</title>
        <meta name="description" content="Venta de productos para el hogar, electrodom&eacute;sticos en general. Email:mercadeo@tiendasciro.com">
        <link rel="canonical" href="https://www.tiendasciro.com">
        <meta property="og:title" content="Tiendas Ciro S.A. - mercadeo@tiendasciro.com">
        <meta property="og:description" content="Venta de productos para el hogar, electrodom&eacute;sticos en general. Email:mercadeo@tiendasciro.com">
        <meta property="og:type" content="WebPage">
        <meta property="og:image" content="http://tiendasciro.com/img/logo.png">
        <meta property="og:url" content="http://tiendasciro.com">

        <meta name="twitter:title" content="Tiendas Ciro S.A. - mercadeo@tiendasciro.com">
        <meta name="twitter:description" content="Venta de productos para el hogar, electrodom&eacute;sticos en general. Email:mercadeo@tiendasciro.com">
        <meta name="twitter:site" content="@ciroenlinea">
        <script type="application/ld+json">{"@context":"https://schema.org","@type":"WebPage","name":"Tiendas Ciro S.A.","description":"Venta de productos para el hogar, electrodom&eacute;sticos en general. Email:mercadeo@tiendasciro.com"}</script>


    @endif



    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-MCHXSJ78SG"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-MCHXSJ78SG');
    </script>

    @yield('css-section')
    @yield('og-section')

</head>

<body >
<!--  @ include('home.layouts.partials.contentlista')-->


    <div class="body_wrapper">

        @yield('content')

        <!--@ include('home.layouts.footer')-->
    </div>

    <div class="modal fade text-left" id="verproducto" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="width: 40px; right: 0; position: absolute; padding: 10px;">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="modal-container" >
                    <div id="content_modal-producto" class="p-4">

                    </div>
                </div>
            </div>
        </div>
    </div>

    @if(!Auth::user())
        <div class="modal fade text-left" id="user_iframe" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenter" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document"  >
                <div class="modal-content" >
                    <button type="button" class="close actaualizar_token"  style="width: 40px; right: 0; position: absolute; padding: 10px;">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="modal-container" style="background: #fafafa;">
                        <iframe class="user_iframe" width="100%" height="100%" src="{{route('login')}}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <script>
       /*
        $(document).ready(function() {

            var ocultar = $('.ocultar').length;

            if(ocultar > 0){
                $('.ocultar').addClass('display_none');
            }

            $(document).ajaxSend(function (event, jqxhr, settings) {
                $(settings.element_to_overlay).LoadingOverlay("show", {
                    imageColor: "#0071ba",
                    imageResizeFactor: 0.4,
                    imageAutoResize: false
                });
            });

            $(document).ajaxComplete(function (event, jqxhr, settings) {
               $(settings.element_to_overlay).LoadingOverlay("hide", true);

            });

        });
        */


      /*
        const Toast = Swal.mixin({
            toast: true,
            position: 'bottom-end',
            showConfirmButton: false,
            timer: 3000
        });

        $('.gotoinstancia').on('click', function(){
            var selector = $(this).data('selector');
            $('html,body').animate({scrollTop : $('.'+selector).offset().top-100},1000);
        });

        window.notify = function notify(status, message) {
            Toast.fire({
                icon: status,
                title: message
            })
        }

        function msg(e) {
            e.preventDefault();

            var msg = $('.msgwhatsapp').val();

            $.ajax({
                type        : 'post',
                headers     : { 'X-CSRF-Token' : $('meta[name="csrf-token"]').attr('content') },
                url         : '{{route('encode.msg')}}',
                dataType    : "html",
                data        : { msg: msg},
                evalScripts : true,
                success     : function(encoded){
                    console.log(encoded)
                    //aqui no terminado

                },error:function () {

                }
            });

            window.location.href = ""+msgwhatsapp;
        }

        var related = $('.related_listed').length;

        if(related == 0)
            $('.related_div').hide();

        let modalopen        = 0;
        let precio1          = 0;
        let functionbusqueda = {{( isset($producto) and $producto )? 1 : 0}};
        let precio2          = 100;
        let vistaActual      = 0;
        let menuabierto      = 0;
        let buscarPorPrecios = 0;
        let vertodos         = 0;
        let ordenprecio      = '';
        let busquedaActual   = '{{(isset($gosearch) and $gosearch !='')? $gosearch: ''}}';
        let categoriaActual  = '{{(isset($gocategor) and $gocategor !='')? $gocategor : ''}}';
        let marcaActual      = '{{(isset($gomarca) and $gomarca !='')? $gomarca : ''}}';
        let route            = '{{route('site')}}';
        let origen           = '{{route('site')}}';
        let csrf             = $('meta[name="csrf-token"]').attr('content');

        if(screen.width < 760) {
            vistaActual = 1;
        }

        @if(isset($data->id))
            if(screen.width < 760){
                $('html,body').animate({scrollTop : $('.pr_title').offset().top-100},1000);
            }
        @endif


        if ($("#slider-range").length) {
            $("#slider-range").slider({
                range: true,
                min: 0,
                max: 500,
                values: [0, 100],
                slide: function (event, ui) {
                    var val = "$" + ui.values[0] + " - $" + ui.values[1];

                    precio1 = ui.values[0];
                    precio2 = ui.values[1];

                    if(ui.values[1] == 500){
                        val = val + "+";
                    }

                    $("#amount").val(val);
                }
            });
            $("#amount").val("$" + $("#slider-range").slider("values", 0) +
                " - $" + $("#slider-range").slider("values", 1));
        }

        function buscarProductos(loading) {
            $('.section-site').hide();
            $('#loadinggif').show();

            $('html, body').animate({ scrollTop: 0 },"fast");
            $('.display_products').html('');
            $('#instrender').html('');
            if(!functionbusqueda){
                $('.search_content').addClass('display_none');
                $('.product_details_area').slideUp().addClass('display_none');
                functionbusqueda = 1;
            }

            var precios  = '';

            if(buscarPorPrecios == 1){
                precios = {'precio1': precio1, 'precio2': precio2};
            }

                $.ajax({
                    type        : 'post',
                    headers     : { 'X-CSRF-Token' : $('meta[name="csrf-token"]').attr('content') },
                    url         : route,
                    dataType    : "html",
                    data        : { vista      : (vistaActual)?vistaActual:'',
                                    precios    : (precios)?precios:'',
                                    marcaprod  : (marcaActual)?marcaActual:'',
                                    vertodos   : (vertodos)?vertodos:'',
                                    ordenprecio: (ordenprecio)?ordenprecio:'',
                                    busqueda   : (busquedaActual)?busquedaActual:'',
                                    categoria  : (categoriaActual)?categoriaActual:''},
                    evalScripts : true,
                    success     : function(response){

                        $('.search_content').removeClass('display_none');
                        $('.searched_hide').addClass('display_none');

                        var json = JSON.parse(response);

                        $('.display_products').html(json.vista_prod);

                        $('#instrender').html(json.instancias);

                        var hidden = $('.shop_grid_area').hasClass('display_none');

                        if(hidden){
                            $('.shop_grid_area').slideDown().removeClass('display_none');
                            $('.product_details_area').slideUp().addClass('display_none');
                        }

                        if(modalopen == 1){
                            $('#verproducto').modal('hide');
                        }

                        listeners();
                        $('#loadinggif').hide();
                    },error:function () {
                        listeners();
                        $('#loadinggif').hide();
                    }
                });

            listeners();
        }
        var user_modal_open = 0;

        function user_modal() {

            user_modal_open = 1;
            if(screen.width < 760){
                $('.user_iframe').attr('height', '515px');
                $('.user_iframe').attr('width', '100%');
            }else{
                $('.user_iframe').attr('height', '515px');
                $('.user_iframe').attr('width', '800px');
            }

            $('#user_iframe').modal({backdrop:false});
        }

        function cerrarpopup() {
            setTimeout(function () {
                $('.popover-content').html('');
                $('.cart-popover').slideUp('slow');
            }, 3000);
        }

        function howagregados() {
            $.ajax({
                type        : 'get',
                headers     : { 'X-CSRF-Token' : $('meta[name="csrf-token"]').attr('content') },
                url         : '{{route('actualizar.agregados')}}',
                dataType    : "html",
                evalScripts : true,
                success     : function(response){
                    var json = JSON.parse(response);
                    $('.items-agregados').html(json.count).removeClass('display_none');
                }
            });
        }

        function listeners() {


            function getCookie(cname) {
                var name = cname + "=";
                var decodedCookie = decodeURIComponent(document.cookie);
                var ca = decodedCookie.split(';');
                for(var i = 0; i <ca.length; i++) {
                    var c = ca[i];
                    while (c.charAt(0) == ' ') {
                        c = c.substring(1);
                    }
                    if (c.indexOf(name) == 0) {
                        return c.substring(name.length, c.length);
                    }
                }
                return "";
            }

            $('.actaualizar_token').unbind('click').bind('click',function(event) {

                var cookies = document.cookie;

                $('#user_iframe').modal('hide');

                if(cookies){
                    var mitoken = getCookie("micsrftoken");
                    console.log(mitoken);

                    $('meta[name="csrf-token"]').attr('content', mitoken);
                }

            });


            $('.close_btn-delete').unbind('click').bind('click',function(event) {

                var url = $(this).data('url');
                var id  = $(this).data('id');

                $.ajax({
                    type        : 'delete',
                    url         : url,
                    dataType    : "html",
                    headers     : { 'X-CSRF-Token' : $('meta[name="csrf-token"]').attr('content') },
                    evalScripts : true,
                    element_to_overlay : '.divitem' + id,
                    success     : function(response){
                        $('.divitem' + id).html('').hide();

                        var json = JSON.parse(response);

                        $('.items-agregados').html(json.count).removeClass('display_none');
                        $('.link_to_pay').attr('href', json.href);
                        $('.monto_total').html(json.monto);

                    },error: function () {

                    }
                });
            });

            $('.btn-action_cantidad').unbind('click').bind('click', function(event) {

                var blocked = $(this).hasClass( "btn-blocked" );

                if(!blocked){

                    $('.store_overlay').addClass('active');
                    $('.cart-container').removeClass('display_none');

                    var cant = $(this).data('cantidad');
                    var oper = $(this).data('oper');
                    var id   = $(this).data('id');

                    $.ajax({
                        type        : 'get',
                        url         : '{{route('compraitems.index')}}',
                        dataType    : "html",
                        headers     : { 'X-CSRF-Token' : $('meta[name="csrf-token"]').attr('content') },
                        data        : { id: id, oper: oper, cant: cant },
                        evalScripts : true,
                        element_to_overlay : '.content-btn-cambiar' + id,
                        success     : function(response){

                            var json = JSON.parse(response);

                            $('.cantidad'+id).html(json.cant);

                            $('.minus'+id).data('cantidad', json.cant);
                            $('.plus' +id).data('cantidad', json.cant);

                            if(json.cant == 1)
                                $('.minus'+id).addClass('btn-blocked');

                            if(json.cant > 1)
                                $('.minus'+id).removeClass('btn-blocked');

                            if(json.existencia == json.cant)
                                $('.plus'+id).addClass('btn-blocked');

                            if(json.existencia > json.cant)
                                $('.plus'+id).removeClass('btn-blocked');

                            $('.listaproductos').html(json.lista);
                            $('.link_to_pay').attr('href',json.href);
                            $('.monto_total').html(json.monto);

                            listeners();

                        },error: function () {
                            notify('warning','Item no encontrado, por favor recargue la pagina');
                        }
                    });

                }

            });

            $('.close_btn-cantidades').unbind('click').bind('click',function(event) {
                $('.botones-cambiar').addClass('display_none');
            });

            $('.btn-cantidad').unbind('click').bind('click',function(event) {
                var id = $(this).data('id');

                $('.botones-cambiar').addClass('display_none');
                $('.cambiar_cantidad'+id).removeClass('display_none');
            });

            $('.contenidopag').unbind('click').bind('click',function(event) {

                if(menuabierto)
                    $('.navbar-toggler').click();

            });

            $('#botonhamb').unbind('click').bind('click',function(event) {
                if(menuabierto)
                    menuabierto = 0
                else
                    menuabierto = 1
            });

            $('.cerrar_lista').unbind('click').bind('click',function(event) {
                $('.store_overlay').removeClass('active');
                $('.cart-container').addClass('display_none');
            });

            $('.store_overlay').unbind('click').bind('click',function(event) {
                $('.store_overlay').removeClass('active');
                $('.cart-container').addClass('display_none');
            });

            $('.abrir_lista').unbind('click').bind('click',function(event) {

                $('.store_overlay').addClass('active');
                $('.cart-container').removeClass('display_none');

                $.ajax({
                    type        : 'get',
                    url         : '{{route('abrir.lista')}}',
                    dataType    : "html",
                    headers     : { 'X-CSRF-Token' : $('meta[name="csrf-token"]').attr('content') },
                    evalScripts : true,
                    element_to_overlay : '.listaproductos',
                    success     : function(response){

                        var json = JSON.parse(response);

                        if(json.login == 1){
                            user_modal();
                            $('.store_overlay').removeClass('active');
                            $('.cart-container').addClass('display_none');
                            return true;
                        }

                        if(modalopen == 1) {
                            $('#verproducto').modal('hide');
                        }

                        $('.listaproductos').html(json.lista);
                        $('.items-agregados').html(json.count).removeClass('display_none');
                        $('.link_to_pay').attr('href',json.href);
                        $('.monto_total').html(json.monto);

                        listeners();

                    },error: function () {

                    }
                });
            });

            $('.comprar').unbind('click').bind('click',function(event) {

                var id  = $(this).data('id');

                $.ajax({
                    type        : 'get',
                    url         : '{{route('agregar.producto')}}',
                    dataType    : "html",
                    evalScripts : true,
                    element_to_overlay : '.btn-despuesdeagregar' + id,
                    headers     : { 'X-CSRF-Token' : $('meta[name="csrf-token"]').attr('content') },
                    data:       {  id: id},
                    success     : function(response){

                        var json = JSON.parse(response);

                        if(json.login == 1){
                            user_modal();
                            return true;
                        }

                        if(modalopen == 1){
                            $('#verproducto').modal('hide');
                        }

                        if($('.btn-despuesdeagregar' + id).length > 0){
                            $('.btn-despuesdeagregar' + id).addClass('display_none');
                            $('.btn-agregado' + id).removeClass('display_none');
                        }

                        if(json.preview){
                            $('.popover-content').html(json.preview);
                            $('.cart-popover').slideDown('slow');
                            cerrarpopup();
                            $('.items-agregados').html(json.count).removeClass('display_none');
                        }
                        listeners();

                    },error:function () {

                    }
                });
            });

            $('.abrirHijos').unbind('click').bind('click', function(event) {
                var nivel = $(this).data('nivel');
                var padre = $(this).data('codinst');

                for(var i = nivel; i < 20; i++)
                    $('.nivel'+i).addClass('display_none');

                $('.hijos'+padre).removeClass('display_none');

                $('html,body').animate({scrollTop : $('.categoria'+padre).offset().top-200}, 1000);
            });

            $('.loading_by_prices').unbind('click').bind('click', function(event) {
                busquedaActual = '';
                $('.input-busqueda').val('');
                if(screen.width > 760) {
                    $('.btn-search').removeClass('ti-close').addClass('ti-search');
                }
                buscarPorPrecios = 1;
                route = '{{route('site')}}';
                $('.remove_by_price').slideDown();
                buscarProductos('loading_by_prices');
            });

            $('.ti-close').unbind('click').bind('click', function(event) {
                busquedaActual = '';
                $('.input-busqueda').val('');
                categoriaActual = '';
                $('.remove_by_category').slideUp();
                marcaActual = '';
                $('.remove_by_marca').slideUp();
                buscarPorPrecios = '';
                $('.remove_by_price').slideUp();
                route = '{{route('site')}}';
                if(screen.width > 760) {
                    $('.btn-search').removeClass('ti-close').addClass('ti-search');
                }
                buscarProductos('');
            });

            $('.remove_by_price').unbind('click').bind('click', function(event) {
                buscarPorPrecios = 0;
                $('.remove_by_price').slideUp();
                buscarProductos('');
            });

            $('.remove_by_category').unbind('click').bind('click', function(event) {
                categoriaActual = ''; marcaActual = '';
                buscarPorPrecios = 0;
                $('.remove_by_category').slideUp();
                buscarProductos('');
            });

            $('.remove_by_marca').unbind('click').bind('click', function(event) {

                $('.remove_by_marca').slideUp();
                buscarProductos('');
            });

            $('.vertodos').unbind('click').bind('click', function(event) {
                vertodos = $(this).data('vertodos');
                route    = origen;
                buscarProductos('');
            });

            $('.ordenprecio').unbind('click').bind('click', function(event) {
                ordenprecio = $(this).data('ordenprecio');
                route       = origen;
                buscarProductos('');
            });



            $('.categoria').unbind('click').bind('click', function(event) {
                busquedaActual = '';
                marcaActual  = '';
                $('.input-busqueda').val('');
                if(screen.width > 760) {
                    $('.btn-search').removeClass('ti-close').addClass('ti-search');
                }
                categoriaActual = $(this).data('codinst');
                route = '{{route('site')}}';
                $('.remove_by_category').slideDown();

                if(menuabierto)
                    $('.navbar-toggler').click();

                buscarProductos('categoria'+categoriaActual);
            });

            $('.marca').unbind('click').bind('click', function(event) {
                busquedaActual = '';
                $('.input-busqueda').val('');
                if(screen.width > 760) {
                    $('.btn-search').removeClass('ti-close').addClass('ti-search');
                }
                marcaActual = $(this).data('marca');
                route = '{{route('site')}}';
                $('.remove_by_marca').slideDown();

                if(menuabierto)
                    $('.navbar-toggler').click();

                buscarProductos('marca'+marcaActual);
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
                        listeners();
                    },error:function () {
                        listeners();
                    }
                });

            });

            $('.paginar').unbind('click').bind('click', function(event) {
                var r = $(this).data('route');
                route = r;
                buscarProductos('');
            });

            $('.change_view').unbind('click').bind('click', function(event) {
                var vista = $(this).data('vista');
                vistaActual = vista;
                buscarProductos('change_view'+vista);
            });
        }

        listeners();

        if(!marcaActual)
            $('.remove_by_marca').slideUp();
       */

        @if((isset($gosearch) and $gosearch != '') or (isset($gocategor) and $gocategor != '') or (isset($noajax) and $noajax == 11 and Auth::user()) )
           //quitar buscarProductos('');
        @endif

        @if(!request()->routeIs('bienvenido')  and isset(auth()->user()->id))
          //quitar  howagregados();
        @endif


    </script>

@include('layouts.vendor-scripts')
    @yield('js-section')

</body>

</html>
