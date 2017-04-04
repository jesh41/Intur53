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
use Carbon\Carbon;
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
      $books=Book::all();
    
     
        return view('/book/books')->with("books",$books);
    }
   
public function anular_libro(Request $request){
        $idbook=$request->input("id_book");
        
        $book=Book::find($idbook);
        $book->estado='U';
        


       if($book->save()){
             return view("mensajes.msj_libro_anulado")->with("msj","Libro Anulado Correctamente") ;
        }
        else
        {
            return view("mensajes.mensaje_error")->with("msj","..Hubo un error al agregar ; intentarlo nuevamente..");
        }
       }

   public function form_anular_libro($id){
  $book=Book::find($id);
  return view("formularios.form_anular_libro")->with("book",$book);
  }

	public function form_cargar_libros(){
        $months=Month::all();
       return view("formularios.form_cargar_books",compact('months'));

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
           $ruta  =  storage_path('archivos') ."/". $nombre_original;
         
           $libro=new Book;
           $libro->Mes='Marzo';
           $libro->Observacion='prueba';
           $libro->anio='2017';
           $libro->estado='A';
           $libro->Observacion=$request->input("observacion");
           $libro->FechaElaborado= date("Y-m-d");
           $libro->user_id=$autor;
           $libro->save();
           if($r1){
                   
                   Excel::selectSheetsByIndex(0)->load($ruta, function($hoja) {
                      
                            $hoja->each(function($fila) {
                              //if(!empty($data) && $data->count())
                              //obtiene idbook
                              $ultimo=Book::all()->pluck('id')->last();
                              //convierte el campo fecha
                              $fechaentrada = str_replace('/','-', $fila->fechaentrada);
                              $fechaentrada = Carbon::parse($fechaentrada)->format('Y-m-d');
                              $fechasalida = str_replace('/','-', $fila->fechasalida);
                              $fechasalida = Carbon::parse($fechasalida)->format('Y-m-d');
                              if(!empty($fila->identificacion )){
                                $librodet=new Bookdetail;
                                $librodet->Identificacion= $fila->identificacion;
                                $librodet->Nombre= $fila->nombre;
                                $librodet->Pais= $fila->pais;
                                $librodet->Sexo= $fila->sexo;
                                $librodet->Fechaentrada=$fechaentrada;
                                $librodet->Fechasalida=$fechasalida;
                                $librodet->Noches= $fila->nochesdormidas;
                                $librodet->Motivo= $fila->motivo;
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
}
