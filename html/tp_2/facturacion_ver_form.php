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
        <form>
            <h1 class='text-center company-header'>Factura Electrónica</h1>
            <div class="header d-flex">
                <div class="align-items-left col-6" name="datos_empresa">
                    <?php
                    require_once "php/db.php";
                    $conn = new DataBaseConnection();
                    $query = "SELECT * FROM persona WHERE id = ?";
                    $params = [1]; // Asumiendo que la empresa es la primera persona en la base de datos
                    $empresa = $conn->read($query,$params);
                    if ($empresa) {
                        $empresa = $empresa[0];
                        echo "";
                        echo "<p class='text-center company-header'>Nombre: {$empresa['nombre']}</p>";
                        echo "<p class='text-center company-header'>CUIT: {$empresa['nip']}</p>";
                        echo "<p class='text-center company-header'>Domicilio: {$empresa['direccion']}</p>";
                    } else {
                        echo "<p class='text-center company-header'>Datos de la empresa no encontrados.</p>";
                    }
                ?>
                </div>
                <div class="align-items-right col-6" name="datos_factura">
                    <table>
                        <tr>
                            <td><label for="numero_factura">Número de Factura:</label></td>
                        </tr>
                        <tr>
                            <td><label for="fecha">Fecha:</label></td>
                        </tr>
                        <tr>
                            <td><label for="condicion_venta">Condición de Venta:</label></td>
                            <td>
                                
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div id="datosCliente" class="form-group mt-3">

            </div>
            <div class="form-group">
                <button type="button" class="btn btn-primary" id="btnAddLine">Agregar Línea</button>
                <table class="table table-bordered mt-3" id="table_body">
                    <tr id="table_head">
                        <th>Cant</th>
                        <th>Descripción</th>
                        <th>Precio Unitario</th>
                        <th>Subtotal</th>
                    </tr>
                </table>
            </div>
        </form>
    </div>
    <footer class="bg-primary text-center py-3">
    <div class="oe_button_box" name="button_box">
        <div class="container my-4">
            <a href="facturacion_ver_lista.php" class="btn btn-success">Volver</a>
        </div>
    </div>
    </footer>
    <script>
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>
</html>
