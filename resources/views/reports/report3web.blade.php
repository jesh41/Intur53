@extends('layouts.hom')

@section('content')

    <?php $sumaT = 0;
    $sumaC = 0;
    $sumaN = 0;
    $sumaO = 0;
    ?>

    <div class="container">

        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Reporte Por region y motivo de viaje</div>
                    <div class="panel-body">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Año</th>
                                <th>Region</th>
                                <th>Turismo</th>
                                <th>Congresos</th>
                                <th>Negocios</th>
                                <th>Otros</th>
                                <th>Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($data as $dato){ ?>

                            <tr>
                                <td><?= $dato->Anio; ?></td>
                                <td><?= $dato->Region; ?></td>
                                <td><?= $dato->Turismo; ?></td>
                                <td><?= $dato->Congresos; ?></td>
                                <td><?= $dato->Negocios; ?></td>
                                <td><?= $dato->Otros; ?></td>
                                <td><?= $dato->Turismo + $dato->Congresos + $dato->Negocios + $dato->Otros; ?></td>
                            </tr>
                            <?php $sumaT = $sumaT + $dato->Turismo; ?>
                            <?php $sumaC = $sumaC + $dato->Congresos; ?>
                            <?php $sumaN = $sumaN + $dato->Negocios; ?>
                            <?php $sumaO = $sumaO + $dato->Otros; ?>
                            <?php $Anio = $dato->Anio; ?>
                            <?php  } ?>
                            <tr>
                                <td colspan="2" align="center">GRAN TOTAL</td>

                                <td> <?php echo $sumaT; ?></td>
                                <td> <?php echo $sumaC; ?></td>
                                <td> <?php echo $sumaN; ?></td>
                                <td> <?php echo $sumaO; ?></td>
                                <td> <?php echo $sumaT + $sumaN + $sumaC + $sumaO; ?></td>
                            </tr>
                            </tbody>

                        </table>
                    </div>
                </div>
                <div class="panel-footer clearfix">Generado {{date("Y-m-d H:i:s")}}
                    <a href="/crear_reporte_3/1/{{$Anio}}"
                       target="_blank">
                        <button class="btn  btn-default btn-xs" title="Descargar"><i
                                    class="fa fa-cloud-download fa-lg"></i>
                    </a></button> </div>
            </div>
        </div>
    </div>

@endsection