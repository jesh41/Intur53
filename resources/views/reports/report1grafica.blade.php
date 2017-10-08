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
            text: 'Reporte por Huespedes Nacionales y Extranjeros'
        },
        xAxis: {
            categories: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre']
        },
        yAxis: {
            title: {
                text: 'Huespedes'
            }
        },
        series: [{
            name: 'Nacionales',
            data: data_click
        }, {
            name: 'Extranjeros',
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
                     <div class="card-header card-header-icon" data-background-color="rose">
                         <i class="material-icons">show_chart</i>
                     </div>

                     <div class="card-content">
                         <h4 class="title">GRAFICA HUESPEDES POR MES Y RESIDENCIA</h4>
                         <div id="container"></div>

                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>




@endsection