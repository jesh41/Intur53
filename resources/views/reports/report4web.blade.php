@extends('layouts.hom')

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Reporte de estadia promedio por mes, residencia y total</div>
                    <div class="panel-body">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Año</th>
                                <th>Mes</th>
                                <th>Estadia promedio Extranjero</th>
                                <th>Estadia promedio Nacional</th>
                                <th>Estadia promedio general</th>

                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($data as $dato){ ?>

                            <tr>
                                <td><?= $dato->Anio; ?></td>
                                <td><?= $dato->Mes; ?></td>
                                <td><?= round($dato->estadiaext); ?></td>
                                <td><?= round($dato->estadianac); ?></td>
                                <td><?= round($dato->pro_general); ?></td>
                                <?php $Anio = $dato->Anio; ?>

                            </tr>

                            <?php  } ?>

                            </tbody>

                        </table>
                    </div>
                </div>
                <div class="panel-footer clearfix">Generado {{date("Y-m-d H:i:s")}} Total Hoteles: {{$TH}}
                    <a href="/crear_reporte_4/1/{{$Anio}}"
                       target="_blank">
                        <button class="btn  btn-default btn-xs" title="Descargar"><i
                                    class="fa fa-cloud-download fa-lg"></i>
                    </a></button></div>
            </div>
        </div>
    </div>


@endsection