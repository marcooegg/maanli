<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 11</title>
</head>
<body>
    <h1>Ejercicio 11</h1>
    <form method="post" action="ejercicio11.php">
    Ingrese un numero:
    <input type="number" name="numero">
    <br/>
    <input type="submit" value="confirmar">
  </form>
    <?php
    if (isset($_REQUEST['numero'])) {

        if ($_REQUEST['numero'] == 0) {
            echo "El número es par";
        } else {
            if ($_REQUEST['numero'] % 2 == 0) {
                echo "El número es par";
            } else {
                echo "El número es impar";
            }
        }
    }
    ?>
</body>
</html>