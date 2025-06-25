<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Factura</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="static/src/css/styles.css" rel="stylesheet" >
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body>
    <header class="bg-primary">
    </header>
    <div id="factura" class="container d-flex justify-content-center align-items-center">
        <table  class="table table-striped">
            <thead>
                <tr>
                <th scope="col">Numero</th>
                <th scope="col">Fecha</th>
                <th scope="col">Cliente</th>
                <th scope="col">Total</th>
                </tr>
            </thead>
            <?php
                ini_set('display_errors', 1);
                ini_set('display_startup_errors', 1);
                error_reporting(E_ALL);
                require_once "php/db.php";

                try {
                    $conn = new DataBaseConnection();
                    $query = <<<EOT
                        SELECT 
                            factura.numero as numero,
                            factura.fecha as fecha,
                            persona.nombre as nombre_cliente,
                            sum(linea_factura.total) as total
                        FROM factura
                        INNER JOIN persona ON persona.id = factura.cliente_id
                        INNER JOIN linea_factura ON linea_factura.factura_id = factura.id
                        GROUP BY factura.numero, factura.fecha, persona.nombre
                    EOT;
                    $facturas = $conn->read($query, []);
                    if ($facturas && count($facturas) > 0) {
                        echo "<tbody>";
                        foreach ($facturas as $factura) {
                            echo "<tr>";
                            echo "<td>{$factura['numero']}</td>";
                            echo "<td>{$factura['fecha']}</td>";
                            echo "<td>{$factura['nombre_cliente']}</td>";
                            echo "<td>{$factura['total']}</td>";
                        }
                        echo "</tbody>";
                    } else {
                        echo "<tbody><tr><td colspan='4' class='text-center'>No hay resultados</td></tr></tbody>";
                    }
                } catch (Exception $e) {
                    echo $e;
                }
            ?>
        </table>
    </div>
    <footer class="bg-primary text-center py-3">
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>
</html>
