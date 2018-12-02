<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Validator;
use Caffeinated\Shinobi\Models\Role;
use Caffeinated\Shinobi\Models\Permission;
use DB;

use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$year=date("Y");
        //$detalle = DB::select("call dash($year)");
        //$detalle2 = DB::select("call anulaciones_anual($year)");
        //$ro = Role::where('name', 'LIKE', "%".'otel'."%")->get()->first();
        //$ro = $ro->id;
        //$thoteles = DB::select("call count_user_rol($ro)");
        //$thoteles = $thoteles[0]->conteo;
        //if (empty($thoteles)) {
        //    $thoteles = 0;
        //}
        return view('home');//->with("data", $detalle)->with("year", $year)->with("TH", $thoteles)->with("data2",$detalle2);
    }

    public function acerca()
    {
        return view('admin.about');
    }

    public function ayuda()
    {
        return view('admin.help');
    }

    public function descargarmanual()
    {

        if (Auth::user()->isRole('administrador')) {
            $path = public_path('manuales/manual_admin.pdf');
        } elseif (Auth::user()->isRole('hotel')) {
            $path = public_path('manuales/manual_hotel.pdf');
        } elseif (Auth::user()->isRole('intur')) {
            $path = public_path('manuales/manual_intur.pdf');
        } else {
            return back();
        }

        return response()->download($path);
    }

    public function ejemplo()
    {
        $path = public_path('manuales/ejemplo.xlsx');
        return response()->download($path);
    }
    public function listado_pais()
    {
        $path = public_path('manuales/lista_pais.xlsx');
        return response()->download($path);
    }




}
