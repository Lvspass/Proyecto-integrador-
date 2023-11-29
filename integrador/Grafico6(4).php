<?php include('proyectoV2.php'); //tiene la barra de navegación

$csvFile = 'datosCarreras.csv';
$csvData = file_get_contents($csvFile);
$rows = str_getcsv($csvData, "\n");
$data = array();
$aprobados = 0;
$noAprobados = 0;
$mujeres = 0;
$hombres = 0;
$noMujeres = 0;
$noHombres = 0;
$tercer = 0;
$noTercer = 0;
$quinto = 0;
$noQuinto = 0;
$septimo = 0;
$noSeptimo = 0; 

foreach($rows as $row){
    $data[] = str_getcsv($row, ", ");
}
?>
<!DOCTYPE HTML>
<html>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Análisis del Desempeño en Cálculo Diferencial para Estudiantes de Ingeniería Mecatrónica</title>
    <link rel="stylesheet" href="letralo.css">
    <link rel="stylesheet" href="css/bootstrap.css">

    <?php include('estilograficas.php')?>
</head>

<body>

<!-- un ciclo seguido de una serie de combinaciones de if para recolectar la cantidad de estudiantes de la carrera que aprobaron o no -->
    <?php 
        $x = count($data) ;
        for($i=0; $i<$x; $i++): ?>

    <?php  
        if($data[$i][1] == "Ingeniería mecatrónica" && $data[$i][4] == "Si"){
        $aprobados = $aprobados +1;
        }
        else if($data[$i][1] == "Ingeniería mecatrónica" && $data[$i][4] == "No"){
        $noAprobados = $noAprobados +1;
        }
        
        ?>

    <?php  
        if($data[$i][1] == "Ingeniería mecatrónica" && $data[$i][3] == "Mujer" && $data[$i][4] == "Si"){
        $mujeres = $mujeres +1;
        }
        else if($data[$i][1] == "Ingeniería mecatrónica" && $data[$i][3] == "Mujer" && $data[$i][4] == "No"){
        $noMujeres = $noMujeres +1;
        }
        else if($data[$i][1] == "Ingeniería mecatrónica" && $data[$i][3] == "Hombre" && $data[$i][4] == "Si"){
        $hombres = $hombres +1;
        }
        else if($data[$i][1] == "Ingeniería mecatrónica" && $data[$i][3] == "Hombre" && $data[$i][4] == "No"){
        $noHombres = $noHombres +1;
        }
        
            ?>

    <?php  
        if($data[$i][1] == "Ingeniería mecatrónica" && $data[$i][2] == "Tercero" && $data[$i][4] == "Si"){
        $tercer = $tercer +1;
        }
        else if($data[$i][1] == "Ingeniería mecatrónica" && $data[$i][2] == "Tercero" && $data[$i][4] == "No"){
        $noTercer = $noTercer +1;
        }
        else if($data[$i][1] == "Ingeniería mecatrónica" && $data[$i][2] == "Quinto" && $data[$i][4] == "Si"){
        $quinto = $quinto +1;
        }
        else if($data[$i][1] == "Ingeniería mecatrónica" && $data[$i][2] == "Quinto" && $data[$i][4] == "No"){
        $noQuinto = $noQuinto +1;
        }
        else if($data[$i][1] == "Ingeniería mecatrónica" && $data[$i][2] == "Séptimo" && $data[$i][4] == "Si"){
        $septimo = $septimo +1;
        }
        else if($data[$i][1] == "Ingeniería mecatrónica" && $data[$i][2] == "Séptimo" && $data[$i][4] == "No"){
        $noSeptimo = $noSeptimo +1;
        }
        
        ?>

    <?php endfor ?>


    <?php
    // Filtro calificaciones solo para la carrera deseada 
    $calificaciones = array();
    foreach ($data as $row) {
        if ($row[1] == "Ingeniería mecatrónica") {
            $calificacion = floatval($row[6]); 
            $calificaciones[] = $calificacion;
        }
    }

    $calificaciones = array_map('intval', $calificaciones);

    // Calcular media, mediana y moda
    $media = array_sum($calificaciones) / count($calificaciones);

    sort($calificaciones);
    $count = count($calificaciones);
    $mediana = ($calificaciones[floor(($count - 1) / 2)] + $calificaciones[ceil(($count - 1) / 2)]) / 2;

    $frecuencias = array_count_values($calificaciones);
    arsort($frecuencias);
    $moda = key($frecuencias);


    // Calcular desviación estándar
    $sum = 0;
    foreach ($calificaciones as $calificacion) {
        $sum += pow($calificacion - $media, 2);
    }
    $variance = $sum / count($calificaciones);
    $desviacion_estandar = sqrt($variance);
    
    
     // Ordenar las calificaciones de manera ascendente
    sort($calificaciones);
    
    // Calcular la posición del primer cuartil (Q1)
    $n = count($calificaciones);
    $posicion_q1 = (1 * ($n + 1)) / 4;
    
    // Si la posición es un número decimal, tomar el promedio de los valores en las posiciones correspondientes
    if (is_float($posicion_q1)) {
        $posicion_inf = floor($posicion_q1);
        $posicion_sup = ceil($posicion_q1);
        $q1 = ($calificaciones[$posicion_inf - 1] + $calificaciones[$posicion_sup - 1]) / 2;
    } else {
        // Si la posición es un número entero, el cuartil está en esa posición
        $q1 = $calificaciones[$posicion_q1 - 1];
    }
        
    
    // Calcular la posición del primer decil (D1)
    $n = count($calificaciones);
    $posicion_d1 = (1 * ($n + 1)) / 10;
    
    // Si la posición es un número decimal, tomar el promedio de los valores en las posiciones correspondientes
    if (is_float($posicion_d1)) {
        $posicion_inf = floor($posicion_d1);
        $posicion_sup = ceil($posicion_d1);
        $d1 = ($calificaciones[$posicion_inf - 1] + $calificaciones[$posicion_sup - 1]) / 2;
    } else {
        // Si la posición es un número entero, el decil está en esa posición
        $d1 = $calificaciones[$posicion_d1 - 1];
    }
        
    
    // Calcular la posición del percentil 15 (P15)
    $n = count($calificaciones);
    $posicion_p15 = (15 * ($n + 1)) / 100;
    
    // Si la posición es un número decimal, tomar el promedio de los valores en las posiciones correspondientes
    if (is_float($posicion_p15)) {
        $posicion_inf = floor($posicion_p15);
        $posicion_sup = ceil($posicion_p15);
        $p15 = ($calificaciones[$posicion_inf - 1] + $calificaciones[$posicion_sup - 1]) / 2;
    } else {
        // Si la posición es un número entero, el percentil está en esa posición
        $p15 = $calificaciones[$posicion_p15 - 1];
    }
    
    ?>


    <script src="code/highcharts.js"></script>
    <script src="code/modules/exporting.js"></script>
    <script src="code/modules/data.js"></script>
    <script src="code/modules/export-data.js"></script>
    <script src="code/modules/accessibility.js"></script>

    <header>
        <h1><strong>Análisis del Desempeño en Cálculo Diferencial para Estudiantes de Ingeniería Mecatrónica</strong>
        </h1>
    </header>

    <center>

    <p><strong>Introducción:</strong></p>

    <p>
        El Cálculo Diferencial desempeña un papel fundamental en la formación de los estudiantes de Ingeniería
        Mecatrónica en el Instituto Tecnológico Superior de Teziutlán (ITST). Esta disciplina proporciona las bases
        matemáticas esenciales para comprender conceptos avanzados y desempeña un papel crucial en el diseño y control
        de sistemas mecatrónicos.
    <div>
        <img src="imagenes/im4.jpeg" alt="Descripción de la imagen" style="max-width: 30%; height: auto;">
    </div>
    </p>

    <p><strong>Desempeño General:</strong></p>

    <p>
        En el último periodo académico, se llevó a cabo un análisis exhaustivo del desempeño de los estudiantes de
        Ingeniería Mecatrónica en Cálculo Diferencial. Los resultados revelaron aspectos destacados y desafíos
        importantes que demandan atención y acción.
    </p>

    <p><strong>Éxito y Desafíos:</strong></p>

    <p>
        Se evidenció un éxito destacado en muchos estudiantes, subrayando su comprensión y aplicación de los conceptos
        clave en Cálculo Diferencial. No obstante, también se identificaron áreas específicas que presentaron desafíos
        para algunos alumnos, especialmente en su aplicación a sistemas mecatrónicos.
    </p>

    <p><strong>Factores Contribuyentes:</strong></p>

    <p>
        Al profundizar en el análisis, se identificaron diversos factores que podrían haber influido en el desempeño
        variado de los estudiantes de Ingeniería Mecatrónica. Entre estos factores se incluyen:
    </p>

    <ol>
        <li><strong>Relevancia en Mecatrónica:</strong> Algunos estudiantes experimentaron dificultades al comprender la
            aplicación directa de los conceptos de Cálculo Diferencial en el diseño y control de sistemas mecatrónicos.
        </li>
        <li><strong>Metodologías de Enseñanza:</strong> Se está evaluando la efectividad de las metodologías de
            enseñanza utilizadas en el curso, considerando enfoques más prácticos y aplicados a la Ingeniería
            Mecatrónica.</li>
        <li><strong>Apoyo Académico:</strong> Se está fortaleciendo el apoyo académico con sesiones de tutoría, grupos
            de estudio y recursos en línea para ayudar a los estudiantes a superar desafíos específicos.</li>
    </ol>

    <p><strong>Acciones Tomadas y Planes Futuros:</strong></p>

    <p>
        Como respuesta a estos hallazgos, se han implementado medidas para abordar los desafíos identificados,
        incluyendo programas de apoyo académico, ajustes en las metodologías de enseñanza y desarrollo de recursos
        educativos adicionales, enfocados en el contexto mecatrónico.
    </p>

    <p><strong>Conclusiones:</strong></p>

    <p>
        El análisis del desempeño en Cálculo Diferencial para estudiantes de Ingeniería Mecatrónica proporciona valiosas
        perspectivas para mejorar continuamente la calidad de la educación en nuestro instituto. A través de medidas
        proactivas y adaptativas, estamos comprometidos a garantizar que cada estudiante alcance su máximo potencial en
        esta disciplina crucial para la Ingeniería Mecatrónica.
    </p>

    <p>
        Este análisis es parte de nuestro compromiso continuo con la excelencia académica y la mejora constante de los
        programas educativos en el ITST.
    </p>

    </center>

    <center>
    <figure class="highcharts-figure">
        <div id="container"></div>
        
    </figure>


    <script type="text/javascript">
    Highcharts.chart('container', {
    chart: {
        type: 'pie',
        options3d: {
            enabled: true,
            alpha: 45,
            beta: 0
        }
    },
    title: {
        text: 'Aprobados de la carrera',
        align: 'center'
    },
    subtitle: {
        text: 'Mecatronica',
        align: 'center'
    },
    accessibility: {
        point: {
            valueSuffix: '%'
        }
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            depth: 35,
            dataLabels: {
                enabled: true,
                format: '{point.name}'
            }
        }
    },
    series: [{
        type: 'pie',
        name: 'Share',
        data: [
            ['Aprobados', <?php echo $aprobados; ?>],
            ['No aprobados', <?php echo $noAprobados; ?>]
        ]
    }]
});

    </script>
    </center>

    <?php include('graficas.php');?> <!-- contiene tablas y graficas para saber por genero y por semestre -->


    <center>
        <figure class="highcharts-figure">
            <div id="container1" style="width: 1150px; height: 500px;"></div>

            <table id="tabla1" class="table table-striped table-bordered border-dark " style="width: 1150px; height: 200px;">
                <thead>
                    <th> </th>
                    <th>Calificación</th>
                </thead>
                <tbody>
                    <tr>
                        <td>(Media) <br>
                        En promedio los estudiantes del TEC tienen una calificación de <?php echo $media ?>
                        </td>
                        <td><?php echo $media?></td>
                    </tr>
                    <tr>
                        <td>(Mediana) <br>
                        La mitad de los estudiantes tiene una calificación mayor a <?php echo $mediana ?> y la otra mitad menos de <?php echo $mediana ?>
                        </td>
                        <td><?php echo $mediana?></td>
                    </tr>
                    <tr>
                        <td>(Moda) <br>
                        Regularmente los estudiantes obtienen una calificación de <?php echo $moda ?>
                        </td>
                        <td><?php echo $moda?></td>
                    </tr>
                </tbody>
        </figure>
        </table>

        <script type="text/javascript">
        Highcharts.chart('container1', {
            data: {
                table: 'tabla1'
            },
            chart: {
                type: 'column'
            },
            title: {
                text: 'Medidas de posición central sobre la calificación en "Calculo diferencial"'
            },
            subtitle: {
                text: 'Mecatronica'
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
                    colors: ['#ff0000', '#00ff00']
                }
            }
        });
        </script>
    </center>
    
    <?php include('graficas2.php');?>

    <div style="width: 1150px; height: 50px;"></div>
    
    
    <ul>
        <li>
        El primer decil de <?php echo $d1 ?> puntos indica que el 10% más bajo de las calificaciones está por debajo 
        o igual a <?php echo $d1 ?> puntos, mientras que el 90% restante tiene calificaciones superiores a este valor.
        </li>
        <li>
        El primer cuartil de <?php echo $q1 ?> puntos indica que el 25% más bajo de las calificaciones está por debajo o igual a 
        <?php echo $q1 ?> puntos, mientras que el 75% restante tiene calificaciones superiores a este valor.
        </li>
        <li>
        El quinceavo percentil de <?php echo $p15 ?> puntos indica que el 15% más bajo de las calificaciones está por debajo o igual a <?php echo $p15 ?> puntos, 
        mientras que el 85% restante tiene calificaciones superiores a este valor.
        </li>
    </ul>

</body>

</html>