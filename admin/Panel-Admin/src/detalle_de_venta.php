<?php
include_once "includes/header.php";
include_once "includes/slidebar.php";
include "../conexion.php";
$idventa = intval($_GET['id']);
date_default_timezone_set('America/Bogota'); // change according timezone
$fechaHoraActual = date("Y-m-d H:i:s");

?>


<div class="card card-purple card-outline">
    <div class="card-header">
        <h5 class="card-title">Detalle de Venta</h5>
    </div>
    <div class="card-body">
        <div class="module-body">
            <h4 id="titulo" class="modal-title"></h4>

        </div>

        <div class="table-responsive">
            <table class="table table-striped table-bordered" id="tbl">
                <thead class="thead-dark">
                    <tr>
                        <th>Id</th>
                        <th>Descripcion</th>
                        <th>Catidad</th>
                        <th>Precio Unitario</th>
                        <th>Descuento</th>
                        <th>Total Producto </th>
                        <th>Envio</th>
                        <th>Iva 19%</th>
                        <th>Total Venta</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $status1 = 'Enviado';
                    $ventas = mysqli_query($conexion, "SELECT d.*, p.productName, p.discount, s.total_price, s.tax_iva FROM sale_detail d 
                    INNER JOIN products p ON d.product_id = p.id INNER JOIN sales s ON s.id = d.sale_id WHERE d.sale_id = $idventa");

                    $total_venta = 0;
                    $envio = 0;
                    while ($row = mysqli_fetch_assoc($ventas)) {
                        $cnt = 1;
                        $iva = $row['tax_iva'];
                        $total_venta = $row['total_price'];
                        $subtotal_producto = $row['price_discount'];
                    ?>
                        <tr>
                            <td><?php echo htmlentities($cnt); ?></td>
                            <td><?php echo htmlentities($row['productName']); ?></td>
                            <td><?php echo htmlentities($row['quantity_product']); ?></td>
                            <td><?php echo htmlentities(number_format($row['unit_price'])); ?></td>
                            <td><?php echo htmlentities($row['discount']); ?></td>
                            <td><?php echo htmlentities(number_format($subtotal_producto)); ?></td>
                            <td><?php echo htmlentities($envio); ?></td>
                            <td><?php echo htmlentities($iva); ?></td>
                            <td><?php echo htmlentities(number_format($total_venta)); ?></td>


                        </tr>

                    <?php
                    } ?>
                </tbody>

            </table>
        </div>
    </div>
    <!-- <div class="modal-footer clearfix">
                    <button action="ventas.php" class="btn btn-outline-success float-right"><span class="fas fa-save"></span> Volver</button>
                </div> -->
</div>
<?php include_once "includes/footer.php"; ?>