@extends('layouts.new')

@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <script type="text/javascript">
        $(function () {
            var data_click = <?php echo $click; ?>;
            var data_viewer = <?php echo $viewer; ?>;
            $('#container').highcharts({
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Reporte huespedes por region y sexo'
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
                    name: 'Hombre',
                    data: data_click
                }, {
                    name: 'Mujer',
                    data: data_viewer
                }]
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
                            <h4 class="title">GRAFICA HUESPEDES POR REGION Y SEXO AÑO {{$y}}</h4>
                            <div id="container"></div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection