
<div class="search-form input-group mb-4" style="max-width: 100%; padding: 0"  >
    <input type="text" autocomplete="off"  style="font-weight: 200" name="search_compra" value="" class="form-control search-field search_compra" placeholder="Buscar compra/cliente">
    <span class="input-group-addon">
        <button type="button"   style="opacity: 0 !important;">
            <i class="ti-search cursor_pointer btn-search-compra"></i>
        </button>
    </span>
    <input type="hidden" name="post_type"  data-unset="1"   value="product">
</div>

<div>
    @if(isset($compras[0]))
        @foreach($compras as $compra)
            <div class="email-list-item mb-2 open_compra"
                 data-url="{{route('compras.edit', $compra->id)}}"
                 data-id="{{$compra->id}}">
                <div class="email-list-detail">
                    <div class="d-flex">
                        <div class="d-flex flex-column ml-2">
                            <span class="from" style="font-weight: 200">{{$compra->usuario->name}} - {{$compra->usuario->email}}</span>
                            <p class="msg"> Compra <span class="text-primary"> #{{$compra->id}} </span>  @if($compra->monto > 0) - Monto: <span class="text-primary"> $ {{number_format($compra->monto, 2, ',', '.')}}</span>  @endif -   <span class="text-primary">   {{$compra->created_at->diffForHumans()}} </span> </p>
                        </div>
                    </div>
                </div>
                <hr style="opacity: 0.3">
            </div>
        @endforeach
    @else
        <div class="email-list-item mb-2">
            <div class="email-list-detail">
                <div class="d-flex">
                    <div class="d-flex flex-column ml-2">
                        <span class="from" style="font-weight: 200">No hay resultados encontrados</span>
                        <p class="msg"> Busqueda: <span class="text-primary"> {{$busqueda}} </span> </p>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>