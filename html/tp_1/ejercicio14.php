<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 14</title>
</head>
<body>
    <h1>Ejercicio 14</h1>
    <form method="post" action="ejercicio14.php">
    Ingrese una frase:
    <input type="text" name="frase">
    <br/>
    Ingrese un caracter:
    <input type="text" name="caracter">
    <br/>
    <input type="submit" value="confirmar">
  </form>
    <?php
    if (isset($_REQUEST['frase']) && isset($_REQUEST['caracter'])) {
        $frase = $_REQUEST['frase'];
        $caracter = $_REQUEST['caracter'];
        $count_char = 0;
        for ($i = 0; $i < strlen($frase); $i++) {
            if ($frase[$i] == $caracter) {
                $count_char++;
            }
        }
        echo "El caracter '$caracter' se encuentra $count_char veces en la frase.<br/>";
    }
    ?>
</body>
</html>