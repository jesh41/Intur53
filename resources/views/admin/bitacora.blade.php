@extends('layouts.hom')

@section('content')
<section  class="container"  id="contenido_principal">

<div class="col-md-8 col-md-offset-2">
     <div class="box-header">
        <h4 class="box-title">Anulaciones</h4>         
    

    
    </div>


<div class="box-body box-white">

    <div class="table-responsive" >

        <table  class="table table-hover table-striped" cellspacing="0" width="100%">
                <thead>
                        <tr>    <th>id</th>
                                <th>Book id</th>
                                <th>Observacion</th>
                                <th>Elaborado</th>
                                <th>FechaElaborado</th>
                                
                        </tr>
                </thead>
        <tbody>
         @foreach($annulments as $annulment)
        <tr role="row" class="odd">
            <td>{{ $annulment->id }}</td>
            <td>{{ $annulment->book_id }}</td>
            <td>{{ $annulment->observacion }}</td>
            <td>{{ $annulment->Elaborado }}</td>
            <td>{{ $annulment->created_at }}</td>     
        </tr>
        @endforeach
      


        </tbody>
        </table>

    </div>
</div>





</div>
</section>

@endsection



              