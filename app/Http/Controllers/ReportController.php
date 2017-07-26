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

    public function grafica_por_pais()
    {
        $viewer = DB::select("call indicador1general(2017)");
        $viewer = array_map(function ($viewer) {
            return (array) $viewer;
        }, $viewer);
        $nacionales = array_column($viewer, 'Nacionales');
        $extranjeros = array_column($viewer, 'Extranjeros');

        return view('/reports/report1grafica')->with('viewer', json_encode($extranjeros, JSON_NUMERIC_CHECK))->with('click', json_encode($nacionales, JSON_NUMERIC_CHECK));
    }

    public function grafica_por_sexo()
    {
        $viewer = DB::select("call indicador2(2017)");
        $viewer = array_map(function ($viewer) {
            return (array) $viewer;
        }, $viewer);
        $mujer = array_column($viewer, 'Femenino');
        $hombre = array_column($viewer, 'Masculino');

        return view('/reports/report2grafica')->with('viewer', json_encode($mujer, JSON_NUMERIC_CHECK))->with('click', json_encode($hombre, JSON_NUMERIC_CHECK));
    }

    public function grafica_por_motivo()
    {
        $viewer = DB::select("call indicador3(2017)");
        $viewer = array_map(function ($viewer) {
            return (array) $viewer;
        }, $viewer);
        $turismo = array_column($viewer, 'Turismo');
        $congresos = array_column($viewer, 'Congresos');
        $negocios = array_column($viewer, 'Negocios');
        $otros = array_column($viewer, 'Otros');

        return view('/reports/report3grafica')->with('tu', json_encode($turismo, JSON_NUMERIC_CHECK))->with('co', json_encode($congresos, JSON_NUMERIC_CHECK))->with('ne', json_encode($negocios, JSON_NUMERIC_CHECK))->with('ot', json_encode($otros, JSON_NUMERIC_CHECK));
    }

    public function grafica_por_estadia()
    {
        $viewer = DB::select("call indicador4(2017)");
        $viewer = array_map(function ($viewer) {
            return (array) $viewer;
        }, $viewer);
        $extranjero = array_column($viewer, 'estadiaext');
        $nacional = array_column($viewer, 'estadianac');
        $general = array_column($viewer, 'pro_general');

        return view('/reports/report4grafica')->with('EX', json_encode($extranjero, JSON_NUMERIC_CHECK))->with('NA', json_encode($nacional, JSON_NUMERIC_CHECK))->with('GE', json_encode($general, JSON_NUMERIC_CHECK));
    }
}
