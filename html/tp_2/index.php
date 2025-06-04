<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Factura</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="static/src/css/styles.css" rel="stylesheet" >
    <script src="https://cdn.jsdelivr.net/npm/vue@3.3.0/dist/vue.global.min.js"></script>
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
                            <td><label for="numero_factura">Número de Factura: 0001 - </label></td>
                            <td><input type="text" class="form-control" id="numero_factura" v-model="numero_factura" required></td>
                        </tr>
                        <tr>
                            <td><label for="fecha">Fecha:</label></td>
                            <td><input type="date" class="form-control" id="fecha" v-model="fecha" required></td>
                        </tr>
                        <tr>
                            <td><label for="condicion_venta">Condición de Venta:</label></td>
                            <td>
                                <select class="form-select" id="condicion_venta" v-model="condicion_venta" required>
                                    <option value="" disabled selected>Seleccione una opción</option>
                                    <option value="Contado">Contado</option>
                                    <option value="Crédito">Crédito</option>
                                </select>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="form-group">
                <label for="cuit_cliente">CUIT/DNI:</label>
                <input type="text" class="form-control" id="cuit_cliente" v-model="cuit_cliente" required>
                <button type="button" class="btn btn-secondary mt-2" @click="buscarCliente" id="btnSearchClient">Buscar Cliente</button>
            </div>
            <div id="datosCliente" class="form-group mt-3">
            </div>
            <div class="form-group">
                <button type="button" class="btn btn-primary" @click="agregarLinea" id="btnAddLine">Agregar Línea</button>
                <table class="table table-bordered mt-3" id="table_body">
                    <tr id="table_head">
                        <th>Cant</th>
                        <th>Descripción</th>
                        <th>Precio Unitario</th>
                        <th>Subtotal</th>
                    </tr>
                    <tr>
                        <td>
                            <input type="number" class="form-control" v-model="nuevaLinea.cantidad" required>
                        </td>
                        <td>
                            <input type="text" class="form-control" v-model="nuevaLinea.descripcion" required>
                        </td>
                        <td>
                            <input type="number" class="form-control" v-model="nuevaLinea.precio_unitario" required>
                        </td>
                        <td>
                            <input type="number" class="form-control" v-model="nuevaLinea.subtotal" required readonly>
                        </td>
                    </tr>    
                </table>
            </div>
        </form>
    </div>
    <footer class="bg-primary text-center py-3">
    </footer>
    <script>
        const templateLinea = `<tr>
                        <td>
                            <input type="number" class="form-control" v-model="nuevaLinea.cantidad" required>
                        </td>
                        <td>
                            <input type="text" class="form-control" v-model="nuevaLinea.descripcion" required>
                        </td>
                        <td>
                            <input type="number" class="form-control" v-model="nuevaLinea.precio_unitario" required>
                        </td>
                        <td>
                            <input type="number" class="form-control" v-model="nuevaLinea.subtotal" required readonly>
                        </td>
                    </tr>`;
        const agregarLinea = () => {
                    const tableBody = document.querySelector('#table_body');
                    tableBody.insertAdjacentHTML('beforeend', templateLinea);
                };
                
        document.querySelector("#btnAddLine").addEventListener("click", agregarLinea);
        
        const escribirDatosCliente = (cliente) => {
            document.querySelector("#datosCliente").innerHTML = 
                `<p class='text-center company-header'>Nombre: ${cliente.nombre}</p>
                <p class='text-center company-header'>CUIT: ${cliente.nip}</p>
                <p class='text-center company-header'>Domicilio: ${cliente.direccion}</p>`;
        };

        document.querySelector("#btnSearchClient").addEventListener("click", function() {
            const cuitInput = document.querySelector("#cuit_cliente");
            const cuit = cuitInput.value;
            if (cuit) {
                axios.get(`php/cliente.php?cuit=${cuit}`)
                    .then(response => {
                        if (response.data.success) {
                            escribirDatosCliente(response.data.cliente);
                        } else {
                            alert("Cliente no encontrado.");
                        }
                    })
                    .catch(error => {
                        console.error("Error al buscar el cliente:", error);
                        alert("Error al buscar el cliente.");
                    });
            } else {
                alert("Por favor, ingrese un CUIT/DNI.");
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>
</html>