<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 16</title>
</head>
<body>  
    <header>
        <h1>Ejercicio 16</h1>
    </header>
    <div id="main">
    <h2>Procesar datos del padron</h2>
    
    </div>
    <footer>
        <button onclick="location.href='ejercicios_php.php'">Volver a Ejercicios PHP</button>
    </footer>
    <?php
        
        $file = fopen("padron.csv", "r");
        $mujeres_20_30 = 0;
        $mujeres_casadas_30_40 = 0;
        $mujeres_casadas = 0;
        $total_hombres = 0;
        $varones_solteros_25 = 0;
        $varones_casados = 0;
        while (($data = fgetcsv($file)) !== FALSE) {
            $edad = (int)$data[0];
            $sexo = (int)$data[1];
            $estadoCivil = (int)$data[2];
            
            if ($sexo == 2) { // mujer
                if ($edad >= 20 && $edad <= 30) {
                    $mujeres_20_30++;
                }
                if ($estadoCivil == 2 && $edad >= 30 && $edad <= 40) {
                    $mujeres_casadas_30_40++;
                }
                if ($estadoCivil == 2) {
                    $mujeres_casadas++;
                }
            } else { // hombre
                $total_hombres++;
                if ($estadoCivil == 1 && $edad == 25) {
                    $varones_solteros_25++;
                }
                if ($estadoCivil == 2) {
                    $varones_casados++;
                }
            }
        }
        fclose($file);
        echo "<p>Cantidad de mujeres entre 20 y 30 años: $mujeres_20_30</p>";
        echo "<p>Cantidad de mujeres casadas entre 30 y 40 años: $mujeres_casadas_30_40</p>";
        echo "<p>Cantidad de mujeres casadas: $mujeres_casadas</p>";
        echo "<p>Total de hombres: $total_hombres</p>";
        echo "<p>Total de varones solteros con edad de 25 años: $varones_solteros_25</p>";
        echo "<p>Total de varones casados: $varones_casados</p>";

    ?>
</body>
</html>