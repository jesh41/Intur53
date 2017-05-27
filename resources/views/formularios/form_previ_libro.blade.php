
<section>
<div class="col-md-12">
    <div class="table-responsive" >
      <table  class="table table-hover table-striped" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Identificacion</th>
                <th>Nombre</th>
                <th>Pais</th>
                <th>Sexo</th>
                <th>Fecha entrada</th>
                <th>Fecha salida</th>
                <th>Noches</th>
                <th>Motivo</th>
            </tr>
        </thead>
      <tbody>
      @foreach($detalle as $detalles)
    <tr role="row" class="odd" id="filaR_{{  $detalles->id }}">
      <td>{{ $detalles->id }}</td>
      <td>{{ $detalles->Identificacion }}</td>
      <td>{{ $detalles->Nombre }}</td>
      <td>{{ $detalles->pais->country }}</td>
      <td>{{ $detalles->Sexo }}</td>
      <td>{{ $detalles->FechaEntrada }}</td>
      <td>{{ $detalles->FechaSalida }}</td>
      <td>{{ $detalles->Noches }}</td>
      <td>{{ $detalles->Motivo }}</td>
    </tr>
      @endforeach
    </tbody>
    </table>
</div>
</section>
{{ $detalle->links() }}
  </div>

