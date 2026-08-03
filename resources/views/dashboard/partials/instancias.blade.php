@foreach($instancias as $inst)
    <div class="email-list-item mb-2 ver_instancia"  data-url="{{route('instancias.edit', $inst->id)}}" data-id="{{$inst->id}}">
        <div class="email-list-detail">
            <div class="d-flex">
                <div class="text-center img-destacada">
                    @if(isset($inst->imagenes[0]))
                        <img class="rounded-circle avatar-logo mr-2" src="{{asset('img/instancias/th'.$inst->imagenes[0]->url)}}" alt="" style="max-height: 60px; margin: auto">
                    @else
                        <img class="rounded-circle avatar-logo mr-2" src="{{asset('img/default.jpg')}}" alt="" style="max-height: 60px; margin: auto">
                    @endif
                </div>
                <div class="d-flex flex-column ml-2">
                    <span class="from">{{$inst->descrip}}</span>
                    @if($inst->destacada)
                        <div class="d-flex"><i class="ti-check-box text-primary bold" style="margin-top: 5px"></i>  <span class="ml-2">Destacada</span></div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endforeach