@extends('layouts.new')

@section('content')
    <?php $sumanac = 0;
    $sumaext = 0;
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
                            <a href="/crear_reporte_1/1/{{$Y}}" target="_blank">
                                <button class="btn  btn-info btn-just-icon btn-round" style="float: right" rel="tooltip"
                                        data-placement="right" title="Descargar PDF">
                                    <i class="material-icons md-36">picture_as_pdf</i>
                                </button>
                            </a>
                            <a href="{{url("/reporte_exce_1/$Y")}}" target="_blank">
                                <button class="btn btn-info btn-just-icon btn-round" style="float: right" rel="tooltip"
                                        data-placement="right"
                                        title="Descargar XLS"><i class="material-icons">cloud_download</i>
                                </button>
                            </a>
                            <form method="post" action="/reporte/11" id="form_year">
                                <input type="hidden" name="_token" id="_token" value="<?= csrf_token(); ?>">
                                <input type="hidden" name="year" id="year" value="{{$Y}}">
                                <button class="btn  btn-info btn-just-icon btn-round" style="float: right" rel="tooltip"
                                        data-placement="right"
                                        title="Grafica">
                                <!--    onclick="material.showSwal('reporte','11','<?php echo csrf_token(); ?>')">-->
                                    <i class="material-icons">multiline_chart</i>
                                </button>
                            </form>

                            <h4 class="title">Reporte por Huespedes Nacionales y Extranjeros</h4>


                            <table class="table table-hover table-striped" cellspacing="0" width="100%">
                                <thead role="row" class="text-primary">
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
                            <?php $Anio = $dato->Anio; ?>
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
                        <div class="card-footer">Generado {{date("Y-m-d H:i:s")}} Total Hoteles: {{$TH}}

                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection