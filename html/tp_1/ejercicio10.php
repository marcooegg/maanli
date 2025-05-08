<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 10</title>
    <link rel="stylesheet" href="static/src/main.css">
</head>

<body>
    <header>
        <h1>Ejercicio 10</h1>
        <h2>Operadores lógicos || (o) en las estructuras condicionales.</h2>
        <div class="navbar">
            <button id="btnPunto1" class="punto">Punto 1</button>
        </div>
    </header>
    <div id="main">
        <div id="punto1" class="punto-form">
            <h3>Punto 1</h3>
            <form action="ejercicio8.php" method="post">
                <div>
                    <label for="numeroPunto1_1">Ingrese un numero:</label>
                    <input type="number" name="numeroPunto1_1" id="numeroPunto1_1" required />
                </div>
                <div>
                    <label for="numeroPunto1_2">Ingrese un numero:</label>
                    <input type="number" name="numeroPunto1_2" id="numeroPunto1_2" required />
                </div>
                <div>
                    <label for="numeroPunto1_3">Ingrese un numero:</label>
                    <input type="number" name="numeroPunto1_3" id="numeroPunto1_3" required />
                </div>
            </form>
        </div>
    </div>
    <footer>
        <button type="button" class="ResolveJS">Resolver con JS</button>
        <!-- <input type="submit" class="ResolvePHP" value="Enviar"> -->
        <div id="resultado"></div>
    </footer>
    <script>
        const removeOtrosPuntos = function () {
            const otrosPuntos = document.getElementsByClassName("punto-form");
            for (const element of otrosPuntos) {
                element.classList.remove("active");
                element.classList.add("hidden");
            }
        };
        const showPunto = function (punto) {
            document.querySelector(`#${punto}`).classList.add("active");
            document.querySelector(`#${punto}`).classList.remove("hidden");
        };

        const resolvePunto1 = function () {
            const numero1 = parseInt(document.querySelector("#numeroPunto1_1").value);
            const numero2 = parseInt(document.querySelector("#numeroPunto1_2").value);
            const numero3 = parseInt(document.querySelector("#numeroPunto1_3").value);

            return numero1 < 10 || numero2 < 10 || numero3 < 10
                ? "Uno de los numeros es menor a 10"
                : "Ninguno de los numeros es menor a 10";
        };
        document.querySelector(".ResolveJS").addEventListener("click", function (event) {
            resultado.innerHTML = ""; // Limpiar el resultado anterior
            const result = resolvePunto1();
            resultado.innerHTML = result;
        });
    </script>
    <?php ?>
</body>

</html>
