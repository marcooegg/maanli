<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 15</title>
</head>
<body>  
    <header>
        <h1>Ejercicio 15</h1>
    </header>
    <div id="main">
    <h2></h2>
        <form id="formEjercicio" method="post" action="ejercicio_15.php">
            <label for="edad">Ingrese la Edad:</label>
            <input type="number" id="edad" name="edad" required><br><br>
            <label for="sexo">Ingrese el Sexo: (1: hombre, 2: mujer)</label>
            <input type="number" id="sexo" name="sexo" required><br><br>
            <label for="estadoCivil">Ingrese el Estado Civil: (1: soltero, 2: casado)</label>
            <input type="number" id="estadoCivil" name="estadoCivil" required><br><br>
            <label for="nombreYApellido">Ingrese el Nombre y Apellido:</label>
            <input type="text" id="nombreYApellido" name="nombreYApellido" required><br><br>
            <input type="submit" value="Enviar">
        </form>
    </div>
    <?php
        // leer el form y agregar al archivo padron.csv
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $edad = $_POST['edad'];
            $sexo = $_POST['sexo'];
            $estadoCivil = $_POST['estadoCivil'];
            $nombreYApellido = $_POST['nombreYApellido'];

            if ($edad < 0 || $sexo < 1 || $sexo > 2 || $estadoCivil < 1 || $estadoCivil > 2) {
                echo "<p>Datos inválidos. Por favor, intente nuevamente.</p>";
            } else {
                $file = fopen("padron.csv", "a");
                fputcsv($file, array($edad, $sexo, $estadoCivil, $nombreYApellido));
                fclose($file);
                echo "<p>Datos guardados correctamente.</p>";
            }
        }
    ?>
</body>
</html>