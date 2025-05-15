<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 2 al 4</title>
</head>
<body>
    <h1>Ejercicio 2 al 4</h1>
    <form method="post" action="ejercicio13.php">
        Ingrese un numero para A:
        <input type="number" name="numero1">
        <br/>
        Ingrese un numero para $A1:
        <input type="number" name="numero2">
        <br/>
        <input type="submit" value="confirmar">
    </form>
    <?php
    // ej 2
        $A = 10;
        $A1 = 33;
    // ej 3
        echo "La suma es " . ($A + $A1) . "<br/>";
    // ej 4
        $A = $_REQUEST['numero1'];
        $A1 = $_REQUEST['numero2'];
        echo "La suma es " . ($A + $A1) . "<br/>";
    ?>
</body>
</html>