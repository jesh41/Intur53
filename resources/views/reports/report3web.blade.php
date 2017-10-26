@extends('layouts.new')

@section('content')

    <?php $sumaT = 0;
    $sumaC = 0;
    $sumaN = 0;
    $sumaO = 0;
    ?>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">

                    <div class="card">
                        <div class="card-header card-header-icon" data-background-color="rose">
                            <i class="material-icons">show_chart</i>
                        </div>

                        <div class="card-content">
                            <h4 class="title">Reporte Por region y motivo de viaje</h4>

                            <table class="table table-hover table-striped" cellspacing="0" width="100%">
                                <thead role="row" class="text-primary">
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

                    <div class="card-footer">Generado {{date("Y-m-d H:i:s")}} Total Hoteles: {{$TH}}
                        <a href="/crear_reporte_3/1/{{$Anio}}" target="_blank">
                            <button class="btn  btn-info btn-just-icon btn-round" style="float: right" rel="tooltip"
                                    data-placement="right" title="Descargar">
                                <i class="material-icons md-36">picture_as_pdf</i>
                            </button>
                        </a>
                        <a href="{{url("/reporte_exce_3/$Anio")}}" target="_blank">
                            <button class="btn btn-info btn-just-icon btn-round" style="float: right" rel="tooltip"
                                    data-placement="right"
                                    title="Descargar"><i class="material-icons">cloud_download</i>
                            </button>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>
@endsection