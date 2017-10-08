@extends('layouts.new')

@section('content')
    <?php $sumaF = 0;
    $sumaM = 0;
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
                            <h4 class="title">Reporte Por Region y sexo</h4>


                            <table class="table table-hover table-striped" cellspacing="0" width="100%">
                                <thead role="row" class="text-primary">
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

                    <div class="card-footer">Generado {{date("Y-m-d H:i:s")}} Total Hoteles: {{$TH}}
                    <a href="/crear_reporte_2/1/{{$Anio}}" target="_blank">
                        <button class="btn  btn-info btn-xs" rel="tooltip" data-placement="right" title="Descargar"><i
                                    class="fa fa-cloud-download fa-lg"></i>
                        </button>
                    </a>
                    </div>


                </div>
            </div>
        </div>
    </div>
    </div>

@endsection