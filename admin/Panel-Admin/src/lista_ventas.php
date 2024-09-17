<?php
include_once "includes/header.php";
include_once "includes/slidebar.php";
$id_user = $_SESSION['idUser'];
$permiso = "ventas";

if (empty($existe) && $id_user != 1) {
    header("Location: permisos.php");
}
$query = mysqli_query($conexion, "SELECT v.*, c.idcliente, c.nombre FROM ventas v INNER JOIN cliente c ON v.id_cliente = c.idcliente");
?>
<table class="table table-light" id="tbl">
    <thead class="thead-dark">
        <tr>
            <th>#</th>
            <th>Cliente</th>
            <th>Total</th>
            <th>Fecha</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = mysqli_fetch_assoc($query)) { ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['nombre']; ?></td>
                <td><?php echo $row['total']; ?></td>
                <td><?php echo $row['fecha']; ?></td>
                <td>
                    <a href="pdf/generar.php?cl=<?php echo $row['id_cliente'] ?>&v=<?php echo $row['id'] ?>" target="_blank" class="btn btn-danger"><i class="fas fa-file-pdf"></i></a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>
<?php include_once "includes/footer.php"; ?>