<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 12</title>
</head>
<body>
    <h1>Ejercicio 12</h1>
    <?php
        $sum_odd = 0;
        $sum_even = 0;
        for ($i = 1; $i <= 100; $i++) {
            if ($i % 2 == 0) {
                $sum_even+= $i;
            } else {
                $sum_odd+= $i;
            }
        }
        echo "La suma de números impares entre 1 y 100 es: $sum_odd<br/>";
        echo "La suma de números pares entre 1 y 100 es: $sum_even<br/>";
    ?>
</body>
</html>