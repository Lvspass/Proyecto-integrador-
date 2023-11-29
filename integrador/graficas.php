<center>
    <figure class="highcharts-figure">
        <div id="container2" style="width: 1150px; height: 500px;"></div>
        <table id="messi" class="table table-striped table-bordered border-dark " style="width: 1150px; height: 100px;">
            <thead>
                <th> </th>
                <th>Tamaño</th>
            </thead>
            <tbody>
                <tr>
                    <td>Mujeres aprobadas</td>
                    <td><?php echo $mujeres?></td>
                </tr>
                <tr>
                    <td>Mujeres no aprobadas</td>
                    <td><?php echo $noMujeres?></td>
                </tr>
                <tr>
                    <td>Hombres aprobados</td>
                    <td><?php echo $hombres?></td>
                </tr>
                <tr>
                    <td>Hombres no aprobados</td>
                    <td><?php echo $noHombres?></td>
                </tr>


            </tbody>
    </figure>
    </table>
    <script type="text/javascript">
    Highcharts.chart('container2', {
        data: {
            table: 'messi'
        },
        chart: {
            type: 'column'
        },
        title: {
            text: 'Aprobados de la carrera '
        },
        subtitle: {
            text: 'Por sexo'
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            allowDecimals: false,
            title: {
                text: ''
            }
        },
        plotOptions: {
            column: {
                colorByPoint: true,
                colors: ['#00ff00', '#ff0000']
            }
        }
    });
    </script>
</center>
<center>
    <figure class="highcharts-figure">
        <div id="container3" style="width: 1150px; height: 500px;"></div>
        <table id="neymar" class="table table-striped table-bordered border-dark " style="width: 1150px; height: 100px;">
            <thead>
                <th> </th>
                <th>Tamaño</th>
            </thead>
            <tbody>
                <tr>
                    <td>Tercer semestre aprobados</td>
                    <td><?php echo $tercer?></td>
                </tr>
                <tr>
                    <td>Tercer semestre no aprobados</td>
                    <td><?php echo $noTercer?></td>
                </tr>
                <tr>
                    <td>Quinto semestre aprobados</td>
                    <td><?php echo $quinto?></td>
                </tr>
                <tr>
                    <td>Quinto semestre no aprobados</td>
                    <td><?php echo $noQuinto?></td>
                </tr>
                <tr>
                    <td>Septimo semestre aprobados</td>
                    <td><?php echo $septimo?></td>
                </tr>
                <tr>
                    <td>Septimo semestre no aprobados</td>
                    <td><?php echo $noSeptimo?></td>
                </tr>



            </tbody>
    </figure>
    </table>
    <script type="text/javascript">
    Highcharts.chart('container3', {
        data: {
            table: 'neymar'
        },
        chart: {
            type: 'column'
        },
        title: {
            text: 'Aprobados de la carrera '
        },
        subtitle: {
            text: 'Por semestre'
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            allowDecimals: false,
            title: {
                text: ''
            }
        },
        plotOptions: {
            column: {
                colorByPoint: true,
                colors: ['#00ff00', '#ff0000']
            }
        }
    });
    </script>
</center>