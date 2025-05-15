<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 9</title>
</head>
<body>
    <h1>Ejercicio 9</h1>
    <?php
        $count = 0;
        for ($i = 1; $i <= 100; $i+=2) {
            echo "$i<br/>";
            $count++;
        }
        echo "La cantidad de números impares entre 1 y 100 es: $count<br/>";
    ?>
</body>
</html>