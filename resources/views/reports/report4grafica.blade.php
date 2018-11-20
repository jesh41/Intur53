@extends('layouts.new')

@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <script type="text/javascript">
        $(function () {
            var A = <?php echo $EX; ?>;
            var B = <?php echo $NA; ?>;
            var C = <?php echo $GE; ?>;

            $('#container').highcharts({
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Reporte estadia promedio'
                },
                xAxis: {
                    categories: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre']
                },
                yAxis: {
                    title: {
                        text: 'Estadia'
                    }
                },
                series: [{
                    name: 'Extranjero',
                    data: A
                }, {
                    name: 'Nacional',
                    data: B
                }, {
                    name: 'General',
                    data: C
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
                            <h4 class="title">GRAFICA ESTADI PROMEDIO HUESPEDES NACIONALES/EXTRANJEROS AÑO {{$y}} </h4>
                            <div id="container"></div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection