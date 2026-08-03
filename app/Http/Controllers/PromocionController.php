<?php

namespace App\Http\Controllers;

use App\Models\Promocion;
use Carbon\Carbon;
use Gumlet\ImageResize;
use Illuminate\Http\Request;

class PromocionController extends Controller
{
    public function index()
    {
        $promociones = Promocion::with('promoinsta')->where('activo',1)->orderBy('id','desc')->get();
        $vista = view('dashboard.partials.promociones', compact('promociones'))->render();

        return response()->json(['view' => $vista], 200);
    }

    public function limpiar()
    {
        if(isset(auth()->user()->type) and auth()->user()->type == 'admin'){
            $promos = Promocion::get();

            if(isset($promos[0])){
                foreach ($promos as $promo){
                    if(isset($promo->id)){
                        if($promo->imagen){
                            @unlink(public_path().'/img/promociones/th'.$promo->imagen);
                            @unlink(public_path().'/img/promociones/ogc'.$promo->imagen);
                            @unlink(public_path().'/img/promociones/'.$promo->imagen);
                        }
                        if($promo->imagen_home){
                            @unlink(public_path().'/img/promociones/'.$promo->imagen_home);
                        }
                        $promo->delete();
                    }
                }
            }
        }
        return redirect()->route('dashboard');
    }

    public function create(Request $request)
    {
        $tienda = $request->tienda;

        $promo = new Promocion();
        $promo->descrip = "Debe actualizar este titulo";
        $promo->tienda  = $tienda;
        $promo->save();
        return redirect()->route('dashboard',['tienda'=>$tienda]);
    }

    public function store(Request $request)
    {
        $sugeridos = $request->sugeridos;
        $last = 0;
        $sugeridos = json_decode($sugeridos);

        if(isset($sugeridos[0])){
            foreach ($sugeridos as $sug){
                $last = $sug->id;
                $sugerido = Promocion::find($last);

                if(!isset($sugerido->id))
                    $sugerido = new Promocion();

                $sugerido->id      = $sug->id;
                $sugerido->monto   = $sug->monto;
                $sugerido->descrip = $sug->nombre;
                $sugerido->codprod = $sug->codprod;
                $sugerido->save();
            }
        }

        return response()->json(['success'=>'success', 'updated' => 1], 200);
    }

    public function eliminar(Request $request)
    {
        $sugeridos = $request->sugeridos;
        $last = 0;
        $sugeridos = json_decode($sugeridos);

        try{
            if(isset($sugeridos[0])){
                foreach ($sugeridos as $sug){
                    $last = $sug->id;
                    $promo = Promocion::find($last);

                    if(isset($promo->id)){
                        if($promo->imagen){
                            @unlink(public_path().'/img/promociones/'.$promo->imagen);
                        }
                        if($promo->imagen_home){
                            @unlink(public_path().'/img/promociones/'.$promo->imagen_home);
                        }
                        $promo->delete();
                    }
                }
            }
            return response()->json(['success'=>'success', 'updated' => 1], 200);
        }catch (\Exception $e){
            return response()->json(['error'=>'error'], 304);
        }
    }

    public function imagen(Request $request, $id)
    {
        $allowed  = array('gif', 'png', 'jpg', 'jpeg', 'bmp');
        $status   = 200;
        $success  = 'success';
        $count    = 0;

        $promo = Promocion::find($id);

        foreach ($request->files as $file){
            $count++;
            $name = $file->getClientOriginalName();
            $ext  = pathinfo($name, PATHINFO_EXTENSION);

            if( in_array($ext, $allowed) ) {
                $rand = rand(0, 1000);
                $name = 'promoimg-'.$rand.'_'.$id.'_'.$name;
                $promo->imagen = $name;
                $file->move(public_path().'/img/promociones', $name);

                $image = new ImageResize(public_path().'/img/promociones/'.$name);
                $image->resizeToBestFit(270, 320);
                $image->save(public_path().'/img/promociones/th'.$name);

                $image = new ImageResize(public_path().'/img/promociones/'.$name);
                $image->resizeToBestFit(200, 200);
                $image->save(public_path().'/img/promociones/ogc'.$name);

                $image = new ImageResize(public_path().'/img/promociones/'.$name);
                $image->resizeToBestFit(480, 853);
                $image->save(public_path().'/img/promociones/'.$name);

                $promo->pendiente = 0;
                $promo->save();
                $success = 'success';
            }else{
                $status = 300;
                $success = 'error';
            }
        }

        $view = view('dashboard.partials.promo_imagen', compact('promo'))->render();
        return response()->json([$success => $success, 'status' => $status, 'view' => $view], $status);
    }

    public function imagenhome(Request $request,$id)
    {
        $allowed  = array('gif', 'png', 'jpg', 'jpeg', 'bmp');
        $status   = 200;
        $success  = 'success';
        $count    = 0;

        $promo = Promocion::find($id);

        foreach ($request->files as $file){
            $count++;
            $name = $file->getClientOriginalName();
            $ext  = pathinfo($name, PATHINFO_EXTENSION);

            if( in_array($ext, $allowed) ) {
                $rand = rand(0, 1000);
                $name = 'primghom-'.$rand.'_'.$id.'_'.$name;
                $promo->imagen_home = $name;
                $file->move(public_path().'/img/promociones', $name);

                $image = new ImageResize(public_path().'/img/promociones/'.$name);
                $image->resizeToBestFit(870, 500);
                $image->save(public_path().'/img/promociones/'.$name);

                $promo->save();
                $success = 'success';
            }else{
                $status = 300;
                $success = 'error';
            }
        }

        $view = view('dashboard.partials.promo_imagen_home', compact('promo'))->render();
        return response()->json([$success => $success, 'status' => $status, 'view' => $view], $status);
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $promo = Promocion::find($id);

        if(!$promo) {
            return response()->json(['error' => 'Promoción no encontrada'], 404);
        }

        $field = $request->n;
        $value = $request->v;

        // Manejar campos especiales
        if($field == 'destacada') {
            $promo->destacada_at = Carbon::now();
        }

        $promo->$field = $value;
        $promo->pendiente = 0;
        $promo->save();

        return response()->json(['success' => true]);
    }

    public function open(Request $request, $id)
    {
        $promo = Promocion::find($id);

        if(!$promo) {
            return response()->json(['error' => 'Promoción no encontrada'], 404);
        }

        return view('dashboard.partials.promo_edit', compact('promo'))->render();
    }

    public function promoid(Request $request)
    {
        $id = $request->id;
        $promo = Promocion::find($id);
        $vista = '';

        if(isset($promo)) {
            $vista = view('dashboard.partials.promoid', compact('promo'))->render();
        }

        return $vista;
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        $promo = Promocion::find($id);

        if(isset($promo->id)){
            if($promo->imagen){
                @unlink(public_path().'/img/promociones/'.$promo->imagen);
                if (file_exists(public_path().'/img/promociones/th'.$promo->imagen)) {
                    @unlink(public_path().'/img/promociones/th'.$promo->imagen);
                }
                if (file_exists(public_path().'/img/promociones/ogc'.$promo->imagen)) {
                    @unlink(public_path().'/img/promociones/ogc'.$promo->imagen);
                }
            }
            if($promo->imagen_home){
                @unlink(public_path().'/img/promociones/'.$promo->imagen_home);
            }
            $promo->delete();
        }

        return response()->json(['success' => 'success'], 200);
    }

    public function destroyimagen($id)
    {
        $promo = Promocion::find($id);

        if(isset($promo->id)){
            if($promo->imagen){
                @unlink(public_path().'/img/promociones/'.$promo->imagen);
                if (file_exists(public_path().'/img/promociones/th'.$promo->imagen)) {
                    @unlink(public_path().'/img/promociones/th'.$promo->imagen);
                }
                if (file_exists(public_path().'/img/promociones/ogc'.$promo->imagen)) {
                    @unlink(public_path().'/img/promociones/ogc'.$promo->imagen);
                }
            }
            $promo->imagen = '';
            $promo->save();
        }

        return response()->json(['success' => 'success'], 200);
    }

    public function destroyimagenhome($id)
    {
        $promo = Promocion::find($id);

        if(isset($promo->id)){
            if($promo->imagen_home){
                @unlink(public_path().'/img/promociones/'.$promo->imagen_home);
            }
            $promo->imagen_home = '';
            $promo->save();
        }

        return response()->json(['success' => 'success'], 200);
    }
}
