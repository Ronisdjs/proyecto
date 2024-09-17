<?php include_once "includes/header.php";
include_once "includes/slidebar.php";
include "../conexion.php";

date_default_timezone_set('America/Bogota'); // change according timezone
$fechaHoraActual = date("Y-m-d H:i:s");

if (!empty($_POST)) {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $fechaC = $_POST['fechaC'];
    $fechaA = $_POST['fechaC'];
    $estado = $_POST['estado'];

    $alert = "";
    if (empty($nombre) || empty($descripcion) || empty($fechaC) || !in_array($estado, array("0", "1"))) {
        $alert = '<div class="alert alert-danger" role="alert">
                Todo los campos son obligatorios
              </div>';
    } else {

        $query_insert = mysqli_query($conexion, "INSERT INTO category(categoryName,categoryDescription,creationDate,updationDate,status) values ('$nombre', '$descripcion','$fechaC','$fechaA','$estado')");
        if ($query_insert) {
            $alert = '<div class="alert alert-success" role="alert">
                Producto Registrado
              </div>';
        } else {
            $alert = '<div class="alert alert-danger" role="alert">
                Error al registrar el producto
              </div>';
        }
    }
}
?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid p-0">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h3 class="m-0 text-dark">Ventas</h3>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Registros</a></li>
                        <li class="breadcrumb-item active">Ventas</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="card card-purple card-outline">
                        <div class="card-header">
                            <h5 class="card-title">Registrar Venta</h5>
                        </div>
                        <div class="card-body">
                            <button type="button" class="btn btn-outline-success" onclick="location.href='nueva_venta.php'"><i class="fas fa-file-signature"></i> Nuevo Registro</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <?php echo isset($alert) ? $alert : ''; ?>
    <br>
    <div class="table-responsive">
        <table class="table table-striped table-bordered" id="tbl">
            <thead class="thead-dark">
                <tr>
                    <th>Id</th>
                    <th>Fecha Venta</th>
                    <th>Cliente</th>
                    <th>Empleado</th>
                    <th>Precio Total</th>
                    <th>Descuento</th>
                    <th>Impuesto / IVA</th>
                    <th>Portal de Venta</th>
                    <th>Estado</th>
                    <th>Accion</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include "../conexion.php";

                $query = mysqli_query($conexion, "SELECT s.*, u.name AS nameUser, CONCAT( e.name + ' ' +  e.last_name ) AS nameEmployee  FROM sales s 
                                                    INNER JOIN users u ON u.id = s.user_id 
                                                    INNER JOIN employees e ON  e.id = s.employee_id");
                $result = mysqli_num_rows($query);
                if ($result > 0) {
                    while ($data = mysqli_fetch_assoc($query)) {
                        if ($data['sale_status'] == "1") {
                            $estado = '<span class="badge badge-pill badge-success">Aprovada</span>';
                        } else {
                            $estado = '<span class="badge badge-pill badge-danger">Declinada</span>';
                        }
                ?>
                        <tr>
                            <td><?php echo $data['id']; ?></td>
                            <td><?php echo $data['creation_date']; ?></td>
                            <td><?php echo $data['nameUser']; ?></td>
                            <td><?php echo $data['nameEmployee']; ?></td>
                            <td><?php echo $data['total_price']; ?></td>
                            <td><?php echo $data['discount']; ?></td>
                            <td><?php echo $data['tax_iva']; ?></td>
                            <td><?php echo $data['sale_portal']; ?></td>
                            <td><?php echo $estado ?></td>
                            <td>
                                <?php if ($data['sale_status'] == "1") { ?>

                                    <a href="detalle_de_venta.php?id=<?php echo $data['id']; ?>" class="btn btn-info"><i class='fas fa-info'></i>detalle</a>
                                <?php } ?>
                            </td>
                        </tr>
                <?php }
                } ?>
            </tbody>

        </table>
    </div>

    <?php include_once "includes/footer.php"; ?>