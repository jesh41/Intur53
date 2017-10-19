<?php $sumanac = 0;
$sumaext = 0;
?>
<div class="content">
    <div class="container-fluid">
        <div class="row">

            <table class="table table-bordered">
                <thead role="row" class="text-primary">
                <tr>
                    <th colspan="5" align="center"> Reporte por Huespedes Nacionales y Extranjeros</th>
                </tr>
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
</div>