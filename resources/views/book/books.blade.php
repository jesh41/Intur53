@extends('layouts.hom')

@section('content')
<section  class="container"  id="contenido_principal">

<div class="col-md-8 col-md-offset-2">
     <div class="box-header">
        <h4 class="box-title">Libros</h4>         
    

        <div class="margin" id="botones_control">
            <a href="javascript:void(0);" class="btn btn-xs btn-primary" onclick="cargar_formulario(4);" >SUBIR</a>  
        </div>

    </div>


<div class="box-body box-white">

    <div class="table-responsive" >

        <table  class="table table-hover table-striped" cellspacing="0" width="100%">
                <thead>
                        <tr>    <th>codigo</th>
                                <th>Mes</th>
                                <th>Estado</th>
                                <th>Año</th>
                                <th>FechaElaborado</th>
                                <th>Elaborado</th>
                        </tr>
                </thead>
        <tbody>
         @foreach($books as $book)
        <tr role="row" class="odd">
            <td>{{ $book->id }}</td>
            <td>{{ $book->Mes }}</td>
            <td>{{ $book->estado }}</td>
            <td>{{ $book->Anio }}</td>
            <td>{{ $book->FechaElaborado}}</td>
            
            <td>{{ $book->user->name}}</td>
            <td><button type="button"  class="btn  btn-danger btn-xs"  onclick="anular_libro({{$book->id }});"  ><i class="fa fa-fw fa-remove"></i></button></td>
           
            
            
        </tr>
        @endforeach
      


        </tbody>
        </table>

    </div>
</div>





</div>
</section>

@endsection



              