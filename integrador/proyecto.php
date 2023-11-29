<?php
$csvFile = 'datosCarreras.csv';
$csvData = file_get_contents($csvFile);
$rows = str_getcsv($csvData, "\n");
$data = array();

foreach ($rows as $row) {
    $data[] = str_getcsv($row, ", ");
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Promedios del ITST</title>
    <link rel="stylesheet" href="css/bootstrap.css">

    <?php include('estilograficas.php') ?>
    <!-- Contiene los estilos necesarios para las gráficas -->

    <link rel="stylesheet" href="letralo.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
            color: #333;
        }

        header {
            background-color: #349e5e;
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        h1 {
            font-size: 2em;
            margin-bottom: 10px;
        }

        p {
            font-size: 1.2em;
            line-height: 1.6;
        }

        img {
            max-width: 100%;
            height: auto;
            display: block;
            margin: 20px auto;
        }

        #inicio {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        div {
            text-align: center;
        }

        div img {
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>

    <header>
        <img src="imagenes/logo.jpg" alt="tecnm">
        <h1>Promedios de las carreras del Instituto Tecnológico Superior de Teziutlan</h1>
    </header>

    <!-- Contiene la barra de navegación -->
    <?php include('proyectoV2.php') ?>

    <div id="inicio" class="tab-content active">

        <h2>Introducción</h2>

        <p>
            El Instituto Tecnológico Superior de Teziutlán (ITST) ofrece diversas carreras, cada una con enfoques
            distintos en el ámbito laboral. Debido a esto, los planes de estudio de cada carrera incluyen materias
            específicas acordes a su orientación. Sin embargo, hay materias que se imparten en la mayoría de las
            carreras, como Cálculo Diferencial. Esta asignatura suele tener altos índices de reprobación entre los
            estudiantes de las distintas carreras del ITST, lo que la convierte en uno de los principales retos
            académicos para muchos alumnos. El contenido y nivel de complejidad del Cálculo Diferencial, sumado a la
            transición de los estudiantes del nivel medio superior al nivel superior, contribuyen a que esta materia
            represente un desafío importante para los jóvenes que inician su formación profesional en el instituto.
        </p>

        <div>
            <img src="imagenes/mapache.jpg" alt="Descripción de la imagen">
            <h1>Mapaches 💚</h1>
        </div>

    </div>

    <?php
    // Calcular las medidas de tendencia central
    $calificaciones = array_column($data, 6);

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

    <?php include('scripts.php') ?>
    <!-- Tiene los scripts para las gráficas -->

    <center>
        <!-- Tabla para poner los datos de las medidas -->
        <figure class="highcharts-figure">
            <div id="container" style="width: 1150px; height: 500px;"></div>

            <table id="tabla" class="table table-striped table-bordered border-dark " style="width: 1150px; height: 200px;">
                <thead>
                    <th> </th>
                    <th>Calificación</th>
                </thead>
                <tbody>
                    <tr>
                        <td>(Media) <br>
                        En promedio los estudiantes del TEC tienen una calificación de <?php echo $media ?>
                        </td>
                        <td><?php echo $media ?></td>
                    </tr>
                    <tr>
                        <td>(Mediana) <br>
                        La mitad de los estudiantes tiene una calificación mayor a <?php echo $mediana ?> y la otra mitad menos de <?php echo $mediana ?>
                        </td>
                        <td><?php echo $mediana ?></td>
                    </tr>
                    <tr>
                        <td>(Moda) <br>
                        Regularmente los estudiantes obtienen una calificación de <?php echo $moda ?>
                        </td>
                        <td><?php echo $moda ?></td>
                    </tr>
                </tbody>
            </table>
        </figure>
    </center>

    <script type="text/javascript">
        Highcharts.chart('container', {
            data: {
                table: 'tabla'
            },
            chart: {
                type: 'column'
            },
            title: {
                text: 'Medidas de posición central sobre la calificación en "Cálculo Diferencial"'
            },
            subtitle: {
                text: 'Informática, sistemas computacionales, mecatrónica e industrial'
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

    <?php include('graficas2.php'); ?>

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
