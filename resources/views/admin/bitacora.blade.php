@extends('layouts.new')

@section('content')
    <?php $s1 = 0;
    $s2 = 0;
    $s3=0;
    $s4=0;
    ?>
    <div class="content">
        <div class="container-fluid">
            <div class="row">







                <div class="col-md-10 col-md-offset-1">
                    <div class="card">
                        <div class="card-header card-header-icon" data-background-color="blue2">
                            <i class="material-icons">signal_cellular_no_sim</i>
                        </div>
                        <div class="card-content">
                            <h4 class="card-title">Detalle Anulaciones</h4>
                            <div class="tab-content">
                                <div class="tab-pane active table-responsive ">
                                    <table id="datatables3" class="table table-striped table-no-bordered table-hover"
                                    cellspacing="0" width="100%" style="width:100%">
                                        <thead role="row" class="text-primary">
                                        <tr>
                                            <th>id</th>
                                            <th>Book id</th>
                                            <th>Observacion</th>
                                            <th>Anulado Por</th>
                                            <th>Fecha Anulacion</th>
                                            <th>Accion</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($annulments as $annulment)
                                            <tr role="row" class="odd">
                                                <td>{{ $annulment->id }}</td>
                                                <td>{{ $annulment->book_id }}</td>
                                                <td>{{ $annulment->observacion }}</td>
                                                <td>{{ $annulment->Elaborado }}</td>
                                                <td>{{ $annulment->created_at }}</td>
                                                <td><a href="{{url("descargar/$annulment->book_id")}}" type="button"
                                                       class="btn  btn-info btn-sm " title="Descargar"> <i
                                                                class="material-icons">cloud_download</i></a></td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>





                <div class="col-md-5 col-md-offset-1">
                    <div class="card">
                        <div class="card-header" data-background-color="blue2">
                            <h4 class="card-title">Anulaciones de libros {{$year}}</h4>
                            <p class="category">  </p>
                        </div>
                        <div class="card-content table-responsive table-full-width">
                            <table class="table" >
                                <thead class="text-danger">
                                <th style="text-align: center; vertical-align: middle;">Hotel</th>
                                <th style="text-align: center; vertical-align: middle;">Usuario</th>
                                <th style="text-align: center; vertical-align: middle;">Incorrecto</th>
                                <th style="text-align: center; vertical-align: middle;">Desactualizado</th>
                                <th style="text-align: center; vertical-align: middle;">Total</th>

                                </thead>
                                <tbody>
                                <?php foreach($data2 as $dato){ ?>
                                <tr>
                                    <td style="text-align: center; vertical-align: middle;"><?= $dato->hotel; ?></td>
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

                        </div>
                    </div>

                </div>
                <div class="col-md-5 ">
                    <div class="card">
                        <div class="card-header" data-background-color="blue2">
                            <h4 class="card-title">Estado de los libros del {{$year}}</h4>
                            <p class="category"> Hoteles registrados: {{$TH}} </p>
                        </div>
                        <div class="card-content table-responsive table-full-width">
                            <table class="table" >
                                <thead class="text-danger">
                                <th style="text-align: center; vertical-align: middle;">Mes</th>
                                <th style="text-align: center; vertical-align: middle;">Validos</th>
                                <th style="text-align: center; vertical-align: middle;">Anulados</th>
                                <th style="text-align: center; vertical-align: middle;">Total</th>

                                </thead>
                                <tbody>
                                <?php foreach($data as $dato){ ?>

                                <tr>
                                    <td style="text-align: center; vertical-align: middle;"><?= $dato->mes; ?></td>
                                    <td style="text-align: center; vertical-align: middle;"><?= $dato->vivos; ?></td>
                                    <td style="text-align: center; vertical-align: middle;"><?= $dato->anulados; ?></td>
                                    <td style="text-align: center; vertical-align: middle;"><?= $dato->total; ?></td>

                                </tr>
                                <?php $s1 = $s1 + $dato->vivos; ?>
                                <?php $s2 = $s2 + $dato->anulados; ?>
                                <?php  } ?>
                                <tr class="info">
                                    <td  style="text-align: center; vertical-align: middle;">GRAN TOTAL</td>
                                    <td style="text-align: center; vertical-align: middle;"> <?php echo $s1; ?></td>
                                    <td style="text-align: center; vertical-align: middle;"> <?php echo $s2; ?></td>
                                    <td style="text-align: center; vertical-align: middle;"> <?php echo $s1+$s2; ?></td>


                                </tr>

                                </tbody>
                            </table>

                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

@endsection



              