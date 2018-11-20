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
                        <div class="card-header card-header-icon" data-background-color="blue2">
                            <i class="material-icons">show_chart</i>
                        </div>
                        <div class="card-content">
                            <a href="/crear_reporte_2/1/{{$Y}}" target="_blank">
                                <button class="btn  btn-info btn-just-icon btn-round" style="float: right" rel="tooltip"
                                        data-placement="right" title="Descargar">
                                    <i class="material-icons md-36">picture_as_pdf</i>
                                </button>
                            </a>
                            <a href="{{url("/reporte_exce_2/$Y")}}" target="_blank">
                                <button class="btn btn-info btn-just-icon btn-round" style="float: right" rel="tooltip"
                                        data-placement="right"
                                        title="Descargar"><i class="material-icons">cloud_download</i>
                                </button>
                            </a>
                            <form method="post" action="/reporte/22" id="form_year">
                                <input type="hidden" name="_token" id="_token" value="<?= csrf_token(); ?>">
                                <input type="hidden" name="year" id="year" value="{{$Y}}">
                                <button class="btn  btn-info btn-just-icon btn-round" style="float: right" rel="tooltip"
                                        data-placement="right"
                                        title="Grafica">
                                <!--    onclick="material.showSwal('reporte','11','<?php echo csrf_token(); ?>')">-->
                                    <i class="material-icons">equalizer</i>
                                </button>
                            </form>
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
                        <div class="card-footer">Generado {{date("Y-m-d H:i:s")}} Total Hoteles: {{$TH}}

                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
    </div>

@endsection