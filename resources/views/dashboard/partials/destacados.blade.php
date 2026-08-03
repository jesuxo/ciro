<div class="d-flex mb-3">
    <h6 class="card-title mb-0" style="flex-grow: 1; margin-top: 7px;">Productos Destacados</h6>
    <a href="{{route('limpiar.destacados')}}" class="" style="font-size: 14px">Limpiar</a>
</div>

<div>
    @foreach($destacados as $prod)
        <div class="email-list-item mb-2 prod_destacado"  data-id="{{$prod->id}}">
            <div class="email-list-detail">
                <div class="d-flex">
                    <div class="text-center img-destacada">
                        @if(isset($prod->imagenes[0]))
                            <img class="rounded-circle avatar-logo mr-2" src="{{asset('img/productos/th'.$prod->imagenes[0]->url)}}" alt="" style="max-height: 60px; margin: auto">
                        @else
                            <img class="rounded-circle avatar-logo mr-2" src="{{asset('img/default.jpg')}}" alt="" style="max-height: 60px; margin: auto">
                        @endif
                    </div>
                    <div class="d-flex flex-column ml-2">
                        <span class="from">{{$prod->descrip1}}</span>
                        <p class="msg">  Ref:<span class="text-primary"> {{$prod->referencia}} </span>|Precio:  <span class="text-primary"> $ {{number_format($prod->precio, 2, ',', '.')}}</span></p>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>