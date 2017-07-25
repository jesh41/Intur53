@extends('layouts.hom')

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
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">GRAFICA HUESPEDES POR REGION Y SEXO</div>
                    <div class="panel-body">
                        <div id="container"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection