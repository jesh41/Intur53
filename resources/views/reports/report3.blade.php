<!DOCTYPE html>
<html lang="en"><head>
	<meta charset="UTF-8">
	<title>Reporte Por Residencia</title>
<style>
 
 .col-md-12 {
    width: 100%;
} 

.box {
    position: relative;
    border-radius: 3px;
    background: #ffffff;
    border-top: 3px solid #d2d6de;
    margin-bottom: 20px;
    width: 100%;
    box-shadow: 0 1px 1px rgba(0,0,0,0.1);
    background-color: #ECF0F5;
}

.box-header {
    color: #444;
    display: block;
    padding: 10px;
    position: relative;
}

.box-header.with-border {
    border-bottom: 1px solid #f4f4f4;
}


.box-header .box-title {
    display: inline-block;
    font-size: 18px;
    margin: 0;
    line-height: 1;
}

.box-body {
    border-top-left-radius: 0;
    border-top-right-radius: 0;
    border-bottom-right-radius: 3px;
    border-bottom-left-radius: 3px;
    padding: 10px;

}


.box-footer {
    border-top-left-radius: 0;
    border-top-right-radius: 0;
    border-bottom-right-radius: 3px;
    border-bottom-left-radius: 3px;
    border-top: 1px solid #f4f4f4;
    padding: 10px;
    background-color: #fff;
}


.table-bordered {
    border: 2px solid #f4f4f4;
}


.table {
    width: 100%;
    max-width: 100%;
    margin-bottom: 20px;
    border-color: black;
}

table {
    background-color: transparent;
}

 .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>tbody>tr>td, .table-bordered>tfoot>tr>td {
    border: 2px solid #f4f4f4;
}


.badge {
    display: inline-block;
    min-width: 10px;
    padding: 3px 7px;
    font-size: 12px;
    font-weight: 700;
    line-height: 1;
    color: #fff;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    background-color: #777;
    border-radius: 10px;
}

.bg-red {
    background-color: #dd4b39 !important;
}


</style>
    <h1 style="text-align: left;"><img src="{{ url('/images/Nic.png') }}" width="131" height="85" alt="lOGO">SISTEMA
        DE ESTADISTICAS DE HOTELES EN MANAGUA <img src="{{ url('/images/Statistics512.png') }}" width="81"
                                                   height="99"></h1>
</head><body>
<?php $sumaT=0;
$sumaC=0;
$sumaN=0;
$sumaO=0;
 ?>
<div class="col-md-12">
              <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Reporte Por region y motivo de viaje</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table class="table table-bordered">
                  <thead>
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
                     <?php $sumaT=$sumaT+$dato->Turismo; ?>
                      <?php $sumaC=$sumaC+$dato->Congresos; ?>
                       <?php $sumaN=$sumaN+$dato->Negocios; ?>
                      <?php $sumaO=$sumaO+$dato->Otros; ?>
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
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                    <p> Fuente: INTUR con los datos de los hoteles de Managua</p>
                    <p> Informe: 03 Huespedes por region y motivo de viaje</p>
                    Generado {{date("Y-m-d H:i:s")}}
                </div>
              </div><!-- /.box -->

              
            </div>


</body></html>


