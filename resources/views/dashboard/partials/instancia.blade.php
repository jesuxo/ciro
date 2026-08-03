<div class="field-content mb-3">
    <div class="mr-3">Nombre:</div>
    <div >
        <input type="text" value="{{ucfirst($instancia->descrip)}}" style="font-weight: 200" class="form-control form-input form-control-rounded" data-instancia="1" id="descrip" name="descrip" data-url="{{route('instancias.update', $instancia->id)}}" placeholder="Descripcion o nombre de instancia" >
    </div>
</div>
<div class="field-content mb-3">
    <div class="mr-3">Background color:</div>
    <div >
        <input type="text" value="{{ucfirst($instancia->background)}}" style="font-weight: 200" class="form-control form-input form-control-rounded" data-instancia="1" id="background" name="background" data-url="{{route('instancias.update', $instancia->id)}}" placeholder="Hex color code " >
    </div>
</div>
<div class="field-content mb-3">
    <div class="mr-3">Destacada?</div>
    <div>
        <input type="checkbox" name="destacada" {{($instancia->destacada)? 'checked': ''}} style="font-weight: 200" value="1" id="destacada" data-instancia="1"  data-url="{{route('instancias.update', $instancia->id)}}" >
    </div>
</div>