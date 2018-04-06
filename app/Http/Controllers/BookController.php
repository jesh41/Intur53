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
use App\Country;
use Carbon\Carbon;
use App\Sex;
use App\Reason;
use DB;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Validator;
use Caffeinated\Shinobi\Models\Role;
use Caffeinated\Shinobi\Models\Permission;

class BookController extends Controller
{
    //
      public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        $i = 0;
        $usuario = Auth::user()->id;
        $mes_actual = date('m');
        $anio_actual = date('Y');
        $anio_anterior = $anio_actual - 1;
        $valida_anio_actual = DB::select("call validacion_mes($anio_actual,$usuario,$mes_actual)");
        $valida_anio_anterior = DB::select("call validacion_anio($anio_anterior,$usuario,$mes_actual)");
        //valido si es esta en el año actual, solo muestre meses menores al mes actual
        if (! empty($valida_anio_actual)) {
            $anio[$i] = date('Y');
            $i++;
        }
        if (! empty($valida_anio_anterior)) {
            $anio[$i] = date('Y') - 1;
            $i++;
        }



        if (Auth::user()->isRole('administrador')) {
            $books = Book::all();

        } elseif (Auth::user()->isRole('hotel'))
        {
            $id = Auth::user()->id;
            $books = Book::where('user_id', $id)->where('estado', 'A')->get();

        } elseif (Auth::user()->isRole('intur')) {
            $books = Book::all();
        }

        return view('/book/books')->with("books", $books)->with("anio", $anio);
    }

    public function anulados()
    {
        if (Auth::user()->isRole('hotel')) {
            $books = Book::where('user_id', Auth::user()->id)->where('estado', 'U');
        }

        return view('/book/book-anulados')->with("books", $books);
    }

public function anular_libro(Request $request){
    $idbook = $request->input("id_book");
    $user = Auth::user()->id;
    $consulta = DB::select("call ultimo_libro($user)");
    $horas = DB::select("call dias_ultimo_libro($user)");
    $valido = $consulta[0];
    $hora = $horas[0];
    if (Auth::user()->isRole('hotel') && ! empty($consulta)) {

        if ($valido->id == $idbook) {
            if ($hora->horas < 24) {
                $book = Book::find($idbook);
                $book->estado = 'U';
                if ($book->save()) {
                    $annnulment = new Annulment;
                    $annnulment->book_id = $idbook;
                    $annnulment->observacion = $request->input("observacion");
                    $annnulment->elaborado = Auth::user()->name;
                    $annnulment->save();
                    session()->put('success', 'LIBRO ANULADO CORRECTAMENTE');

                    return back();
                } else {
                    session()->put('error', 'HUBO UN ERROR EN LA ANULACION LLAME AL ADMINISTRADOR.');

                    return back();
                }
            } else {
                session()->put('warning', 'NO PUEDE ANULAR LIBROS DESPUES DE 1 DIA.');

                return back();

            }
        } else {

            session()->put('warning', 'NO PUEDE ANULAR LIBROS VIEJOS.');

            return back();
        }
    }

    if (Auth::user()->isRole('administrador')) {
        $book = Book::find($idbook);
        $book->estado = 'U';
        if ($book->save()) {
            $annnulment = new Annulment;
            $annnulment->book_id = $idbook;
            $annnulment->observacion = $request->input("observacion");
            $annnulment->elaborado = Auth::user()->name;
            $annnulment->save();
            session()->put('success', 'LIBRO ANULADO CORRECTAMENTE');

            return back();
        } else {
            session()->put('error', 'HUBO UN ERROR EN LA ANULACION LLAME AL ADMINISTRADOR.');

            return back();
        }
    }

    if (Auth::user()->isRole('intur')) {
        session()->put('error', 'HUBO UN ERROR EN LA ANULACION LLAME AL ADMINISTRADOR.');

        return back();
    }
}

    public function cargar_libros(Request $request)
	{
       $archivo = $request->file('archivo');      
       $extension=$archivo->getClientOriginalExtension();
        //carga de catalogos
        $catpais = Country::all()->toArray();
        $catsex = Sex::all()->toArray();
        $catreason = Reason::all()->toArray();
        $columnapais = array_column($catpais, 'country');
        $columnamotivo = array_column($catreason, 'motivo');
        $columnasex = array_column($catsex, 'sexo');
        $ultimo = Book::all()->pluck('id')->last();
        if (is_null($ultimo)) {
            $ultimo = 0;
        }

        if ($extension == 'xlsx' or $extension == 'xls')//valido el tipo de archivo
        {
            $autor = Auth::user()->id;//id del login actual
            $nombre_original = 'user'.$autor.'.'.$extension;//renombra el archivo subido
            $r1 = Storage::disk('archivos')->put($nombre_original, \File::get($archivo));//guardar en el disco
            $ruta = storage_path('archivos')."/".$nombre_original;//ubicaion donde se guardo

            if ($r1) {
                //data esta leyendo 3 filas null, validacion uno localiza hoja intur
                $data = Excel::selectSheets('INTUR')->load($ruta, function ($reader) {
                })->get();
                if (! empty($data) && $data->count()) {
                    $excelheader = $data->first()->keys()->toArray();
                    $encabezados = [
                        "identificacion",
                        "nombre",
                        "pais",
                        "sexo",
                        "fentrada",
                        "fsalida",
                        "ndormidas",
                        "motivo",
                    ];//validacon 2 compara encabezados
                    if ($encabezados == $excelheader) {
                        $conteo = $data->count();
                        $mensaje = null;
                        $mensaje5 = null;
                        $mensaje3 = null;
                        $mensaje4 = null;
                        $t = 0;
                        $d = 0;
                        //foreach ($data->toArray() as $row) {
                        //      if (! empty($row)) {//validacion 3, valores nulos en fila
                        //          if (empty($row['identificacion']) || (empty($row['nombre'])) || (empty($row['pais'])) || (empty($row['sexo'])) || (empty($row['fentrada'])) || (empty($row['fsalida'])) || (empty($row['ndormidas'])) || (empty($row['motivo']))) {
                        //             $c2[] = (string) $t + 2;
                        //              $cadena = implode(',', $c2);
                        //             $mensaje = "EXISTEN VALORES NULOS, REVISAR FILA $cadena";
                        //              session()->put('warning', $mensaje);
                        //         }
                        //         $t++;
                        //      }
                        // }
                        if (empty($mensaje)) {
                            foreach ($data->toArray() as $row) {
                                if (! empty($row)) {


                                    $paisformat = ucwords(trim($row['pais']));//limpiamos espacio derecha e izquierda
                                    $sexoformat = strtoupper(preg_replace('[\s+]', "", $row['sexo']));//eliminamos los espacios en toda la cadena
                                    $motivoformat = ucwords(preg_replace('[\s+]', "", $row['motivo']));//eliminamos los espacios en toda la cadena

                                    $paisid = array_search($paisformat, $columnapais);
                                    $sexoid = array_search($sexoformat, $columnasex);
                                    $motivoid = array_search($motivoformat, $columnamotivo);

                                    //$pais = Country::where('country', 'LIKE', '%'.$paisformat.'%')->get()->first();
                                    //$sexo = Sex::where('sexo', 'LIKE', '%'.$sexoformat.'%')->get()->first();
                                    //$motivo = Reason::where('motivo', 'LIKE', '%'.$motivoformat.'%')->get()->first();
                                    $fechaentrada = str_replace('/', '-', $row['fentrada']);
                                    $fechaentrada = Carbon::parse($fechaentrada)->format('Y-m-d');
                                    $fechasalida = str_replace('/', '-', $row['fsalida']);
                                    $fechasalida = Carbon::parse($fechasalida)->format('Y-m-d');

                                    if ($paisid === false) {//validacion sobre pais
                                        $c3[] = (string) $d + 2;
                                        $cadena3 = implode(',', $c3);
                                        $mensaje3 = " PAIS FILA $cadena3";
                                    }
                                    if ($sexoid === false) {//validacion sobre sexo
                                        $c4[] = (string) $d + 2;
                                        $cadena4 = implode(',', $c4);
                                        $mensaje4 = " SEXO FILA $cadena4";
                                    }
                                    if ($motivoid === false) {//validacion sobre motivo
                                        $c5[] = (string) $d + 2;
                                        $cadena5 = implode(',', $c5);
                                        $mensaje5 = " MOTIVO FILA $cadena5";
                                    }
                                    if ($motivoid == true and $sexoid == true and $paisid == true) {//! is_null($motivo) and ! is_null($sexo) and ! is_null($pais)) {
                                        $FilasArray[] = [
                                            'Identificacion' => $row['identificacion'],
                                            'Nombre' => $row['nombre'],
                                            'pais_id' => $paisid + 1,// $pais->id,
                                            'Sexo_id' => $sexoid + 1,//$sexo->id,
                                            'Fechaentrada' => $fechaentrada,
                                            'Fechasalida' => $fechasalida,
                                            'Noches' => $row['ndormidas'],
                                            'motivo_id' => $motivoid + 1,//$motivo->id,
                                            'book_id' => $ultimo + 1,
                                            'created_at' => date('Y-m-d H:i:s'),
                                        ];
                                    }
                                    $d++;
                                }

                            }
                            if (! empty($c3) || ! empty($c4) || ! empty($c5)) {
                                $combo = "Revisar $mensaje3"."$mensaje4"."$mensaje5";
                                session()->put('warning', $combo);
                            } else {
                                //mensaje
                                session()->put('success', 'LIBRO CARGADO');
                                //aca guardar
                                $libro = new Book;
                                $libro->Mes_id = $request->input("mes");
                                $libro->anio = $request->input("anio");;
                                $libro->estado = 'A';
                                $libro->Observacion = $request->input("observacion");
                                $libro->FechaElaborado = date("Y-m-d");
                                $libro->user_id = $autor;
                                $libro->save();

                                Bookdetail::insert($FilasArray);
                            }
                        }
                    } else {
                        session()->put('error', 'REVISAR ENCABEZADOS, NO CUMPLE EL FORMATO');
                    }
                } else {
                    session()->put('error', 'NO EXISTE HOJA INTUR');
                }


            }
                       else
                       {
                           session()->put('error', 'ERROR NO SE PUDO CARGAR EL ARCHIVO EN EL SERVIDOR');
                       }
        }
        else
        {
            session()->put('warning', 'ERROR Revisar que sea formato excel');
        }
        return back();
      }

    public function descargar_libro($id){
    $bo = book::find($id);
    $name = 'Huespedes'.$bo->Anio.$bo->month->mes;
    Excel::create($name, function ($excel) use ($id) {
            $excel->sheet('Huespedes', function($sheet) use($id) {
                $sheet->row(1,['Identificacion','Nombre','Pais','Sexo','Fechaentrada','Fechasalida','Noches','Motivo']);
                $datos =Bookdetail::where('book_id',$id)->get();
                //    $data=[];
                foreach ($datos as $d) {
                  $row=[];
                  $row[0]=$d->Identificacion;
                  $row[1]=$d->Nombre;
                  $row[2]=$d->pais->country;
                  $row[3]=$d->Sexo->sexo;
                  $row[4]=$d->FechaEntrada;
                  $row[5]=$d->FechaSalida;
                  $row[6]=$d->Noches;
                  $row[7]=$d->motivo->motivo;
                  $sheet->appendrow($row);
                }
                $sheet->setOrientation('landscape');
            });
        })->download('xls');
   }




}
