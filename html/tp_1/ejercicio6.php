<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 6</title>
    <link rel="stylesheet" href="static/src/main.css">
</head>
<body>
    <header>
    <h1>Ejercicio 6</h1>
    <h2>Promedio de Notas Alumno</h2>
    <!-- agregar una botonera para elegir que punto mostrar -->
    <div class="navbar">
    <button id="btnPunto1" class="punto">Punto 1</button>
    <button id="btnPunto2" class="punto">Punto 2</button>
    </div>
    </header>
    <div id="main">
        <div id='punto1' class="active">
            <h3>Punto 1</h3>
            <form action="ejercicio6.php" method="post">
                <div>
                    <label for="nota1">Nota 1:</label>
                    <input type="number" name="nota1" id="nota1" required>
                </div>
                <div>
                    <label for="nota2">Nota 2:</label>
                    <input type="number" name="nota2" id="nota2" required>
                </div>
                <div>
                    <label for="nota3">Nota 3:</label>
                    <input type="number" name="nota3" id="nota3" required>
                </div>
                <!-- <button type="button" class="ResolveJS">Resolver con JS</button> -->
                <!-- <input type="submit" class="ResolvePHP" value="Enviar"> -->
            </form>
        </div>
        <div id='punto2' style="display:none;">
            <h3>Punto 2</h3>
            <form action="ejercicio6.php" method="post">
                <div>
                    <label for="pass1">Ingrese una contraseña</label>
                    <input type="text" name="pass1" id="pass1" required>
                </div>
                <div>
                    <label for="pass2">Repita la misma contraseña</label>
                    <input type="text" name="pass2" id="pass2" required>
                </div>
                <!-- <input type="submit" class="ResolvePHP" value="Enviar"> -->
            </form>
        </div>
    <button type="button" class="ResolveJS">Resolver con JS</button>
    <div id="resultado"></div>
    <script>
        const punto1 = document.querySelector("#punto1");
        const punto2 = document.querySelector("#punto2");
        const resultado = document.getElementById('resultado')
        document.querySelector('.ResolveJS').addEventListener('click', function(event) {
            resultado.innerHTML = ""; // Limpiar el resultado anterior
            if (punto1.classList.contains("active")) {
                // Evitar el envío del formulario
                event.preventDefault();

                // Obtener los valores de las notas
                const nota1 = parseFloat(document.getElementById('nota1').value);
                const nota2 = parseFloat(document.getElementById('nota2').value);
                const nota3 = parseFloat(document.getElementById('nota3').value);

                // Validar que las notas estén en el rango de 0 a 10
                if (nota1 < 0 || nota1 > 10 || nota2 < 0 || nota2 > 10 || nota3 < 0 || nota3 > 10) {
                    resultado.innerHTML = "Las notas deben estar entre 0 y 10.";
                    return;
                }

                // Calcular el promedio
                const promedio = (nota1 + nota2 + nota3) / 3;

                // Mostrar el resultado
                resultado.innerHTML = `El promedio es: ${promedio.toFixed(2)}; ${promedio >= 6 ? 'Aprobado' : 'Desaprobado'}`;
            } else {
                // Punto 2
                const pass1 = document.getElementById('pass1').value;
                const pass2 = document.getElementById('pass2').value;

                if (pass1 !== pass2) {
                    resultado.innerHTML = "Las contraseñas no coinciden.";
                    return;
                }
                
                resultado.innerHTML = "Contraseña correcta.";
            }
        });
        document.getElementById('btnPunto1').addEventListener("click", function() {
            punto1.style.display = "block";
            punto1.classList.add("active");
            punto2.style.display = "none";
            punto2.classList.remove("active");
        });
        document.getElementById('btnPunto2').addEventListener("click", function() {
            punto2.style.display = "block";
            punto2.classList.add("active");
            punto1.style.display = "none";
            punto1.classList.remove("active");
        });
    </script>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nota1 = $_POST['nota1'];
        $nota2 = $_POST['nota2'];
        $nota3 = $_POST['nota3'];

        // Validar que las notas estén en el rango de 0 a 10
        if ($nota1 < 0 || $nota1 > 10 || $nota2 < 0 || $nota2 > 10 || $nota3 < 0 || $nota3 > 10) {
            echo "<p style='color: red;'>Las notas deben estar entre 0 y 10.</p>";
        } else {
            // Calcular el promedio
            $promedio = ($nota1 + $nota2 + $nota3) / 3;
            echo "<p>El promedio es: " . number_format($promedio, 2) . "<br>" . ($promedio >= 6 ? 'Aprobado' : 'Desaprobado') . "</p>";
        }
    }
    ?>
</body>
</html>
