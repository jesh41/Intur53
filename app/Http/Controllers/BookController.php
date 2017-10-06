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

        if (Auth::user()->isRole('administrador'))
        {
            $books = Book::paginate(5);
        } elseif (Auth::user()->isRole('hotel'))
        {
            $books = Book::where('user_id', Auth::user()->id)->paginate(12);
        } elseif (Auth::user()->isRole('intur')) {
            $books = Book::paginate(12);
        }


      return view('/book/books')->with("books",$books);
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

                    return view("mensajes.msj_libro_anulado")->with("msj", "Libro Anulado Correctamente");
                } else {
                    return view("mensajes.mensaje_error")->with("msj", "..Hubo un error al agregar ; intentarlo nuevamente..");
                }
            } else {
                return view("mensajes.mensaje_error")->with("msj", "NO PUEDE ANULAR UN LIBRO DESPUES DE 1 DIA");
            }
        } else {
            $notificacion = [
                'message' => 'Ha ocurrido un error',
                'alert-type' => 'error',
            ];

            return back()->with($notificacion);
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

            return view("mensajes.msj_libro_anulado")->with("msj", "Libro Anulado Correctamente");
        } else {
            return view("mensajes.mensaje_error")->with("msj", "..Hubo un error al agregar ; intentarlo nuevamente..");
        }
    }

    if (Auth::user()->isRole('intur')) {
        return view("mensajes.mensaje_error")->with("msj", "NO TIENE PERMISO DE ANULACION");
    }
}


public function  form_prev_libro($id){
      $detalle=Bookdetail::where('book_id',$id)->paginate(10);
      return view("formularios.form_previ_libro")->with("detalle",$detalle);
}


   public function form_anular_libro($id){
  $book=Book::find($id);
  return view("formularios.form_anular_libro")->with("book",$book);
  }

	public function form_cargar_libros(){

        // $usuario = Auth::user()->id;
        //  $mes_actual = date('m');
        //   $año_actual = date('Y');
        //  $months=Month::where('id','<=',$mes_actual)->get();
        //    $months = DB::select("call validacion_mes($año_actual,$usuario,$mes_actual)");
        return view("formularios.form_cargar_books");//->with("months",$months);
	 }

 	public function cargar_libros(Request $request)
	{
       $archivo = $request->file('archivo');      
       $extension=$archivo->getClientOriginalExtension();

        if ($extension == 'xlsx')//valido el tipo de archivo
        {
            $autor = Auth::user()->id;//id del login actual
            $nombre_original = 'user'.$autor.'.'.$extension;//renombra el archivo subido
            $r1 = Storage::disk('archivos')->put($nombre_original, \File::get($archivo));//guardar en el disco
            $ruta = storage_path('archivos')."/".$nombre_original;//ubicaion donde se guardo

            if ($r1) {
                //data esta leyendo 3 filas null
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
                    ];
                    if ($encabezados == $excelheader) {
                        $conteo = $data->count();
                        $ultimo = Book::all()->pluck('id')->last();
                        if (is_null($ultimo)) {
                            $ultimo = 0;
                        }
                        $mensaje = null;
                        $mensaje5 = null;
                        $mensaje3 = null;
                        $mensaje4 = null;
                        $t = 0;
                        $d = 0;
                        foreach ($data->toArray() as $row) {
                            if (! empty($row)) {
                                if (empty($row['identificacion']) || (empty($row['nombre'])) || (empty($row['pais'])) || (empty($row['sexo'])) || (empty($row['fentrada'])) || (empty($row['fsalida'])) || (empty($row['ndormidas'])) || (empty($row['motivo']))) {
                                    $c2[] = (string) $t + 2;
                                    $cadena = implode(',', $c2);
                                    $mensaje = "EXISTEN VALORES NULOS, REVISAR FILA $cadena";
                                    $notificacion = ['message' => $mensaje, 'alert-type' => 'error',];
                                }
                                $t++;
                            }
                        }
                        if (empty($mensaje)) {
                            foreach ($data->toArray() as $row) {
                                if (! empty($row)) {
                                    $pais = Country::where('country', 'LIKE', '%'.$row['pais'].'%')->get()->first();
                                    $sexo = Sex::where('sexo', 'LIKE', '%'.$row['sexo'].'%')->get()->first();
                                    $motivo = Reason::where('motivo', 'LIKE', '%'.$row['motivo'].'%')->get()->first();
                                    $fechaentrada = str_replace('/', '-', $row['fentrada']);
                                    $fechaentrada = Carbon::parse($fechaentrada)->format('Y-m-d');
                                    $fechasalida = str_replace('/', '-', $row['fsalida']);
                                    $fechasalida = Carbon::parse($fechasalida)->format('Y-m-d');
                                    $FilasArray[] = [
                                        'Identificacion' => $row['identificacion'],
                                        'Nombre' => $row['nombre'],
                                        'pais_id' => $pais->id,
                                        'Sexo_id' => $sexo->id,
                                        'Fechaentrada' => $fechaentrada,
                                        'Fechasalida' => $fechasalida,
                                        'Noches' => $row['ndormidas'],
                                        'motivo_id' => $motivo->id,
                                        'book_id' => $ultimo + 1,
                                        'created_at' => date('Y-m-d H:i:s'),
                                    ];
                                    if ((is_null($pais))) {
                                        $c3[] = (string) $d + 2;
                                        $cadena3 = implode(',', $c3);
                                        $mensaje3 = " PAIS FILA $cadena3";
                                    }
                                    if ((is_null($sexo))) {
                                        $c4[] = (string) $d + 2;
                                        $cadena4 = implode(',', $c4);
                                        $mensaje4 = " SEXO FILA $cadena4";
                                    }
                                    if ((is_null($motivo))) {
                                        $c5[] = (string) $d + 2;
                                        $cadena5 = implode(',', $c5);
                                        $mensaje5 = " MOTIVO FILA $cadena5";
                                    }
                                    $d++;
                                }
                            }
                            if (! empty($c3) || ! empty($c4) || ! empty($c5)) {

                                $combo = "Revisar $mensaje3"."$mensaje4"."$mensaje5";
                                $notificacion = ['message' => $combo, 'alert-type' => 'error',];
                            } else {
                                $notificacion = ['message' => 'LIBRO GUARDADO', 'alert-type' => 'success',];
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
                        $notificacion = [
                            'message' => 'REVISAR ENCABEZADOS, NO CUMPLE EL FORMATO',
                            'alert-type' => 'error',
                        ];
                    }
                } else {
                    $notificacion = ['message' => 'NO EXISTE HOJA INTUR', 'alert-type' => 'error',];
                }

                // Excel::selectSheets('INTUR')->load($ruta, function ($hoja) {
                //            $hoja->each(function($fila)   {

                ///  $ultimo = Book::all()->pluck('id')->last();
                /// $fechaentrada = str_replace('/', '-', $fila->fentrada);
                /// $fechaentrada = Carbon::parse($fechaentrada)->format('Y-m-d');
                /// $fechasalida = str_replace('/', '-', $fila->fsalida);
                ///$fechasalida = Carbon::parse($fechasalida)->format('Y-m-d');

                /// if(!empty($fila->identificacion )){
                /// $librodet=new Bookdetail;
                /// $librodet->Identificacion= $fila->identificacion;
                /// $librodet->Nombre= $fila->nombre;
                /// $pais=Country::where('country','LIKE','%'.$fila->pais.'%')->get();
                ///   $librodet->pais_id = $pais[0]->id;
                ///$s=Sex::where('sexo','LIKE','%'.$fila->sexo.'%')->get();
                /// $librodet->Sexo_id= $s[0]->id;
                /// $librodet->Fechaentrada=$fechaentrada;
                /// $librodet->Fechasalida=$fechasalida;
                /// $librodet->Noches= $fila->ndormidas;
                ///$mot=Reason::where('motivo','LIKE','%'.$fila->motivo.'%')->get();
                ///$librodet->motivo_id= $mot[0]->id;
                ///$librodet->book_id=$ultimo;
                ///$librodet->save();
                ///}

                //     });
                // });

            }
                       else
                       {
                           $notificacion = [
                               'message' => 'ERROR NO SE PUDO CARGAR EL ARCHIVO EN EL SERVIDOR',
                               'alert-type' => 'error',
                           ];
                       }
                       
        }
        else
        {
            $notificacion = [
                'message' => 'ERROR Revisar que sea formato excel',
                'alert-type' => 'error',
            ];
        }

        return back()->with($notificacion);
      }

public function descargar_libro($id){
    $bo = book::find($id);
    $name = 'Huespedes'.$bo->Anio.$bo->month->mes;
    Excel::create($name, function ($excel) use ($id) {
 
            $excel->sheet('Huespedes', function($sheet) use($id) {

                $sheet->row(1,['Identificacion','Nombre','Pais','Sexo','Fechaentrada','Fechasalida','Noches','Motivo']);
                $datos =Bookdetail::where('book_id',$id)->get();
                $data=[];
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
