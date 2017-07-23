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
use View;
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

    public function crearPDF($datos, $vistaurl, $tipo)
    {

        $data = $datos;
        $date = date('Y-m-d');
        $view = \View::make($vistaurl, compact('data', 'date'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);

        if ($tipo == 1) {
            return $pdf->stream('reporte');
        }
        if ($tipo == 2) {
            return $pdf->download('reporte.pdf');
        }
    }

    public function crear_reporte_porpais($tipo)
    {
        //falta capturar y mandar el parametro
        $year = 2017;
        $vistaurl = "/reports/report1";
        $detalle = DB::select("call indicador1general(2017)");

        return $this->crearPDF($detalle, $vistaurl, $tipo);
    }

    public function crear_reporte_por_sexo($tipo)
    {
        //falta capturar y mandar el parametro
        $year = 2017;
        $vistaurl = "/reports/report2";
        $detalle = DB::select("call indicador2(2017)");

        return $this->crearPDF($detalle, $vistaurl, $tipo);
    }

    public function crear_reporte_por_region($tipo)
    {
        //falta capturar y mandar el parametro
        $year = 2017;
        $vistaurl = "/reports/report3";
        $detalle = DB::select("call indicador3(2017)");

        return $this->crearPDF($detalle, $vistaurl, $tipo);
    }

    public function crear_reporte_por_estadia($tipo)
    {
        //falta capturar y mandar el parametro
        $year = 2017;
        $vistaurl = "/reports/report4";
        $detalle = DB::select("call indicador4(2017)");

        return $this->crearPDF($detalle, $vistaurl, $tipo);
    }

    public function crear_grafica_porpais()
    {
        $viewer = DB::select("call indicador1general(2017)");

        $viewer = array_map(function ($viewer) {
            return (array) $viewer;
        }, $viewer);

        $nacionales = array_column($viewer, 'Nacionales');

        //$click = DB::select("call grafica2(2017)")->get();
        $extranjeros = array_column($viewer, 'Extranjeros');

        return view('/reports/report1grafica')->with('viewer', json_encode($extranjeros, JSON_NUMERIC_CHECK))->with('click', json_encode($nacionales, JSON_NUMERIC_CHECK));
    }
}
