<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 7</title>
</head>
<body>
    <h1>Ejercicio 7</h1>
    <?php
        $sum = 0;
        $count = 60;
        for ($i = 0; $i <= 60; $i+=2) {
            $sum += $i;
            echo "$sum<br/>";
        }
        echo "La suma de los primeros 60 números pares es: $sum<br/>";
        echo "Dividido 2:" . ($sum / 2) . "<br/>";
    ?>
</body>
</html>