function prueba() { 
        
    $('#container').highcharts({

    chart: {

        type: 'column',

        options3d: {

            enabled: true,

            alpha: 10,

            beta: 25,

            depth: 70

        }

    },

    title: {

        text: '3D chart'

    },

    subtitle: {

        text: 'Add text here'

    },

    plotOptions: {

        column: {

            depth: 25

        }

    },

    xAxis: {

        categories: Highcharts.getOptions().lang.shortMonths

    },

    yAxis: {

        title: {

            text: null

        }

    },

    series: [{

        name: 'Ns ',

        data: [2, 3, null, 4, 0, 5, 1, 4, 6, 3]

    }]

});
  
}