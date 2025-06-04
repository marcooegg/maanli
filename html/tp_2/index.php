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
            <div class="header">
                <div class="align-items-left" name="datos_empresa">
                    <?php
                    require_once "php/db.php";
                    $conn = new DataBaseConnection();
                    $query = "SELECT * FROM persona WHERE id = 1";
                    $empresa = $conn->read($query);
                    if ($empresa) {
                        $empresa = $empresa[0];
                        echo "<h1 class='text-center'>Factura Electrónica</h1>";
                        echo "<p class='text-center'>Nombre: {$empresa['nombre']}</p>";
                        echo "<p class='text-center'>CUIT: {$empresa['nip']}</p>";
                        echo "<p class='text-center'>Domicilio: {$empresa['direccion']}</p>";
                    } else {
                        echo "<p class='text-center'>Datos de la empresa no encontrados.</p>";
                    }
                ?>
                </div>
                <div class="align-items-right" name="datos_factura">
                    <!-- <h2 class="text-center">Crear Factura</h2> -->
                    <table>
                        <tr>
                            <td><label for="numero_factura">Número de Factura: 0001 - </label></td>
                            <td><input type="text" class="form-control" id="numero_factura" v-model="numero_factura" required>
                            <?php echo "1" ?>
                            </td>
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
                
            </div>
            <div class="form-group">
                <button type="button" class="btn btn-primary" @click="agregarLinea">Agregar Línea</button>
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
        const template = `<tr>
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
        const app = Vue.createApp({
            data() {
                return {
                    nuevaLinea: {
                        cantidad: 1,
                        descripcion: '',
                        precio_unitario: 0,
                        subtotal: 0
                    }
                }
            },
            methods: {
                agregarLinea() {
                    const tableBody = document.querySelector('#table_body');
                    tableBody.insertAdjacentHTML('beforeend', template);
                }
            }
        });
        app.mount('#app');
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>
</html>