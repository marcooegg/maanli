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
    <?php
        
        function tipoEmpleado($tipo) {
            if ($tipo == 1) {
                return "Mecanico";
            } else if ($tipo == 2) {
                return "Conductor";
            } else {
                return "Desconocido";
            }
        }

        $sumaSueldos = 0;
        $sumaSueldosMecanico = 0;
        $cantMecanicos = 0;
        $cantEmpleados = 0;
        $file = fopen("maestro_empleados.csv", "r");
        echo "<h2>Padron de Empleados</h2>";
        echo "<table border='1'>";
        echo "<tr><th>Cod. Empl</th><th>Nombre y Apellido</th><th>S. Basico</th><th>Observaciones</th></tr>";
        while (($data = fgetcsv($file)) !== FALSE) {
            $cantEmpleados++;
            $codEmpl = (int)$data[0];
            $nombreYApellido = $data[1];
            $sueldoBasico = (float)$data[2];
            $sumaSueldos += $sueldoBasico;
            $observaciones = $data[3];

            if (tipoEmpleado($observaciones) == "Mecanico") {
                $sumaSueldosMecanico += $sueldoBasico;
                $cantMecanicos++;
            }
            
            echo "<tr>";
            echo "<td>$codEmpl</td>";
            echo "<td>$nombreYApellido</td>";
            echo "<td>$sueldoBasico</td>";
            echo "<td>" . tipoEmpleado($observaciones) . "</td>";
            echo "</tr>";
        }
        fclose($file);
        echo "<tr><td/><td>Total:</td><td>$sumaSueldos</td></tr>";
        echo "</table>";
        echo "<p>El sueldo promedio es: ". ($sumaSueldos / $cantEmpleados) . "</p>";
        echo "<p>El sueldo promedio de los mecanicos es: " . ($sumaSueldosMecanico / $cantMecanicos) . "</p>";
    ?>
        
    </div>
</body>
</html>