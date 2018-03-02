@extends('layouts.new')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="card">
                        <div class="card-header card-header-icon" data-background-color="rose">
                            <i class="material-icons">show_chart</i>
                        </div>

                        <div class="card-content">
                            <h4 class="title">Reportes del sistema</h4>

                            @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                            <div class="tab-content">
                                <div class="tab-pane active table-responsive ">
                                    <table class="table table-hover table-striped" cellspacing="0" width="100%">
                                        <thead role="row" class="text-primary">
                                <tr>
                                    <th>Id</th>
                                    <th>Reporte</th>
                                    <th>Web</th>
                                    <th>Grafica</th>
                                </tr>
                                </thead>
                                <tbody>
                                @role('hotel')
                                <tr>
                                    <td>1</td>
                                    <td>Numero de Huespedes por mes y residencia</td>
                                    <td>
                                        <button class="btn   btn-info btn-sm "
                                                onclick="material.showSwal('reporte','1','<?php echo csrf_token(); ?>')">
                                            <i
                                                    class="material-icons">remove_red_eye</i>
                                        </button>
                                    </td>

                                    <td>
                                        <button class="btn  btn-info btn-sm "
                                                onclick="material.showSwal('reporte','11','<?php echo csrf_token(); ?>')">
                                            <i
                                                    class="material-icons">equalizer</i>
                                        </button>
                                    </td>
                                </tr>
                                @else
                                    <tr>
                                        <td>1</td>
                                        <td>Numero de Huespedes por mes y residencia</td>
                                        <td>
                                            <button class="btn   btn-info btn-sm "
                                                    onclick="material.showSwal('reporte','1','<?php echo csrf_token(); ?>')">
                                                <i
                                                        class="material-icons">remove_red_eye</i>
                                            </button>
                                        </td>

                                        <td>
                                            <button class="btn  btn-info btn-sm "
                                                    onclick="material.showSwal('reporte','11','<?php echo csrf_token(); ?>')">
                                                <i
                                                        class="material-icons">equalizer</i>
                                            </button>
                                        </td>
                                    </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Numero de huespedes por region y sexo</td>
                                    <td>
                                        <button class="btn   btn-info btn-sm "
                                                onclick="material.showSwal('reporte','2','<?php echo csrf_token(); ?>')">
                                            <i
                                                    class="material-icons">remove_red_eye</i>
                                        </button>
                                    </td>
                                    <td>
                                        <button class="btn   btn-info btn-sm "
                                                onclick="material.showSwal('reporte','22','<?php echo csrf_token(); ?>')">
                                            <i
                                                    class="material-icons">equalizer</i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Numero de huespedes por region y motivo de viaje</td>

                                    <td>
                                        <button class="btn   btn-info btn-sm "
                                                onclick="material.showSwal('reporte','3','<?php echo csrf_token(); ?>')">
                                            <i
                                                    class="material-icons">remove_red_eye</i>
                                        </button>
                                    </td>
                                    <td>
                                        <button class="btn   btn-info btn-sm "
                                                onclick="material.showSwal('reporte','33','<?php echo csrf_token(); ?>')">
                                            <i
                                                    class="material-icons">equalizer</i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>Estadia promedio de Huespedes Extranjeros/Nacionales por año y mes</td>

                                    <td>
                                        <button class="btn  btn-info btn-sm "
                                                onclick="material.showSwal('reporte','4','<?php echo csrf_token(); ?>')">
                                            <i
                                                    class="material-icons">remove_red_eye</i>
                                        </button>
                                    </td>
                                    <td>
                                        <button class="btn   btn-info btn-sm "
                                                onclick="material.showSwal('reporte','44','<?php echo csrf_token(); ?>')">
                                            <i
                                                    class="material-icons">equalizer</i>
                                        </button>
                                    </td>
                                </tr>
                                    @endrole
                                </tr>

                                </tbody>
                            </table>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection