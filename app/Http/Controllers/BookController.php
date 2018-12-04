<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use Excel;
use Storage;
use File;
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
        $anio[] = 0;
        $i = 0;
        $usuario = Auth::user()->id;
        $mes_actual = date('m');
        $anio_actual = date('Y');
      //  $anio_anterior = $anio_actual - 1;
        $valida_anio_actual = DB::select("call validacion_mes($anio_actual,$usuario,$mes_actual)");
       // $valida_anio_anterior = DB::select("call validacion_anio($anio_anterior,$usuario,$mes_actual)");
        //valido si es esta en el año actual, solo muestre meses menores al mes actual
        if (! empty($valida_anio_actual)) {
            $anio[$i] = date('Y');
            $i++;
        }
        //if (! empty($valida_anio_anterior)) {
          //  $anio[$i] = date('Y') - 1;
           // $i++;
        //}

        if (Auth::user()->isRole('administrador')) {
           // $books = Book::all();
            $books = Book::where('estado', 'A')->get();
        } elseif (Auth::user()->isRole('hotel')) {
            $id = Auth::user()->id;
            $books = Book::where('user_id', $id)->where('estado', 'A')->get();
        } elseif (Auth::user()->isRole('intur')) {
            $books = Book::where('estado', 'A')->get();
        }

        return view('/book/books')->with("books", $books)->with("anio", $anio);
    }

    public function anulados()
    {
        if (Auth::user()->isRole('hotel')) {
            //$id = Auth::user()->id;
            //$books = Book::where('user_id', $id)->where('estado', 'U')->get();
            $name=Auth::user()->name;
            $anulados = Annulment::where('Elaborado',$name)->get();
        }

        return view('/book/book-anulados')->with("anulados", $anulados);
    }

    public function anular_libro(Request $request)
    {
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

//validar registros
    public function validar_registros($dato)
    {

        $reglas = [
           // 'identificacion' => 'required',
            'nombre' => 'required',
            'pais' => 'required',
            'sexo' => 'required',
            'fentrada' => 'required|date',
            'fsalida' => 'required|date',
            'ndormidas' => 'required|numeric|min:0',
            'motivo' => 'required|string',
        ];
        $mensajes = [
           // 'identificacion.required' => 'Ingresar identificacion es obligatorio',
            'nombre.required' => 'Ingresar nombre es obligatorio',
            'pais.required' => 'Ingresar pais es obligatorio',
            'sexo.required' => 'Ingresar sexo es obligatorio',
            'fentrada.required' => 'Ingresar fentrada es obligatorio',
            'fentrada.date' => 'Ingresar fentrada formato fecha',
            'fsalida.required' => 'Ingresar fsalida es obligatorio',
            'fsalida.date' => 'Ingresar fsalida formato fecha',
            'ndormidas.required' => 'Ingresar ndormidas es obligatorio',
            'ndormidas.numeric' => 'Ingresar ndormidas formato numerico',
            'ndormidas.min' => 'Ingresar ndormidas minimo 0',
            'motivo.required' => 'Ingresar motivo es obligatorio',
            'motivo.string' => 'Ingresar motivo formato string',
        ];
        $validacion = Validator::make($dato, $reglas, $mensajes);
        if ($validacion->fails()) {
            $errores = $validacion->errors();
        }

        // return $validacion->fails();
        return [
            "flag" => $validacion->fails(),
            "Message" => ($validacion->fails()) ? $validacion->errors() : "Sin Errores",
        ];
    }

//Funcion validar encabezado excel
    public function validar_encabezado($datos)
    {
        $bandera_enca = false;
        $encabezados = ["identificacion", "nombre", "pais", "sexo", "fentrada", "fsalida", "ndormidas", "motivo",];
        if ($encabezados == $datos) {
            $bandera_enca = true;
        }

        return $bandera_enca;
    }

    public function cargar_libros(Request $request)
    {
        $archivo = $request->file('archivo');
        $extension = $archivo->getClientOriginalExtension();
        if ($extension == 'xlsx' or $extension == 'xls')//valido el tipo de archivo
        {
            //carga de catalogos
            $ventrada=false;
            $vsalida=false;
            $fechamayor=false;
            $mes=$request->input("mes");
            $catpais = Country::all()->toArray();
            $catsex = Sex::all()->toArray();
            $catreason = Reason::all()->toArray();
            $columnapais = array_column($catpais, 'country');
            $columnaalias = array_column($catpais, 'alias');
            $columnamotivo = array_column($catreason, 'motivo');
            $columnasex = array_column($catsex, 'sexo');
            $ultimo = Book::all()->pluck('id')->last();
            if (is_null($ultimo)) {
                $ultimo = 0;
            }
            $autor = ucwords(trim(Auth::user()->name));//id del login actual
            $nombre_original = 'usuario'.$autor.'.'.$extension;//renombra el archivo subido
            $r1 = Storage::disk('archivos')->put($nombre_original, \File::get($archivo));//guardar en el disco
            $ruta = storage_path('archivos')."/".$nombre_original;//ubicaion donde se guardo
            $idfila = 0;
            $mensaje = null;
            $idarray = 0;
            if ($r1) {
                //data esta leyendo 3 filas null, validacion uno localiza hoja intur
                $data = Excel::selectSheets('INTUR')->load($ruta, function ($reader) {
                })->get();
                if (! empty($data) && $data->count()) {
                    $excelheader = $data->first()->keys()->toArray();
                    $bandera_enc = $this->validar_encabezado($excelheader);
                    if ($bandera_enc == true) {
                        foreach ($data->toArray() as $row) {
                            if (! empty($row)) {
                                $bandera_datos = $this->validar_registros($row);
                                if ($bandera_datos['flag'] == false) {
                                    $paisformat = ucwords(trim($row['pais']));//limpiamos espacio derecha e izquierda
                                    $sexoformat = strtoupper(preg_replace('[\s+]', "", $row['sexo']));//eliminamos los espacios en toda la cadena
                                    $motivoformat = ucwords(preg_replace('[\s+]', "", $row['motivo']));//eliminamos los espacios en toda la cadena
                                    $paisid = array_search($paisformat, $columnapais);
                                    if ($paisid ===  false)
                                    {
                                        $paisid = array_search($paisformat, $columnaalias);
                                    }
                                    $sexoid = array_search($sexoformat, $columnasex);
                                    $motivoid = array_search($motivoformat, $columnamotivo);
                                    $fechaentrada = str_replace('/', '-', $row['fentrada']);
                                    $fechaentrada = Carbon::parse($fechaentrada)->format('Y-m-d');
                                    $fechasalida = str_replace('/', '-', $row['fsalida']);
                                    $fechasalida = Carbon::parse($fechasalida)->format('Y-m-d');
                                    $mentrada=date("m",  strtotime($fechaentrada));
                                    $msalida=date("m", strtotime($fechasalida));
                                    if(strtotime($fechaentrada)<strtotime($fechaentrada)){
                                        $fechamayor=true;
                                    }else{$fechamayor=false;}


                                    if ($mentrada==$mes)
                                    {
                                        $ventrada=true;
                                    }else{$ventrada=false;}
                                    if ($msalida==$mes)
                                    {
                                        $vsalida=True;
                                    }else{$vsalida=false;}
                                    if(empty($row['identificacion'])){
                                        $axuiden="S/I";
                                    }
                                    else{$axuiden=ucwords(trim($row['identificacion']));}

                                    if ($paisid !== false and $sexoid !== false and $motivoid !== false and $ventrada!==false and $vsalida!==false and $fechamayor!==false) {
                                        $FilasArray[] = [
                                            'Identificacion' => $axuiden,
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
                                    } else {
                                        if ($paisid === false) {
                                            $Response[] = ['Pais Fila' => $idfila + 2];
                                        }
                                        if ($sexoid === false) {
                                            $Response[] = ['Sexo Fila' => $idfila + 2];
                                        }
                                        if ($motivoid === false) {
                                            $Response[] = ['Motivo Fila' => $idfila + 2];
                                        }
                                        if ($ventrada === false) {
                                            $Response[] = ['Fecha entrada Fila' => $idfila + 2];
                                        }
                                        if ($vsalida === false) {
                                            $Response[] = ['Fecha Salida Fila' => $idfila + 2];
                                        }
                                        if ($fechamayor===false){
                                            $Response[] = ['Fecha entrada es mayor o igual a la fecha de salida, Fila ' => $idfila + 2];
                                        }
                                    }
                                } else {
                                    // session()->put('warning', 'Revisar errores');
                                    $Response[] = $bandera_datos['Message'];
                                    $Response[] = ['Fila' => $idfila + 2];
                                }
                            }
                            $idfila++;
                        }
                    } else {
                        session()->put('warning', 'ENCABEZADOS CON FORMATO ERRONEO');
                    }

                    if (empty($Response) and $bandera_enc == true) { //mensaje
                        session()->put('success', 'LIBRO CARGADO');
                        //aca guardar
                        $libro = new Book;
                        $libro->Mes_id = $request->input("mes");
                        $libro->anio = $request->input("anio");;
                        $libro->estado = 'A';
                        $libro->Observacion = $request->input("observacion");
                        $libro->FechaElaborado = date("Y-m-d");
                        $libro->user_id = Auth::user()->id;
                        $libro->save();
                        Bookdetail::insert($FilasArray);
                    } else {
                        session()->put('error');
                    }
                } else {
                    session()->put('warning', 'NO EXISTE HOJA INTUR');
                }
            } else {
                session()->put('warning', 'NO SE PUDO CARGAR EL ARCHIVO EN EL SERVIDOR');
            }
        } else {
            session()->put('warning', 'REVISAR QUE SEA FORMATO EXCEL');
        }

        if (!empty($Response)) {
            session()->put('error', 'Descargar errores');
            $nombre_original = 'errores_'.$autor.'.txt';
            $errores = Storage::disk('archivos')->put($nombre_original, serialize($Response));
        }

        return back();
    }

    Public function descargar_errores()
    {
        $autor = Auth::user()->name;
        $nombre_original = 'errores_'.$autor.'.txt';
        $ruta = storage_path('archivos')."/".$nombre_original;
        if(File::exists($ruta)) {
            $d = File::get($ruta);
            $Datos = unserialize($d);
            $filename = $nombre_original;
            $headers = [
                'Content-Type' => 'plain/txt',
                'Content-Disposition' => sprintf('attachment; filename="%s"', $filename),
                'Content-Length' => sizeof($Datos),
            ];
            return \Response::make($Datos, 200, $headers);
        } else {
            return redirect('home');
        }
    }

    public function descargar_libro($id){
    $bo = book::find($id);
    $name = 'Huespedes'.$bo->Anio.$bo->month->mes;
    Excel::create($name, function ($excel) use ($id) {
        $excel->sheet('INTUR', function ($sheet) use ($id) {
                $sheet->row(1, [
                    'identificacion',
                    'nombre',
                    'pais',
                    'sexo',
                    'fentrada',
                    'fsalida',
                    'ndormidas',
                    'motivo',
                ]);
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
