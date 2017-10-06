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
                                <tr>
                                    <td>1</td>
                                    <td>Numero de Huespedes por mes y residencia</td>
                                    <td>
                                        <button class="btn   btn-info btn-sm " onclick="parametro(1);"><i
                                                    class="material-icons">remove_red_eye</i>
                                        </button>
                                    </td>

                                    <td>
                                        <button class="btn  btn-info btn-sm " onclick="parametro(11);"><i
                                                    class="material-icons">multiline_chart</i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Numero de huespedes por region y sexo</td>
                                    <td>
                                        <button class="btn   btn-info btn-sm " onclick="parametro(2);"><i
                                                    class="material-icons">remove_red_eye</i>
                                        </button>
                                    </td>
                                    <td>
                                        <button class="btn   btn-info btn-sm " onclick="parametro(22);"><i
                                                    class="material-icons">multiline_chart</i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Numero de huespedes por region y motivo de viaje</td>

                                    <td>
                                        <button class="btn   btn-info btn-sm " onclick="parametro(3);"><i
                                                    class="material-icons">remove_red_eye</i>
                                        </button>
                                    </td>
                                    <td>
                                        <button class="btn   btn-info btn-sm " onclick="parametro(33);"><i
                                                    class="material-icons">multiline_chart</i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>Estadia promedio de Huespedes Extrajeros/Nacionales por año y mes</td>

                                    <td>
                                        <button class="btn  btn-info btn-sm " onclick="parametro(4);"><i
                                                    class="material-icons">remove_red_eye</i>
                                        </button>
                                    </td>
                                    <td>
                                        <button class="btn   btn-info btn-sm " onclick="parametro(4);"><i
                                                    class="material-icons">multiline_chart</i>
                                        </button>
                                    </td>
                                </tr>


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