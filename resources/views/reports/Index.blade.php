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
                    </tr></thead>
                    <tbody>
                    <tr>
                      <td>1</td>
                      <td>Numero de Huespedes por mes y por residencia</td>
                      <td><a href="crear_reporte_1/1" target="_blank" ><button class="btn btn-block btn-primary btn-xs">Ver</button></a></td>
                      <td><a href="crear_reporte_1/2" target="_blank" ><button class="btn btn-block btn-success btn-xs">Descargar</button></a></td>
                    </tr>
                    <tr>
                      <td>2</td>
                      <td>Temporada por sexo, region y motivo de viaje </td>
                    </tr>
                     <tr>
                      <td>3</td>
                      <td>Estadia promedio de Huespedes Extrajeros por mes y pais de residencia</td>
                    </tr>
                    <tr>
                      <td>4</td>
                      <td>Estadia promedio de huespedes nacionales por mes y departamento</td>
                    </tr>
                   
                  </tbody></table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
 </div>
@endsection