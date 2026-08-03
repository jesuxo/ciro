@if($promo->imagen_home)
    <div class="d-flex flex-column">
        <div class="item-image">
            <img src="{{asset('img/promociones/'.$promo->imagen_home)}}" class="imageth rounded-circle">
            <i class="ti-close delete_promo_imagen_home cursor_pointer" data-id="{{$promo->id}}" data-url="{{route('promo.destroyimagenhome', $promo->id)}}" ></i>
        </div>
    </div>
@endif