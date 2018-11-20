@extends('layouts.new')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">

                    <div class="card">
                        <div class="card-header card-header-icon" data-background-color="blue2">
                            <i class="material-icons">show_chart</i>
                        </div>


                        <div class="card-content">
                            <a href="/crear_reporte_4/1/{{$Y}}" target="_blank">
                                <button class="btn  btn-info btn-just-icon btn-round" style="float: right" rel="tooltip"
                                        data-placement="right" title="Descargar">
                                    <i class="material-icons md-36">picture_as_pdf</i>
                                </button>
                            </a>
                            <a href="{{url("/reporte_exce_4/$Y")}}" target="_blank">
                                <button class="btn btn-info btn-just-icon btn-round" style="float: right" rel="tooltip"
                                        data-placement="right"
                                        title="Descargar"><i class="material-icons">cloud_download</i>
                                </button>
                            </a>
                            <form method="post" action="/reporte/44" id="form_year">
                                <input type="hidden" name="_token" id="_token" value="<?= csrf_token(); ?>">
                                <input type="hidden" name="year" id="year" value="{{$Y}}">
                                <button class="btn  btn-info btn-just-icon btn-round" style="float: right" rel="tooltip"
                                        data-placement="right"
                                        title="Grafica">
                                <!--    onclick="material.showSwal('reporte','11','<?php echo csrf_token(); ?>')">-->
                                    <i class="material-icons">equalizer</i>
                                </button>
                            </form>
                            <h4 class="title">Reporte de estadia promedio por mes, residencia y total</h4>
                            <table class="table table-hover table-striped" cellspacing="0" width="100%">
                                <thead role="row" class="text-primary">
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
                        <div class="card-footer">Generado {{date("Y-m-d H:i:s")}} Total Hoteles: {{$TH}}

                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
    </div>

@endsection