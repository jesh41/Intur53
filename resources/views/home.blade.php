@extends('layouts.new')

@section('content')
    <?php $s1 = 0;
    $s2 = 0;
    ?>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="card">
                        <div class="card-content">
                            <h3 class="card-title">Bienvenido {{ Auth::user()->name }} al sistema de indicadores
                                estadisticos hotelero</h3>
                            <p style="text-align: justify;">Sistema de indicadores estadísticos en hoteles, aparta
                                hoteles y alojamientos turísticos (5 a 1 Estrellas), de Managua; tiene como objetivo
                                crear indicadores en tiempo oportuno sobre el impacto y desarrollo del sector hotelero,
                                de esta forma se podrá emplear de manera eficaz la evaluación y monitoreo en planes o
                                estrategias de mercadeo, para el mejoramiento de los programas y las tomas de
                                decisiones.
                            <p style="text-align: justify;font-size:11pt">La recopilación de los libros de registros de
                                huéspedes en formato Excel tendrá un impacto positivo en la generación de las
                                estadísticas, siendo de gran utilidad para la emisión de informes e insumos para el
                                boletín anual de la actividad hotelera, potencializando el proyecto a rutas turísticas
                                del país.
                    </p>
                        </div>






                </div>
            </div>
                @role('administrador')
                <div class="col-md-5 col-md-offset-1">
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


                <div class="col-md-5 ">
                    <div class="card">
                        <div class="card-header" data-background-color="blue2">
                            <h4 class="card-title">Anulaciones de libros{{$year}}</h4>
                            <p class="category">  </p>
                        </div>
                        <div class="card-content table-responsive table-full-width">
                            <table class="table" >
                                <thead class="text-danger">
                                <th style="text-align: center; vertical-align: middle;">Hotel</th>
                                <th style="text-align: center; vertical-align: middle;">Incorrecto</th>
                                <th style="text-align: center; vertical-align: middle;">Desactualizado</th>
                                <th style="text-align: center; vertical-align: middle;">Total</th>

                                </thead>
                                <tbody>


                                <tr>

                                </tr>

                                <tr class="info">
                                    <td  style="text-align: center; vertical-align: middle;">GRAN TOTAL</td>
                                </tr>

                                </tbody>
                            </table>

                        </div>
                    </div>

                </div>
                @endrole
            </div>
    </div>
    </div>


@endsection