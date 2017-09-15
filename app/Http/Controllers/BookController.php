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
            $books = Book::paginate(12);
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
    $valido = $consulta[0];
    if (Auth::user()->isRole('hotel')) {
        if ($valido->id == $idbook) {
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
            return view("mensajes.mensaje_error")->with("msj", "NO SE PUEDE ANULAR ESTE LIBRO");
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

          if ($extension=='xlsx')
        {
           $autor = Auth::user()->id;
          $nombre_original='user'.$autor.'.'.$extension;//'Excel '+$archivo->getClientOriginalName()+$autor;
           $r1=Storage::disk('archivos')->put($nombre_original,  \File::get($archivo) );
           $ruta=storage_path('archivos') ."/". $nombre_original;      
             $libro=new Book;
             $libro->Mes_id=$request->input("mes");
            $libro->anio = $request->input("anio");;
             $libro->estado='A';
             $libro->Observacion=$request->input("observacion");
             $libro->FechaElaborado= date("Y-m-d");
             $libro->user_id=$autor;  
             $libro->save();


           if($r1){
                  
                   Excel::selectSheetsByIndex(0)->load($ruta, function($hoja)  {
                      
                            $hoja->each(function($fila)   {
                              //if(!empty($data) && $data->count())
                              //obtiene idbook
                              $ultimo=Book::all()->pluck('id')->last();
                              //convierte el campo fecha
                            $fechaentrada= str_replace('/','-', $fila->fentrada);
                            // $nfechaentrada = carbon::createFromFormat('Y-m-d',$fila->fentrada);
                             // $p1= date('Y-m-d', strtotime($fechaentrada));//Carbon::parse($fechaentrada)->format('Y-m-d');//str_replace('/','-', $fila->fentrada);
                               // $nfechaentrada = Carbon::parse($p1)->format('Y-m-d');                       
                              $fechaentrada = Carbon::parse($fechaentrada)->format('Y-m-d');
                             $fechasalida =str_replace('/','-', $fila->fsalida);
                           //$p2= date('Y-m-d', strtotime($fechasalida));
                           //$nfechasalida =Carbon::parse($p2)->format('Y-m-d');
                             // $nfechasalida =Carbon::createFromFormat( 'd/m/Y',$fechasalida);// Carbon::parse($fechasalida)->format('Y-m-d');//str_replace('/','-', $fila->fsalida);
                              $fechasalida = Carbon::parse($fechasalida)->format('Y-m-d');
                              if(!empty($fila->identificacion )){
                                $librodet=new Bookdetail;
                                $librodet->Identificacion= $fila->identificacion;
                                $librodet->Nombre= $fila->nombre;
                                $pais=Country::where('country','LIKE','%'.$fila->pais.'%')->get();
                                $librodet->pais_id= $pais[0]->id;//ila->pais;
                                $s=Sex::where('sexo','LIKE','%'.$fila->sexo.'%')->get();
                                $librodet->Sexo_id= $s[0]->id;
                                $librodet->Fechaentrada=$fechaentrada;
                                $librodet->Fechasalida=$fechasalida;
                                $librodet->Noches= $fila->ndormidas;

                                $mot=Reason::where('motivo','LIKE','%'.$fila->motivo.'%')->get();
                                $librodet->motivo_id= $mot[0]->id;
                                $librodet->book_id=$ultimo;
                                $librodet->save();
                                 }
                             
                               });

                            });
                                
                            
                            return view("mensajes.msj_correcto")->with("msj"," Libro cargado Correctamente");
                      
                       }
                       else
                       {
                            return view("mensajes.msj_rechazado")->with("msj","Error al subir el archivo, revise que cumpla con el formato");
                       }

                       
        }
        else
        {
            return view("mensajes.msj_rechazado")->with("msj","Favor solo subir archivo excel ");
        }

      }

public function descargar_libro($id){
       
   Excel::create('Huespedes', function($excel) use($id) {
 
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
