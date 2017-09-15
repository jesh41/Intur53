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
            <td>{{ $book->month->mes}}</td>
            <td>{{ $book->estado }}</td>
            <td>{{ $book->Anio }}</td>
            <td>{{ Carbon\Carbon::parse($book->FechaElaborado)->format('d-m-Y')}}</td>
            <td>{{ $book->user->name}}</td>
            @if ($book->estado=='U')
                <td>
                <a href="{{url("descargar/$book->id")}}"><button type="button" class="btn  btn-default btn-xs" title="Descargar"><i class="fa fa-cloud-download"></a></i></button>
                <button type="button" class="btn  btn-default btn-xs" title="previsualizar"  onclick="previ_libro({{$book->id }});" ><i class="fa fa-fw fa-eye"></i></button>
                </td>
            @else
            <td>
            <a href="{{url("descargar/$book->id")}}" target="_blank" ><button type="button" class="btn  btn-default btn-xs" title="Descargar" ><i class="fa fa-cloud-download"></a></i></button>
             <button type="button" class="btn  btn-default btn-xs" title="previsualizar" onclick="previ_libro({{$book->id }});" ><i class="fa fa-fw fa-eye"></i></button>
            <button type="button"  class="btn  btn-danger btn-xs"  title="anular" onclick="anular_libro({{$book->id }});"  ><i class="fa fa-fw fa-remove"></i></button>
            </td>
           @endif
            
            
        </tr>
        @endforeach
      


        </tbody>
        </table>

    </div>
</div>


{{ $books->links() }}


</div>
</section>

@endsection



              