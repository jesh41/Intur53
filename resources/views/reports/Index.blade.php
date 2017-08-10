@extends('layouts.hom')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="box box-info">
                <div class="box-header">
                    <h3 class="box-title">REPORTES DEL SISTEMA</h3>

                </div>

                <div class="box-tools">

                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover">

                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>reporte</th>
                                    <th>Web</th>
                                    <th>Grafica</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Numero de Huespedes por mes y residencia</td>
                                    <!--<td><a href="/reporte_1" >
                                            <button class="btn  btn-default btn-xs"><i class="fa  fa-eye fa-lg"></i>
                                        </a></button></td>-->
                                    <td><a href="javascript:void(0);">
                                            <button class="btn  btn-default btn-xs" onclick="parametro(1);"><i
                                                        class="fa  fa-eye fa-lg"></i>
                                        </a></button></td>

                                    <td><a href="javascript:void(0);">
                                            <button class="btn  btn-default btn-xs" onclick="parametro(11);"><i
                                                        class="fa fa-line-chart fa-lg"></i>
                                        </a></button></td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Numero de huespedes por region y sexo</td>
                                    <!--  <td><a href="crear_reporte_2/1" target="_blank">
                                              <button class="btn  btn-default btn-xs"><i class="fa  fa-eye fa-lg"></i>
                                          </a></button></td>-->
                                    <td><a href="javascript:void(0);">
                                            <button class="btn  btn-default btn-xs" onclick="parametro(2);"><i
                                                        class="fa  fa-eye fa-lg"></i>
                                        </a></button></td>
                                    <td><a href="javascript:void(0);">
                                            <button class="btn  btn-default btn-xs" onclick="parametro(22);"><i
                                                        class="fa fa-line-chart fa-lg"></i>
                                        </a></button></td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Numero de huespedes por region y motivo de viaje</td>
                                    <!--<td><a href="crear_reporte_3/1" target="_blank">
                                            <button class="btn  btn-default btn-xs"><i class="fa  fa-eye fa-lg"></i>
                                        </a></button></td>-->
                                    <td><a href="javascript:void(0);">
                                            <button class="btn  btn-default btn-xs" onclick="parametro(3);"><i
                                                        class="fa  fa-eye fa-lg"></i>
                                        </a></button></td>
                                    <td><a href="javascript:void(0);">
                                            <button class="btn  btn-default btn-xs" onclick="parametro(33);"><i
                                                        class="fa fa-line-chart fa-lg"></i>
                                        </a></button></td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>Estadia promedio de Huespedes Extrajeros/Nacionales por año y mes</td>
                                    <!--<td><a href="crear_reporte_4/1" target="_blank">
                                            <button class="btn  btn-default btn-xs"><i class="fa  fa-eye fa-lg"></i>
                                        </a></button></td>-->
                                    <td><a href="javascript:void(0);">
                                            <button class="btn  btn-default btn-xs" onclick="parametro(4);"><i
                                                        class="fa  fa-eye fa-lg"></i>
                                        </a></button></td>
                                    <td><a href="javascript:void(0);">
                                            <button class="btn  btn-default btn-xs" onclick="parametro(4);"><i
                                                        class="fa fa-line-chart fa-lg"></i>
                                        </a></button></td>
                                </tr>
                                <tr>

                                </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

@endsection