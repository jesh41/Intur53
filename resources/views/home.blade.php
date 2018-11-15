@extends('layouts.new')

@section('content')

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
            </div>
        </div>
    </div>


@endsection