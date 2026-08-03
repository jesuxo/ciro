<div class="promoid{{$promo->id}}">
    <div  style="cursor: pointer" class="open_promo email-list-item mb-2"   data-id="{{$promo->id}}">
        <div class="email-list-detail">
            <div class="d-flex">
                <?php
                $file = ($promo->imagen)? asset('img/promociones/'.$promo->imagen) : '';

                if (file_exists(public_path().'/img/promociones/th'.$promo->imagen)) {
                    $file = asset('img/promociones/th'.$promo->imagen);
                }
                ?>

                <img src="{{$file}}" width="60px" style="margin-right: 5px"/>
                <div class="d-flex flex-column ml-2" style="padding-top: 0; margin-top: 0">
                    <span class="from" style="font-weight: 200">{{$promo->descrip}}</span>
                    <p class="msg">Fecha: <span class="text-primary"> {{$promo->created_at->diffForHumans()}} </span> @if($promo->monto > 0) | Precio: <span class="text-primary"> $ {{number_format($promo->monto, 2, ',', '.')}}</span> @endif</p>
                </div>
            </div>
        </div>
    </div>
</div>
