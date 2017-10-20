<div class="content">
    <div class="container-fluid">
        <div class="row">
            <table class="table table-bordered">
                <thead role="row" class="text-primary">
                <tr>
                    <th colspan="5" align="center">Reporte de estadia promedio por mes, residencia y total</th>
                </tr>
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
    <div class="card-footer">Generado {{date("Y-m-d H:i:s")}} Total Hoteles: {{$TH}}
        <a href="/crear_reporte_4/1/{{$Anio}}" target="_blank">
            <button class="btn  btn-info btn-xs" rel="tooltip" data-placement="right" title="Descargar">
                <i
                        class="fa fa-cloud-download fa-lg"></i>
            </button>
        </a>
        <a href="{{url("/reporte_exce_4/$Anio")}}" target="_blank">
            <button class="btn  btn-info btn-xs" rel="tooltip" data-placement="right"
                    title="Descargar"><i class="material-icons">picture_as_pdf</i>
            </button>
        </a>
    </div>


</div>
