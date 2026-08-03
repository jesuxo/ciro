@extends('layouts.adminMaster')

@section('css-section')
<style>
    .display_products, .card-left{
        height: calc(100vh - 250px) !important;
        overflow: auto !important;
    }

    .paginar_productos{
        border-bottom: none !important;
    }

    .precio{
        text-align: right;
    }

    .display_none{
      display: none !important;
    }

    .cursor-pointer{
        cursor: pointer;
    }

    .faq_content .tab-pane .card .card-header .btn{
        padding: 10px !important;
    }

    .card-body{
        padding: 0px 10px !important;
    }

    .inputs{
        border:none;
    }

    .field-content {
        display: flex;
        align-items: center;
    }

    .field-content div:first-child {
        display: flex;
        justify-content: space-between;
        width: 24%;
        align-items: center;
        font-weight: 200;
    }
    .field-content div:nth-child(2) {
        display: flex;
        justify-content: space-between;
        width: 75%;
        align-items: center;
    }
    .form-control{
        color: #005Eb8 !important;
        min-height: 38px;
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

    .image-content{
        display: flex;
    }

    .item-image{
        position: relative;
    }

    .item-image .ti-close{
        position: absolute;
        right: 0;
        top: 3px;
        color: red;
        font-weight: bold;
        cursor: pointer;
    }

    .card-left {
        box-shadow: 0 0 10px 0 rgba(183,192,206,.2);
        -webkit-box-shadow: 0 0 10px 0 rgba(183,192,206,.2);
        -moz-box-shadow: 0 0 10px 0 rgba(183,192,206,.2);
        -ms-box-shadow: 0 0 10px 0 rgba(183,192,206,.2);
        border: none;
        padding: 1rem;
    }


    .card-left .card-body {
        -webkit-box-flex: 1;
        flex: 1 1 auto;
        padding: 1.5rem;
    }

    .align-items-baseline {
        -webkit-box-align: baseline !important;
        align-items: baseline !important;
    }

    .justify-content-between {
        -webkit-box-pack: justify !important;
        justify-content: space-between !important;
    }

    .card-left .card-title {
        color: #000;
        margin-bottom: 1.2rem;
        text-transform: uppercase;
        font-size: .875rem;
        font-weight: 600;
    }

    .flex-column, .flex-row {
        -webkit-box-direction: normal !important;
    }

    .flex-column {
        -webkit-box-orient: vertical !important;
        flex-direction: column !important;
    }

    .email-list-item .email-list-detail .from {
        color: #71748d !important;
    }

    .email-list-item .email-list-detail .msg {
        font-weight: 200;
        margin: 0;
        color: #71738d;
        font-size: .8rem;
        line-height: 12px;
    }

    .email-list-item {
        font-size: 14px;
        cursor: pointer;
    }

    .rounded-circle {
        border-radius: 5px !important;
    }

    .img-destacada{
        width: 20%;
    }

    .hijo{
        font-size: 12px;
        border-top: 1px solid #f0ebec;
        width: 75%;
    }

</style>
@endsection
@section('content')
    <div class="page_content">

        <section class="faq_area   ">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 pr_50">
                        <div class="card card-left ">
                            <div class="card-body email-content listar_productos" style="min-height: 428px;">
                                <div class="email-list mt-4 listar_destacados">
                                    @include('dashboard.partials.destacados')
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 display_products">
                        <div class="tab-content faq_content" id="myTabContent">
                            <div class="tab-pane fade show active" id="customer-support" aria-labelledby="customer-support-tab" role="tabpanel">
                                <form name="uploadform" enctype="multipart/form-data" role="form" method="post">
                                    <div id="accordion-1">
                                        {!! (isset($vista_prod))? $vista_prod : '' !!}
                                    </div>
                                    <input name="file" id="file" class="inputfile" multiple="multiple" type="file">
                                    <input name="fileimagen" data-promo="1" id="fileimagen" class="inputfile" multiple="multiple" type="file">
                                    <input name="fileimagenhome" data-promo="1" id="fileimagenhome" class="inputfile" multiple="multiple" type="file">
                                </form>
                                <div class="card text-center paginar_productos cursor_pointer  {{(count($productos) > 0)? '' : 'display_none'}}" >
                                    <img src="{{asset('img/arrow-down.png')}}" width="40px" height="40px" style="cursor: pointer; margin: auto" />
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>


        <section class="faq_area   mt-4 mb-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 pr_50">
                        <div class="card card-left ">
                            <div class="card-body email-content" style="min-height: 428px;">
                                <div class="email-list mt-4">
                                    <div class="search-form input-group mb-4" style="max-width: 100%; padding: 0"  >
                                        <input type="text" style="font-weight: 200" autocomplete="off" id="busqueda_instancias" name="instancias" value="" class="form-control instancias" placeholder="Buscar instancia">
                                        <span class="input-group-addon">
                                            <button type="button"   style="opacity: 0 !important;">
                                                <i class="ti-search cursor_pointer btn-search"></i>
                                            </button>
                                        </span>
                                    </div>

                                    @if(isset($instancias[0]))
                                        <div class="d-flex mb-3">
                                            <h6 class="card-title mb-0" style="flex-grow: 1; margin-top: 7px;">Instancias Destacadas</h6>
                                        </div>
                                    @endif

                                    <div class="instancias_listadas">
                                        @include('dashboard.partials.instancias')
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 view_instancia">

                    </div>

                </div>
            </div>
        </section>

    </div>

@endsection

@section('js-section')

@endsection
