@foreach($imagenes as $image)
    <div class="d-flex flex-column">
        <div class="item-image">
            <img src="{{asset('img/productos/th'.$image->url)}}" class="imageth rounded-circle">
            <i class="ti-close delete_image cursor_pointer" data-id="{{$image->producto['id']}}" data-url="{{route('imagenes.destroy', $image->id)}}" ></i>
        </div>
        <div class=" text-center  {{($image->principal)? 'text-primary': 'text-muted'}}  set_imagen" style="cursor: pointer;" data-id="{{$image->producto['id']}}"  data-url="{{route('imagenes.edit', $image->id)}}" >
            Principal
        </div>
    </div>
@endforeach