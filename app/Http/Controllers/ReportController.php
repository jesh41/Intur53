<?php

namespace App\Http\Controllers;


use Auth;
use Illuminate\Http\Request;
use Excel;
use Storage;
use App\User;
use App\Book;
use App\Bookdetail;
use App\Month;
use App\Annulment;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Validator;
use Caffeinated\Shinobi\Models\Role;
use Caffeinated\Shinobi\Models\Permission;
class ReportController extends Controller
{
      public function __construct()
    {
        $this->middleware('auth');
    }


   public function index()
    {
        return view('/reports/Index');
    }

 public function crearPDF($datos,$vistaurl,$tipo)
    {

        $data = $datos;
        $date = date('Y-m-d');
        $view = \View::make($vistaurl, compact('data', 'date'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        
        if($tipo==1){return $pdf->stream('reporte');}
        if($tipo==2){return $pdf->download('reporte.pdf'); }
    }

    public function crear_reporte_porpais($tipo){
      //url
        $year=2017;
     $vistaurl="/reports/report1";
     $detalle=DB::select("call indicador1general(2017)");
     //consulta
    // $detalle=Bookdetail::all();
     //$detalle->Book->where('estado','A')->get();
     //$detalle = Bookdetail::with(['Book' => function ($query) {
    //$query->where('estado','A');
      //}])->get();
     //$detalle=Bookdetail::where('estado','A');
     //$detalle=Bookdetail::all();
     return $this->crearPDF($detalle, $vistaurl,$tipo);
    }



    

}
