<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 11</title>
    <link rel="stylesheet" href="static/src/main.css">
</head>

<body>
    <header>
        <h1>Ejercicio 11</h1>
        <h2>Estructuras switch.</h2>
        <div class="navbar">
            <button id="btnPunto1" class="punto">Punto 1</button>
        </div>
    </header>
    <div id="main">
        <div id="punto1" class="punto-form">
            <h3>Punto 1</h3>
            <form action="ejercicio11.php" method="post">
                <div>
                    <label for="palabra">Ingrese una palabra:</label>
                    <input type="text" name="palabra" id="palabra" required />
                </div>
            </form>
        </div>
    </div>
    <footer>
        <button type="button" class="ResolveJS">Resolver con JS</button>
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
            const palabra = document.querySelector("#palabra").value;
            let resultado = "";
            switch (palabra) {
                case "casa":
                    resultado = "house";
                    break;
                case "mesa":
                    resultado = "table";
                    break;
                case "perro":
                    resultado = "dog";
                    break;
                case "gato":
                    resultado = "cat";
                    break;
                default:
                    resultado = "No se reconoce la palabra ingresada.";
            }
            return resultado;
            
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
