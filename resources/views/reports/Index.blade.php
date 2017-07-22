@extends('layouts.hom')

@section('content')
<div class="row">
            <div class="col-md-8 col-md-offset-2">
              <div class="box box-info">
                <div class="box-header">
                  <h3 class="box-title">REPORTES DEL SISTEMA</h3>
                  <div class="box-tools">
               
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                   
                    <thead><tr>
                      <th>ID</th>
                      <th>reporte</th>
                      <th>ver</th>
                      <th>descargar</th>
                      <th>Grafica</th>
                    </tr></thead>
                    <tbody>
                    <tr>
                      <td>1</td>
                      <td>Numero de Huespedes por mes y por residencia</td>
                      <td><a href="crear_reporte_1/1" target="_blank" ><button class="btn  btn-default btn-xs"><i class="fa  fa-eye fa-lg"></i></a></button></td>
                      <td><a href="crear_reporte_1/2" target="_blank" ><button class="btn  btn-default btn-xs"><i class="fa fa-cloud-download fa-lg"></i></a></button></td>
                      <td><a href="crear_grafica_1"  ><button class="btn  btn-default btn-xs"><i class="fa fa-line-chart fa-lg"></i></a></button></td>
                    </tr>
                    <tr>
                      <td>2</td>
                      <td>Numero de huespedes por region y sexo</td>
                       <td><a href="crear_reporte_2/1" target="_blank" ><button class="btn btn-block btn-primary btn-xs">Ver</button></a></td>
                      <td><a href="crear_reporte_2/2" target="_blank" ><button class="btn btn-block btn-success btn-xs">Descargar</button></a></td>
                    </tr>
                    <tr>
                      <td>3</td>
                      <td>Numero de huespedes por region y motivo de viaje</td>
                      <td><a href="crear_reporte_3/1" target="_blank" ><button class="btn btn-block btn-primary btn-xs">Ver</button></a></td>
                      <td><a href="crear_reporte_3/2" target="_blank" ><button class="btn btn-block btn-success btn-xs">Descargar</button></a></td>
                    </tr>
                     <tr>
                      <td>4</td>
                      <td>Estadia promedio de Huespedes Extrajeros/Nacionales por año y mes</td>
                      <td><a href="crear_reporte_4/1" target="_blank" ><button class="btn btn-block btn-primary btn-xs">Ver</button></a></td>
                      <td><a href="crear_reporte_4/2" target="_blank" ><button class="btn btn-block btn-success btn-xs">Descargar</button></a></td>
                    </tr>
                    <tr>
                      <td>5</td>
                      <td>Estadia promedio de huespedes nacionales por año y mes</td>
                    </tr>
                   
                  </tbody></table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
 </div>
@endsection