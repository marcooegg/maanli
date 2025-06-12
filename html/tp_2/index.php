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
                            <td><label for="numero_factura">Número de Factura: 0001 - </label></td>
                            <td><input type="text" class="form-control" id="numero_factura" required></td>
                        </tr>
                        <tr>
                            <td><label for="fecha">Fecha:</label></td>
                            <td><input type="date" class="form-control" id="fecha" required></td>
                        </tr>
                        <tr>
                            <td><label for="condicion_venta">Condición de Venta:</label></td>
                            <td>
                                <select class="form-select" id="condicion_venta" required>
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
                <input type="text" class="form-control" id="cuit_cliente" required>
                <button type="button" class="btn btn-secondary mt-2" id="btnSearchClient">Buscar Cliente</button>
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
        <button class="oe_stat_button btn btn-primary" id="btnCrearFactura">Crear Factura</button>
        </button>
    </div>
    </footer>
    <script>
        var cantLineas = 1;            
        var options = axios.get('php/productos.php', {
                    params: { descripcion: descripcion }
                })
                .then(response => {
                    options = response.data.message ? response.data.message : [];
                })
                .catch(error => {
                    console.error("Error al cargar los productos:", error);
                });
        const agregarLinea = () => {
            const tableBody = document.querySelector('#table_body');
            // <input type="text" class="form-control product-id" id='product_id_${cantLineas}' required>
            const templateLinea = `<tr id='linea_${cantLineas}'>
            <td>
            <input type="number" class="form-control cantidad" id='cantidad_${cantLineas}' required>
            </td>
                    <td>
                        <select class="form-select" id='descripcion_${cantLineas}' data-live-search="true" required>
                            <option value="" disabled selected>Seleccione un producto</option>
                        </select>
                    </td>
                    <td>
                        <input type="number" class="form-control precio" id='precio_${cantLineas}' required>
                    </td>
                    <td>
                        <input type="number" class="form-control" id='subtotal_${cantLineas}' required readonly>
                    </td>
                </tr>`;
            tableBody.insertAdjacentHTML('beforeend', templateLinea);
            document.querySelector(`#cantidad_${cantLineas}`).addEventListener('input', function() {
                const cantidad = parseFloat(this.value) || 0;
                const currentCantLineas = this.id.split('_')[1]; // Obtener el número de línea actual
                const precio = parseFloat(document.querySelector(`#precio_${currentCantLineas}`).value) || 0;
                document.querySelector(`#subtotal_${currentCantLineas}`).value = (cantidad * precio).toFixed(2);
            });
            document.querySelector(`#precio_${cantLineas}`).addEventListener('input', function() {
                const precio = parseFloat(this.value) || 0;
                const currentCantLineas = this.id.split('_')[1];
                const cantidad = parseFloat(document.querySelector(`#cantidad_${currentCantLineas}`).value) || 0;
                document.querySelector(`#subtotal_${currentCantLineas}`).value = (cantidad * precio).toFixed(2);
            });
            // document.querySelector(`#product_id_${cantLineas}`).addEventListener('input', function() {
            // const descripcion = this.value;
            // const currentCantLineas = this.id.split('_')[2];
            const descripcion = "";
            const currentCantLineas = cantLineas;
            console.log(currentCantLineas)
            // options = axios.get('php/productos.php', {
            //         params: { descripcion: descripcion }
            //     })
            //     .then(response => {
            //         const productos = response.data.message;
            //         const select = document.querySelector(`#descripcion_${currentCantLineas}`);
            //         select.innerHTML = '<option value="" disabled selected>Seleccione un producto</option>';
            //         for (const producto of productos) {
            //             select.innerHTML += `<option value="${producto.id}" data-tokens="${producto.descripcion}">${producto.descripcion}</option>`;
            //         }

            //     })
            //     .catch(error => {
            //         console.error("Error al cargar los productos:", error);
            //     });
            const select = document.querySelector(`#descripcion_${currentCantLineas}`);
            select.innerHTML = '<option value="" disabled selected>Seleccione un producto</option>';
            for (const producto of productos) {
                select.innerHTML += `<option value="${producto.id}" data-tokens="${producto.descripcion}">${producto.descripcion}</option>`;
            }
            // document.querySelector(`#descripcion_${currentCantLineas}`).innerHTML = `<option value="${descripcion}" selected>${descripcion}</option>`;
            // });
            select.addEventListener("change", function() {
                const selectedOption = this.options[this.selectedIndex];
                document.querySelector(`#precio_${currentCantLineas}`).value = options[this.selectedIndex].precio
                console.log("Producto seleccionado:", selectedOption.text);
            });
            cantLineas++;
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
                axios.get(`php/cliente.php`, {
                        params: { cuit: cuit }
                    })
                    .then(response => {
                        if (response.data.success) {
                            escribirDatosCliente(response.data.result);
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

        const crearFactura = () => {
            const numeroFactura = document.querySelector("#numero_factura").value;
            const fecha = document.querySelector("#fecha").value;
            const condicionVenta = document.querySelector("#condicion_venta").value;
            const cuitCliente = document.querySelector("#cuit_cliente").value;

            if (!numeroFactura || !fecha || !condicionVenta || !cuitCliente) {
                alert("Por favor, complete todos los campos.");
                return;
            }

            const lineas = [];
            for (let i = 1; i < cantLineas; i++) {
                const cantidad = parseFloat(document.querySelector(`#cantidad_${i}`).value) || 0;
                const descripcion = document.querySelector(`#linea_${i} input[type="text"]`).value;
                const precio = parseFloat(document.querySelector(`#precio_${i}`).value) || 0;
                const subtotal = parseFloat(document.querySelector(`#subtotal_${i}`).value) || 0;

                if (cantidad && descripcion && precio && subtotal) {
                    lineas.push({ cantidad, descripcion, precio, subtotal });
                }
            }

            if (lineas.length === 0) {
                alert("Debe agregar al menos una línea a la factura.");
                return;
            }

            axios.post('php/crear_factura.php', {
                    numeroFactura : numeroFactura,
                    fecha: fecha,
                    condicionVenta: condicionVenta,
                    cuitCliente: cuitCliente,
                    lineas: lineas
                })
                .then(response => {
                    if (response.data.success) {
                        alert("Factura creada exitosamente.");
                        window.location.reload(); // Recargar la página para limpiar el formulario
                    } else {
                        alert("Error al crear la factura: " + response.data.message);
                    }
                })
                .catch(error => {
                    console.error("Error al crear la factura:", error);
                    alert("Error al crear la factura.");
                });
        };

        document.querySelector("#btnCrearFactura").addEventListener("click", crearFactura);
        agregarLinea(); // Agregar la primera línea al cargar la página
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>
</html>
