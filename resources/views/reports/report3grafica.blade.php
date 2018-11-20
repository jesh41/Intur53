@extends('layouts.new')

@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <script type="text/javascript">
        $(function () {
            var A = <?php echo $tu; ?>;
            var B = <?php echo $co; ?>;
            var C = <?php echo $ne; ?>;
            var D = <?php echo $ot; ?>;
            $('#container').highcharts({
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Reporte huespedes'
                },
                xAxis: {
                    categories: ['Norte America', 'Centro America', 'Sur America', 'El Caribe', 'Europa', 'Asia', 'Africa', 'Oceania']
                },
                yAxis: {
                    title: {
                        text: 'Huespedes'
                    }
                },
                series: [{
                    name: 'Turismo',
                    data: A
                }, {
                    name: 'Congreso',
                    data: B
                }, {
                    name: 'Negocio',
                    data: C
                }, {
                    name: 'Otro',
                    data: D
                }
                ]
            });
        });
    </script>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="card">
                        <div class="card-header card-header-icon" data-background-color="blue2">
                            <i class="material-icons">show_chart</i>
                        </div>

                        <div class="card-content">
                            <h4 class="title">GRAFICA HUESPEDES POR REGION Y MOTIVO DE VIAJE AÑO {{$y}}</h4>
                            <div id="container"></div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection