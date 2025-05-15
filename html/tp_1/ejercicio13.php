<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 13</title>
</head>
<body>
    <h1>Ejercicio 13</h1>
    <form method="post" action="ejercicio13.php">
    Ingrese un numero:
    <input type="number" name="numero1">
    <br/>
    Ingrese un numero:
    <input type="number" name="numero2">
    <br/>
    Ingrese un numero:
    <input type="number" name="numero3">
    <br/>
    Ingrese un numero:
    <input type="number" name="numero4">
    <br/>
    Ingrese un numero:
    <input type="number" name="numero5">
    <br/>
    <input type="submit" value="confirmar">
  </form>
    <?php
    $numeros = array();
    if (isset($_REQUEST['numero1']) && isset($_REQUEST['numero2']) && isset($_REQUEST['numero3']) && isset($_REQUEST['numero4']) && isset($_REQUEST['numero5'])) {
        $numeros[] = $_REQUEST['numero1'];
        $numeros[] = $_REQUEST['numero2'];
        $numeros[] = $_REQUEST['numero3'];
        $numeros[] = $_REQUEST['numero4'];
        $numeros[] = $_REQUEST['numero5'];

        $min = $numeros[0];
        $max = $numeros[0];
        foreach ($numeros as $num) {
            if ($num < $min) {
                $min = $num;
            }
            if ($num > $max) {
                $max = $num;
            }
        }
        echo "El número menor es: $min<br/>";
        echo "El número mayor es: $max<br/>";
    }
    ?>
</body>
</html>