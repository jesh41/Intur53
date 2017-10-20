<?php $sumaF = 0;
$sumaM = 0;
?>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <table class="table table-bordered">
                <thead role="row" class="text-primary">
                <tr>
                    <th colspan="5" align="center"> Reporte Por Region y sexo</th>
                </tr>
                <tr>
                    <th>Año</th>
                    <th>Region</th>
                    <th>Femenino</th>
                    <th>Masculino</th>
                    <th>Total</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($data as $dato){ ?>

                <tr>
                    <td><?= $dato->Anio; ?></td>
                    <td><?= $dato->Region; ?></td>
                    <td><?= $dato->Femenino; ?></td>
                    <td><?= $dato->Masculino; ?></td>
                    <td><?= $dato->Femenino + $dato->Masculino; ?></td>
                </tr>
                <?php $sumaF = $sumaF + $dato->Femenino; ?>
                <?php $sumaM = $sumaM + $dato->Masculino; ?>
                <?php $Anio = $dato->Anio; ?>
                <?php  } ?>
                <tr>
                    <td colspan="2" align="center">GRAN TOTAL</td>

                    <td> <?php echo $sumaF; ?></td>
                    <td> <?php echo $sumaM; ?></td>
                    <td> <?php echo $sumaM + $sumaF; ?> </td>
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



