<center>
    <div id="container4" style="width: 1150px; height: 500px;"></div>

    <script type="text/javascript">
    const datos = <?php echo json_encode(array_map('floatval', $calificaciones)); ?>;
    
    var desviacion_estandar = <?php echo $desviacion_estandar; ?>;
    
    Highcharts.chart('container4', {
        title: {
            text: 'Gráfico de Desviación Estándar'
        },
        xAxis: {
            title: {
                text: 'Puntos'
            }
        },
        yAxis: {
            title: {
                text: 'Calificación'
            }
        },
        series: [{
            name: 'Calificación',
            data: datos
        }, {
            name: 'Desviación Estándar',
            type: 'scatter',
            data: [
                [datos.length - 1, desviacion_estandar]
            ],
            marker: {
                symbol: 'circle',
                radius: 6,
                fillColor: 'red'
            },
            tooltip: {
                pointFormat: 'Desviación Estándar: {point.y}'
            }
        }]
    });
    </script>
</center>
    <div style="width: 1150px; height: 200px;"> </div>

<center>
    <div id="container5" style="width: 1150px; height: 500px;"></div>
    <script type="text/javascript">
    Highcharts.chart('container5', {
        chart: {
            type: 'pie',
            options3d: {
                enabled: true,
                alpha: 45
            }
        },
        title: {
            text: 'Medidas de posisición',
            align: 'left'
        },
        subtitle: {
            text: 'Percentil, decil y cuartil',
            align: 'left'
        },
        plotOptions: {
            pie: {
                innerSize: 100,
                depth: 45
            }
        },
        series: [{
            name: 'Posición',
            data: [
                ['Decil 1', <?php echo $d1; ?>],
                ['Quartil 1', <?php echo $q1; ?>],
                ['Percentil 15', <?php echo $p15; ?>]
    
            ]
        }]
    });
    </script>
</center>