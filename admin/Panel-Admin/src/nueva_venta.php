<?php include_once "includes/header.php";
include "../conexion.php";
session_start();
// Inicializa variables
$mensaje = '';
$ventaId = $clienteId = null;
date_default_timezone_set('America/Bogota'); // change according timezone
$fechaHoraActual = date("Y-m-d H:i:s");
// Consulta para Generar Id Venta
$query = "SELECT MAX(id) AS max_id FROM sales";
$resultado = mysqli_query($conexion, $query);
$row = mysqli_fetch_assoc($resultado);
$max_id = $row['max_id'];
// Incrementar el valor en 1
$idVentaInicial = ($max_id == null) ? 1 : $max_id + 1;
$success = '';

// Procesar solo si es una solicitud POST
if (!empty($_POST)) {

    // Obtener los datos del formulario
    $ventaId = $_POST['idVenta'];
    $fecha = $_POST['fechaC'];
    $cliente_id = $_POST['cliente'];
    $vendedor_id = $_POST['empleado'];
    $metodo_pago = $_POST['metodoPago'];
    $tipoVenta = $_POST['tipoVenta'];
    $total = $_POST['total-final'];
    $iva = $_POST['iva'];
    $descuento = $_POST['descuento'];
    $carrito = json_decode($_POST['carrito'], true); // Decodificar el carrito JSON
    $cantidadOrder = 0;

    // Verificar si todos los campos requeridos están presentes

    if (
        empty($ventaId) || empty($fecha) || empty($cliente_id) ||
        empty($vendedor_id) || empty($metodo_pago) || empty($tipoVenta) ||
        empty($total) || empty($iva) || empty($descuento) ||
        empty($carrito)
    ) {
        $alert = '<div class="alert alert-danger" role="alert">
            Todo los campos son obligatorios
          </div>';
    } else {

        // Verificar si la decodificación del carrito fue exitosa
        if ($carrito === null) {
            $alert = '<div class="alert alert-danger" role="alert">
        Data Carrito
      </div>';
        }

        $estadoVenta = 1;
        $total = str_replace('.', '', $total); // Elimina los puntos de separador de miles
        $total = str_replace(',', '.', $total); // Reemplaza la coma decimal por un punto decimal
        $total = (float)$total; // Convertir a float para manejarlo correctamente

        $iva = str_replace('.', '', $iva); // Elimina los puntos de separador de miles
        $iva = str_replace(',', '.', $iva); // Reemplaza la coma decimal por un punto decimal
        $iva = (float)$iva; // Convertir a float para manejarlo correctamente

        $descuento = str_replace('.', '', $descuento); // Elimina los puntos de separador de miles
        $descuento = str_replace(',', '.', $descuento); // Reemplaza la coma decimal por un punto decimal
        $descuento = (float)$descuento; // Convertir a float para manejarlo correctamente

        // Insertar en la tabla `sales`
        $query_insert = mysqli_query($conexion, "INSERT INTO sales 
        (id, creation_date, sale_status, user_id, employee_id, total_price, tax_iva, discount, sale_portal) 
        VALUES ('$ventaId', '$fecha','$estadoVenta','$cliente_id','$vendedor_id','$total', '$iva','$descuento','$tipoVenta')");

        if (!$query_insert) {
            $alert = '<div class="alert alert-danger" role="alert">
        Error al procesar la Venta
      </div>';
        }

        $success = true;

        // Insertar en la tabla `sale_detail` y `orders`
        foreach ($carrito as $producto) {
            $product_id = $producto['id'];
            $quantity = $producto['cantidad'];
            $price = $producto['precio'];
            $priceDiscount = $producto['total'];

            // Insertar en `sale_detail`
            $query_insert2 = mysqli_query($conexion, "INSERT INTO sale_detail 
            (product_id, sale_id, quantity_product, unit_price, price_discount) 
            VALUES ('$product_id', '$ventaId', '$quantity', '$price','$priceDiscount')");
            $cantidadOrder++;

            // Actualizar la cantidad del producto vendido
            $query_update_vendido = mysqli_query($conexion, "UPDATE products SET quantity = quantity - '$quantity' WHERE id = '$product_id'");
            $query_update_estado = mysqli_query($conexion, "UPDATE products SET stock = CASE WHEN quantity <= 0 THEN 'Out of Stock' ELSE 'In Stock' END WHERE id = '$product_id'");
            if (!$query_insert2) {
                $success = false;
                break;
            }
        }
        // Insertar en `orders`
        $query_insert3 = mysqli_query($conexion, "INSERT INTO orders 
            (userId, quantity, orderDate, paymentMethod, orderStatus, sale_id) 
            VALUES ('$cliente_id','$cantidadOrder', '$fecha', '$metodo_pago', 'Entregado', '$ventaId')");

        // Respuesta según el éxito o el fallo de la operación
        if ($success) {
            $alert = '<div class="alert alert-success" role="alert">
            La venta fue procesada correctamente.
          </div>';
            $pdf_url = 'pdf/generar_venta_pdf.php?v=' . urlencode($ventaId) . '&cl=' . urlencode($cliente_id);
            echo  $pdf_url;
        } else {
            $alert = '<div class="alert alert-danger" role="alert">
       Error al procesar la venta.
      </div>';
            $pdf_url = '';
        }
    }
} else {
    $alert = '';
    $pdf_url = '';
}

include_once "includes/slidebar.php";
?>


<!-- Content Wrapper. Contains page content -->
<?php if ($alert) echo $alert; ?>
<!-- /.content-header -->
<!-- Main content -->
<div class="card">
    <div class="card-body">
        <form method="POST" autocomplete="off" class="form" id="ventaForm">
            <div class="container-fluid p-0">
                <div class="row">
                    <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8">
                        <div class="card">
                            <div class="card-header">
                                <div class="row mb-2">
                                    <div class="col-sm-6">
                                        <h3 class="m-0 text-dark">Nueva Venta</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">

                                <div class="row">
                                    <hr style="width: 100%; margin-top: 5px; margin-bottom: 5px;">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label style="font-family: sans-serif">No. Venta</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                                </div>
                                                <input type="text" required="" name="idVenta" id="idVenta" class="form-control" value="<?php echo $idVentaInicial; ?>" readonly>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">

                                        <div class="form-group">
                                            <label style="font-family: sans-serif">Fecha Creación</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                                </div>
                                                <input type="text" required="" name="fechaC" id="fechaC" class="form-control" value="<?php echo $fechaHoraActual; ?>" readonly>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label style="font-family: sans-serif">Metodo Pago</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-check-circle"></i></span>
                                                </div>
                                                <select class="form-control" name="metodoPago" id="metodoPago">
                                                    <option value="efectivo">Efectivo</option>
                                                    <option value="datafono">Datafono </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Tipo de Venta</label>
                                            <div class="controls">
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-copyright"></i></span>
                                                    </div>
                                                    <input id="tipoVenta" name="tipoVenta" type="text" class="form-control" value="Fisica" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <hr style="width: 100%; margin-top: 5px; margin-bottom: 5px;">

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label" for="cliente">Cliente</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-copyright"></i></span>
                                                </div>
                                                <select class="form-control" id="cliente" name="cliente" class="span8 tip">
                                                    <option value="">Seleccione Cliente</option>
                                                    <?php $query = mysqli_query($conexion, "select * from users where status = 1");
                                                    while ($row = mysqli_fetch_array($query)) { ?>

                                                        <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label" for="empleado">Vendedor</label>
                                            <div class="controls">
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-copyright"></i></span>
                                                    </div>
                                                    <select class="form-control" id="empleado" name="empleado" class="span8 tip">
                                                        <option value="">Seleccione Vendedor</option>
                                                        <?php $query = mysqli_query($conexion, "select * from employees where status = 1");
                                                        while ($row = mysqli_fetch_array($query)) { ?>

                                                            <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr style="width: 100%; margin-top: 5px; margin-bottom: 5px;">
                                    <div class="col-sm-6">
                                        <!-- Centrar botón Buscar Producto -->
                                        <div class="form-group text-center">
                                            <br>
                                            <button class="btn btn-info" type="button" data-toggle="modal" data-target="#modal-productos">
                                                <i class="fa fa-search"></i> Buscar Producto
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <!-- Centrar botón Buscar Producto -->
                                        <div class="form-group text-center">
                                            <br>
                                            <!-- Campos ocultos para datos del carrito -->
                                            <input type="hidden" name="carrito" id="carrito">
                                            <button type="submit" class="btn btn-outline-success"><span class="fas fa-save"></span> Confirmar Venta</button>
                                            </button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title text-center">Resumen Compra</h4>
                                <br>
                            </div>
                            <div class="card-body">
                                <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>IVA 19%</label>
                                            <input id="iva" name="iva" type="text" class="form-control" readonly="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Descuento de Tienda (10%) </label>
                                            <input id="descuento" name="descuento" type="text" class="form-control" readonly="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Gastos de Envio</label>
                                            <input id="envio" name="envio" type="text" class="form-control" readonly="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Sub Total Compra</label>
                                            <input id="subTotal" name="subTotal" type="text" class="form-control" readonly="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Total a Pagar</label>
                                            <input id="total-final" name="total-final" type="text" class="form-control" readonly="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>





<br>
<div class="col-md-12 col-sm-12 shopping-cart-table p-0">
    <div class="table-responsive">
        <form name="cart" method="post">

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="cart-id item">Id</th>
                        <th class="cart-description item">Imagen</th>
                        <th class="cart-product-name item">Nombre Producto</th>
                        <th class="cart-cantidad item">Cantidad</th>
                        <th class="cart-sub-total item">Precio por unidad</th>
                        <th class="cart-descuento item">Descuento</th>
                        <th class="cart-total item">Total</th>
                        <th class="cart-romove item">Accion</th>
                    </tr>
                </thead><!-- /thead -->
                <tbody>

                </tbody><!-- /tbody -->
            </table><!-- /table -->
        </form>
    </div>
</div>

<!-- /.modal -->
<div class="modal fade" id="modal-productos">
    <div class="modal-dialog" style="max-width: 95%;"> <!-- Ajustar el tamaño a 90% del ancho de la pantalla -->
        <div class="modal-content">
            <div class="modal-header">
                <h4 id="titulo" class="modal-title">Productos</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">

                    <?php
                    $query = mysqli_query($conexion, "SELECT * FROM products");
                    $contador = 0;
                    while ($producto = mysqli_fetch_array($query)) {
                        $descuento = $producto['discount'];
                        $precioOriginal = $producto['productPrice'];
                        $precioConDescuento = $precioOriginal - ($precioOriginal * $descuento / 100);
                        // Solo formatea para mostrar en HTML
                        $precioOriginalFormatted = number_format($precioOriginal, 0, '.', ',');
                        $precioConDescuentoFormatted = number_format($precioConDescuento, 0, '.', ',');

                    ?>

                        <div class="col-xl-2 col-lg-2 col-md-3 col-sm-4 col-xs-6">
                            <!-- Tarjeta del producto -->
                            <div class="product-card" data-toggle="modal" data-target="#modal-<?php echo $producto['id']; ?>">
                                <!-- Etiqueta de descuento -->
                                <?php if ($descuento > 0) { ?>
                                    <span class="badge badge-danger">-<?php echo $descuento; ?>%</span>
                                <?php } ?>

                                <!-- Contenedor de la imagen -->
                                <div class="card-img-container">
                                    <img class="card-img-top imgProduct img" src="../../productImages/<?php echo $producto['id']; ?>/<?php echo $producto['productImage1']; ?>" alt="Imagen del Producto">
                                </div>

                                <div class="card-body">
                                    <!-- Nombre del producto en una línea -->
                                    <h5 class="card-title"><b><?php echo $producto['productName']; ?></b></h5>

                                    <!-- Descripción con altura limitada -->
                                    <p class="card-text"><?php echo $producto['productDescription']; ?></p>

                                    <!-- Precios -->
                                    <div class="prices">
                                        <span class="original-price"> Antes: <?php echo $precioOriginalFormatted; ?></span><br>
                                        <span class="current-price">Ahora: <?php echo $precioConDescuentoFormatted; ?></span>
                                    </div>

                                    <!-- Cantidad -->
                                    <div class="quantity-selector">
                                        <label for="quantity-<?php echo $producto['id']; ?>">Cantidad:</label>
                                        <?php if ($producto['stock'] == 'In Stock') { ?>
                                            <input type="number" id="quantity-<?php echo $producto['id']; ?>" name="quantity" min="1" max="<?php echo $producto['stock']; ?>" value="1">
                                        <?php } else { ?>
                                            <input type="number" id="quantity-<?php echo $producto['id']; ?>" name="quantity" style="color:red" value="0" disabled>
                                        <?php } ?>
                                    </div>
                                </div>

                                <!-- 5. Botón Agregar al Carrito -->
                                <div class="card-footer ">
                                    <?php if ($producto['stock'] == 'In Stock') { ?>
                                        <button class="btn btn-primary add-to-cart"
                                            type="button"
                                            data-id="<?php echo $producto['id']; ?>"
                                            data-nombre="<?php echo $producto['productName']; ?>"
                                            data-descuento="<?php echo $descuento; ?>"
                                            data-precio="<?php echo $precioOriginal; ?>"
                                            data-total="<?php echo $precioConDescuento; ?>"
                                            data-imagen="../../productImages/<?php echo $producto['id']; ?>/<?php echo $producto['productImage1']; ?>"
                                            data-stock="<?php echo $producto['stock']; ?>">
                                            <span class="fa fa-shopping-cart"></span> Agregar al Carrito
                                        </button>
                                    <?php } else { ?>
                                        <div class="action" style="color:red">Fuera de Stock</div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>


                    <?php
                        $contador++;
                        if ($contador == 6) {
                            echo '</div><div class="row">';
                            $contador = 0;
                        }
                    }
                    ?>
                </div>
            </div>
            <div class="modal-footer">

            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- Modal de Alerta 
    <div class="modal fade" id="alertModal" tabindex="-1" aria-labelledby="alertModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="alertModalLabel">Alerta</h5>
                </div>
                <div class="modal-body" id="alertModalBody">
                     Mensaje de alerta se mostrará aquí 
                </div>

            </div>
        </div>
    </div>-->
<br>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Manejar el clic en el botón "Añadir al carrito"
        $('.add-to-cart').on('click', function() {
            var productId = $(this).data('id');
            var productName = $(this).data('nombre');
            var productPrice = parseFloat($(this).data('precio'));
            var productImage = $(this).data('imagen');
            var productStock = $(this).data('stock');
            var descuento = parseFloat($(this).data('descuento'));
            var precioConDescuento = parseFloat($(this).data('total'));
            var quantity = parseInt($('#quantity-' + productId).val());
            var precioConDescuentoAplicado = precioConDescuento * quantity;

            var $existingRow = $(`.shopping-cart-table tbody tr[data-id="${productId}"]`);
            if ($existingRow.length > 0) {
                // Actualizar cantidad y total en la fila existente
                var $quantityInput = $existingRow.find('.quantity-input');
                var $totalCell = $existingRow.find('.cart-total');
                var existingQuantity = parseInt($quantityInput.val());
                var newQuantity = existingQuantity + quantity;
                var newTotal = parseFloat($totalCell.data('total')) + precioConDescuentoAplicado;

                $quantityInput.val(newQuantity);
                $totalCell.text(formatNumber(newTotal));
                $totalCell.data('total', newTotal);

                showAlert(`Cantidad actualizada para el producto: ${productName}. Nueva cantidad: ${newQuantity}.`, 'info');
            } else {
                // Añadir nueva fila al carrito
                var precioConDescuentoFormateado = formatNumber(precioConDescuentoAplicado);
                var precioOriginalFormateado = formatNumber(productPrice);

                var newRow = `<tr data-id="${productId}">
                <td>${productId}</td>
                <td><img src="${productImage}" alt="${productName}" style="width: 50px; height: auto;"></td>
                <td data-nombre="${productName}">${productName}</td>
                <td class="cart-cantidad">
                    <input type="number" min="1"  data-cantidad="${quantity}" value="${quantity}" class="form-control quantity-input">
                </td>
                <td class="cart-sub-total" data-sub-total="${productPrice}">${precioOriginalFormateado}</td>
                <td class="cart-descuento" data-descuento "${descuento}" >${descuento}%</td>
                <td class="cart-total" data-total="${precioConDescuentoAplicado}">${precioConDescuentoFormateado}</td>
                <td><button class="btn btn-danger remove-item" data-id="${productId}">Eliminar</button></td>
            </tr>`;

                $('.shopping-cart-table tbody').append(newRow);
                showAlert(`Producto añadido al carrito: ${productName}. Cantidad: ${quantity}.`, 'success');
            }

            calculateAndUpdateTotals();
        });

        // Manejar el cambio en la cantidad de un producto
        $('.shopping-cart-table').on('change', '.quantity-input', function() {
            var $row = $(this).closest('tr');
            var quantity = parseInt($(this).val());
            var productPrice = parseFloat($row.find('.cart-sub-total').data('sub-total'));
            var descuento = parseFloat($row.find('.cart-descuento').text().replace('%', ''));
            var precioConDescuento = productPrice - (productPrice * descuento / 100);
            var precioConDescuentoAplicado = precioConDescuento * quantity;

            var $totalCell = $row.find('.cart-total');
            $totalCell.text(formatNumber(precioConDescuentoAplicado));
            $totalCell.data('total', precioConDescuentoAplicado);

            showAlert(`Cantidad actualizada para el producto: ${$row.find('td:nth-child(3)').text()}. Nueva cantidad: ${quantity}.`, 'info');
            calculateAndUpdateTotals();
        });

        // Manejar el clic en el botón "Eliminar" de un producto
        $('.shopping-cart-table').on('click', '.remove-item', function() {
            $(this).closest('tr').remove();
            showAlert('Producto eliminado del carrito.', 'danger');
            calculateAndUpdateTotals();
        });

        // Manejar el cierre de la modal
        $('#modal-productos').on('hidden.bs.modal', function() {
            calculateAndUpdateTotals();
        });

        // Función para formatear números con separadores de miles
        function formatNumber(number) {
            return number.toLocaleString('es-CO', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });
        }

        // Función para calcular y actualizar los totales del carrito
        function calculateAndUpdateTotals() {
            let total = 0;
            let ivaRate = 19; // Tasa de IVA (ejemplo: 19%)
            let discountRate = 10; // Tasa de descuento (ejemplo: 10%)
            let iva = 0;
            let descuento = 0;

            $('.shopping-cart-table tbody tr').each(function() {
                var $row = $(this);
                var quantity = parseInt($row.find('.quantity-input').val()) || 0;
                var totalP = parseFloat($row.find('.cart-total').data('total')) || 0;
                total += totalP;
            });

            iva = Math.round((total * (ivaRate / 100)) * 100) / 100;
            descuento = Math.round((total * (discountRate / 100)) * 100) / 100;
            let totalFinal = Math.round((total + iva - descuento) * 100) / 100;

            $('#iva').val(formatNumber(iva));
            $('#descuento').val(formatNumber(descuento));
            $('#envio').val('0');
            $('#subTotal').val(formatNumber(total));
            $('#total-final').val(formatNumber(totalFinal));
        }

        // Función para mostrar alertas con Bootstrap
        // Función para mostrar alertas en un modal
        function showAlert(message, type) {
            $('#alertModalBody').html(message);
            $('#alertModal').modal('show');
        }
        // Manejar el envío del formulario
        $('#ventaForm').on('submit', function(event) {
            event.preventDefault(); // Evitar que el formulario se envíe de manera predeterminada

            let carrito = [];
            const filas = $('.shopping-cart-table tbody tr');

            filas.each(function() {
                const fila = $(this); // `this` se refiere a la fila actual en el bucle

                // Obtener el ID del producto desde el atributo data-id del <tr>
                const id = fila.data('id');

                // Obtener la cantidad desde el input de cantidad
                const cantidad = fila.find('input.quantity-input').val();

                // Obtener el precio original desde el atributo data-sub-total
                const precio = fila.find('.cart-sub-total').data('sub-total');

                // Obtener el descuento desde el atributo data-descuento
                const descuento = fila.find('.cart-descuento').data('descuento') || 0;

                // Obtener el total calculado desde el atributo data-total
                const total = fila.find('.cart-total').data('total');

                carrito.push({
                    id,
                    cantidad,
                    precio,
                    descuento,
                    total
                });
            });

            $('#carrito').val(JSON.stringify(carrito));
            console.log($('#carrito').val()); // Ver el valor del carrito en la consola

            // Asegurarse de que el carrito no esté vacío antes de enviar el formulario
            if (carrito.length > 0) {
                // Enviar el formulario si el carrito tiene productos
                this.submit(); // Si todo es correcto, envía el formulario
            } else {
                alert('El carrito está vacío. Agrega productos antes de confirmar la venta.');
            }
        });


        // Función para limpiar el formulario y redirigir al PDF
        function limpiarFormulario() {
            // Limpia todos los campos del formulario
            document.getElementById('ventaForm').reset();
            window.location.href = '<?php echo $pdf_url; ?>'; // Redirigir al PDF

        }

        // Ejecutar la limpieza del formulario si $success es verdadero
        <?php if ($success): ?>

            limpiarFormulario();
        <?php endif; ?>


    });
</script>

<!-- Estilos CSS -->
<style>
    .product-card {
        display: flex;
        flex-direction: column;
        width: 100%;
        height: 100%;
        border: 1px solid #ddd;
        border-radius: 5px;
        overflow: hidden;
        position: relative;
    }

    .card-img-container {
        width: 100%;
        height: 150px;
        overflow: hidden;
        display: flex;
        justify-content: center;
        align-items: center;
        padding-top: 30px;
    }

    .card-img-top {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
    }

    .card-body {
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        padding: 15px;
    }

    .card-title {
        margin: 0;
        font-size: 1.1rem;
        text-align: center;
    }

    .card-text {
        height: 60px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        margin: 10px 0;
    }

    .prices {
        text-align: center;
    }

    .original-price {
        font-size: 0.9rem;
        text-decoration: line-through;
        color: #888;
    }

    .current-price {
        font-size: 1.2rem;
        font-weight: bold;
        color: #FB6542;
    }

    .quantity-selector {
        margin-top: 10px;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .quantity-selector label {
        margin-bottom: 5px;
    }

    .quantity-selector input {
        width: 60px;
        padding: 5px;
        box-sizing: border-box;
        text-align: center;
    }

    .card-footer {
        padding: 10px;
        text-align: center;
        background-color: #f8f9fa;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        color: white;
        border-radius: 5px;
        padding: 10px 15px;
        cursor: pointer;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #004085;
    }

    .action {
        color: red;
    }

    .badge-danger {
        position: absolute;
        top: 10px;
        left: 10px;
        font-size: 16px;
        padding: 5px 10px;
        background-color: red;
        color: white;
        border-radius: 5px;
    }

    .product-card:hover {
        transform: scale(1.05);
        /* Agranda la tarjeta ligeramente */
        box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.2);
        /* Añade sombra al pasar el mouse */
        transition: transform 0.3s, box-shadow 0.3s;
    }
</style>

<?php include_once "includes/footer.php"; ?>