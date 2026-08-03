@if($promo->imagen)
    <div class="d-flex flex-column">
        <div class="item-image">
            <img src="{{asset('img/promociones/th'.$promo->imagen)}}" class="imageth rounded-circle">
            <i class="bi bi-trash delete_promo_imagen cursor_pointer" data-id="{{$promo->id}}" data-url="{{route('promo.destroyimagen', $promo->id)}}" ></i>
        </div>
    </div>
@endif
