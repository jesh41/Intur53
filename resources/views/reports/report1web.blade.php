@extends('layouts.hom')

@section('content')
    <?php $sumanac = 0;
    $sumaext = 0;
    ?>
    <div class="container">

        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Reporte por Huespedes Nacionales y Extranjeros  <!--<a href="" target="_blank">
                            <button class="btn  btn-default btn-xs" title="Descargar"><i
                                        class="fa fa-cloud-download fa-lg"></i>
                        </a></button> --> </div>
                    <div class="panel-body">

                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Año</th>
                                <th>Mes</th>
                                <th>Extranjeros</th>
                                <th>Nacionales</th>
                                <th>Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($data as $dato){ ?>
                            <?php $s = $dato->Nacionales + $dato->Extranjeros; ?>
                            <tr>
                                <td><?= $dato->Anio; ?></td>
                                <td><?= $dato->Mes; ?></td>
                                <td><?= $dato->Extranjeros; ?></td>
                                <td><?= $dato->Nacionales; ?></td>
                                <td><?= $s; ?> </td>
                            </tr>
                            <?php $sumaext = $sumaext + $dato->Extranjeros; ?>
                            <?php $sumanac = $sumanac + $dato->Nacionales; ?>
                            <?php  } ?>
                            <tr>
                                <td colspan="2" align="center">GRAN TOTAL</td>

                                <td> <?php echo $sumaext; ?></td>
                                <td> <?php echo $sumanac; ?></td>
                                <td> <?php echo $sumanac + $sumaext; ?></td>
                            </tr>
                            </tbody>

                        </table>
                    </div>
                </div>
                <div class="panel-footer clearfix">Generado {{date("Y-m-d H:i:s")}} </div>
            </div>
        </div>
    </div>

@endsection