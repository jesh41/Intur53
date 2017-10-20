<?php $sumaT = 0;
$sumaC = 0;
$sumaN = 0;
$sumaO = 0;
?>

<div class="content">
    <div class="container-fluid">
        <div class="row">


            <table class="table table-bordered">
                <thead role="row" class="text-primary">
                <tr>
                    <th colspan="5" align="center"> Reporte Por region y motivo de viaje</th>
                </tr>
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
                <?php $sumaT = $sumaT + $dato->Turismo; ?>
                <?php $sumaC = $sumaC + $dato->Congresos; ?>
                <?php $sumaN = $sumaN + $dato->Negocios; ?>
                <?php $sumaO = $sumaO + $dato->Otros; ?>
                <?php $Anio = $dato->Anio; ?>
                <?php  } ?>
                <tr>
                    <td colspan="2" align="center">GRAN TOTAL</td>

                    <td> <?php echo $sumaT; ?></td>
                    <td> <?php echo $sumaC; ?></td>
                    <td> <?php echo $sumaN; ?></td>
                    <td> <?php echo $sumaO; ?></td>
                    <td> <?php echo $sumaT + $sumaN + $sumaC + $sumaO; ?></td>
                </tr>
                <tr>
                    <td colspan="5" align="center">Fuente: INTUR con los datos de los hoteles de Managua</td>
                </tr>
                <tr>
                    <td colspan="5" align="center"> Generado {{date("Y-m-d H:i:s")}} Total Hoteles: {{$TH}}</td>
                </tr>

                </tbody>

            </table>
        </div>
    </div>


</div>
