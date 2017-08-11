@extends('layouts.hom')

@section('content')
    <?php $sumaF = 0;
    $sumaM = 0;
    ?>

    <div class="container">

        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Reporte Por Region y sexo</div>
                    <div class="panel-body">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Año</th>
                                <th>Region</th>
                                <th>Femenino</th>
                                <th>Masculino</th>
                                <th>Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($data as $dato){ ?>

                            <tr>
                                <td><?= $dato->Anio; ?></td>
                                <td><?= $dato->Region; ?></td>
                                <td><?= $dato->Femenino; ?></td>
                                <td><?= $dato->Masculino; ?></td>
                                <td><?= $dato->Femenino + $dato->Masculino; ?></td>
                            </tr>
                            <?php $sumaF = $sumaF + $dato->Femenino; ?>
                            <?php $sumaM = $sumaM + $dato->Masculino; ?>
                            <?php $Anio = $dato->Anio; ?>
                            <?php  } ?>
                            <tr>
                                <td colspan="2" align="center">GRAN TOTAL</td>

                                <td> <?php echo $sumaF; ?></td>
                                <td> <?php echo $sumaM; ?></td>
                                <td> <?php echo $sumaM + $sumaF; ?> </td>
                            </tr>
                            </tbody>

                        </table>
                    </div>
                </div>
                <div class="panel-footer clearfix">Generado {{date("Y-m-d H:i:s")}}
                    <a href="/crear_reporte_2/1/{{$Anio}}" target="_blank">
                        <button class="btn  btn-default btn-xs" title="Descargar"><i
                                    class="fa fa-cloud-download fa-lg"></i>
                    </a></button></div>
            </div>
        </div>
    </div>

@endsection