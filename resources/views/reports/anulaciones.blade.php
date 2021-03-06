<!DOCTYPE html>
<html lang="en"><head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="https://www.intur.gob.ni/wp-content/uploads/2015/09/favicon1.ico" />
    <title>Reporte Bitacora Anulaciones</title>
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
    <h4 style="text-align: left;"><img src="{{ url('/images/Nic.png') }}" width="131" height="85" alt="lOGO">SISTEMA
        DE ESTADISTICAS DE HOTELES EN MANAGUA <img src="{{ url('/images/Statistics512.png') }}" width="81"
                                                   height="99"></h4>
</head><body>
<?php $s1 = 0;
$s2 = 0;
$s3=0;
$s4=0;
?>
<div class="col-md-12">
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Reporte Bitacora de anulaciones por usuario {{$year}} </h3>
        </div><!-- /.box-header -->
        <div class="box-body">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th style="text-align: center; vertical-align: middle;">Hotel</th>
                    <th style="text-align: center; vertical-align: middle;">Usuario</th>
                    <th style="text-align: center; vertical-align: middle;">Incorrecto</th>
                    <th style="text-align: center; vertical-align: middle;">Desactualizado</th>
                    <th style="text-align: center; vertical-align: middle;">Total</th>

                </tr>
                </thead>
                <tbody>
                <?php foreach($data as $dato){ ?>
                <tr>
                    <td style="text-align: center; vertical-align: middle;">
                        @if ($dato->hotel)
                            {{ $dato->hotel}}
                        @else
                            -
                        @endif
                    </td>

                    <td style="text-align: center; vertical-align: middle;"><?= $dato->usuario; ?></td>
                    <td style="text-align: center; vertical-align: middle;"><?= $dato->incorrecto; ?></td>
                    <td style="text-align: center; vertical-align: middle;"><?= $dato->desactualizado; ?></td>
                    <td style="text-align: center; vertical-align: middle;"><?= $dato->total; ?></td>
                </tr>
                <?php $s3 = $s3 + $dato->incorrecto; ?>
                <?php $s4 = $s4 + $dato->desactualizado; ?>
                <?php  } ?>
                <tr class="info">

                    <td colspan="2" style="text-align: center; vertical-align: middle;" >GRAN TOTAL</td>
                    <td style="text-align: center; vertical-align: middle;"> <?php echo $s3; ?></td>
                    <td style="text-align: center; vertical-align: middle;"> <?php echo $s4; ?></td>
                    <td style="text-align: center; vertical-align: middle;"> <?php echo $s3+$s4; ?></td>
                </tr>


                </tbody>

            </table>
        </div><!-- /.box-body -->
        <div class="box-footer clearfix">
            <p> </p>
            <p> Bitacora de anulaciones por usuario {{$year}}</p>
            Generado {{date("Y-m-d H:i:s")}}
        </div>
    </div><!-- /.box -->


</div>


</body></html>


