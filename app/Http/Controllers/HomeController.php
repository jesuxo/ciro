<?php

namespace App\Http\Controllers;

use App\Models\Promocion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
     //   dd(bcrypt('Cj19883700'));

        $tienda = (isset($request->tienda)) ? $request->tienda : '';
        $vista  = (isset($request->vista) ) ? $request->vista  : '';

        if($tienda != '') {

            $promociones = Promocion::whereRaw("activo = 1 and tienda = '$tienda'")
                ->orderBy('combo', 'desc')  // Primero los que tienen combo = 1
                ->orderBy('id', 'desc')     // Luego por id descendente
                ->get();
            $vista = view('dashboard.partials.promociones', compact('promociones','tienda'))->render();

        }

        Session::put('lang', 'sp');
        Session::save();

        if(Auth::user() and auth()->user()->type == 'admin') {
            return view('index', compact('vista','tienda'));
        }else{
            return view('indexusuario');
        }

    }



    public function lang($locale) {
        if ($locale) {
            App::setLocale($locale);
            Session::put('lang', $locale);
            Session::save();
            return redirect()->back()->with('locale', $locale);
        } else {
            return redirect()->back();
        }
    }
}
