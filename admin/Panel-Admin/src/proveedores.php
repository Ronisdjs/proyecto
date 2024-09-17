<?php
include_once "includes/header.php";
include_once "includes/slidebar.php";
include "../conexion.php";

date_default_timezone_set('America/Bogota'); // change according timezone
$fechaHoraActual = date("Y-m-d H:i:s");


if (!empty($_POST)) {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $tipoId = $_POST['tipoId'];
    $fechaC = $_POST['fechaC']; 
    $direccion = $_POST['direccion'];
    $identificacion = $_POST['identificacion'];
    $telefono = $_POST['telefono'];
    $estado = $_POST['estado'];
    $alert = "";

    if (empty($nombre) || empty($email) ||  empty($tipoId) ||  empty($fechaC) || empty($direccion) ||  empty($identificacion) || empty($telefono) ||  !in_array($estado, array("0", "1"))) {
        $alert = '<div class="alert alert-danger" role="alert">
                Todo los campos son obligatorios
              </div>';
    } else {
        $sql = mysqli_query($conexion, "SELECT * from suppliers where email = '$email' or identificationNumber = $identificacion ");
        $existe = mysqli_fetch_all($sql);
        if (empty($existe)) {
            $query_insert = mysqli_query($conexion, "INSERT INTO suppliers(company_name,address,phone,identificationNumber,status,typeDocumentId,email,creationdate) 
            values ('$nombre', '$direccion','$telefono','$identificacion','$estado','$tipoId', '$email','$fechaC')");
            if ($query_insert) {
                $alert = '<div class="alert alert-success" role="alert">
                    Proveedor Registrado
                  </div>';
            } else {
                $alert = '<div class="alert alert-danger" role="alert">
                    Error al registrar el Proveedor
                  </div>';
            }
        } else {

            $alert = '<div class="alert alert-danger" role="alert">
          Proveedor ya esta registrado en el sistema
            </div>';
        }
    }
}
?>

<div class="wrapper">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-header">
        <div class="container-fluid p-0">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h3 class="m-0 text-dark">Proveedores</h3>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Registros</a></li>
                        <li class="breadcrumb-item active">Provedores</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <div class="content">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="card card-purple card-outline">
                        <div class="card-header">
                            <h5 class="card-title">Registrar Provedor</h5>
                        </div>
                        <div class="card-body">
                            <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#modal-nuevo-proveedor"><i class="fas fa-file-signature"></i> Nuevo Registro</button>
                            <a href="compra_proveedores.php" class="btn btn-outline-success"><i class="fas fa-file-signature"></i> Nueva Compra</a>
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
                    <th>Tipo Id</th>
                    <th>Identificación / NIT</th>
                    <th>Nombre Empresa</th>
                    <th>Dirección</th>
                    <th>Email</th>
                    <th>Telefono</th>
                    <th>Estado</th>
                    <th>Accion</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = mysqli_query($conexion, "SELECT s.*, it.`type` as typeIdentification FROM suppliers s 
                                                        inner join identification_type it on it.id = s.typeDocumentId");
                $result = mysqli_num_rows($query);
                if ($result > 0) {
                    while ($data = mysqli_fetch_assoc($query)) {
                        if ($data['status'] == "1") {
                            $estado = '<span class="badge badge-pill badge-success">Activo</span>';
                        } else {
                            $estado = '<span class="badge badge-pill badge-danger">Inactivo</span>';
                        }
                ?>
                        <tr>
                            <td><?php echo $data['id']; ?></td>
                            <td><?php echo $data['typeIdentification']; ?></td>
                            <td><?php echo $data['identificationNumber']; ?></td>
                            <td><?php echo $data['company_name']; ?></td>
                            <td><?php echo $data['address']; ?></td>
                            <td><?php echo $data['email']; ?></td>
                            <td><?php echo $data['phone']; ?></td>
                            <td><?php echo $estado ?></td>
                            <td>
                                <?php if ($data['status'] == "1") { ?>

                                    <a href="editar_proveedores.php?id=<?php echo $data['id']; ?>" class="btn btn-success"><i class='fas fa-edit'></i></a>
                                    <br>
                                    <form action="eliminar_producto.php?id=<?php echo $data['id']; ?>" method="post" class="confirmar d-inline">
                                        <br>
                                        <button class="btn btn-danger" type="submit"><i class='fas fa-trash-alt'></i> </button>
                                    </form>
                                <?php } ?>
                            </td>
                        </tr>
                <?php }
                } ?>
            </tbody>

        </table>
    </div>
</div>

<div class="modal fade" id="modal-nuevo-proveedor">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 id="titulo" class="modal-title">Formulario De Registro Proveedor</h4>
                <button onclick="limpiarFormulario()" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" autocomplete="off" method="post" class="form" id="frmProductos" enctype="multipart/form-data">
                <?php echo isset($alert) ? $alert : ''; ?>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                            <div class="form-group">
                                <label style="font-family: sans-serif">Nombre Empresa / Compañia</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-file-signature"></i></span>
                                    </div>
                                    <input type="text" required="" name="nombre" id="nombre" class="form-control" placeholder="Ingresar Nombre de Empresa">
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
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
                        <hr style="width: 100%; margin-top: 5px; margin-bottom: 5px;">
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
                            <div class="form-group">
                                <label for="tipoId">Tipo Identificacion</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-list"></i></span>
                                    </div>
                                    <select class="form-control" id="tipoId" name="tipoId" required>
                                        <option value="">Seleccione Tipo</option>
                                        <?php $query = mysqli_query($conexion, "select * from identification_type");
                                        while ($row = mysqli_fetch_array($query)) { ?>
                                            <option value="<?php echo $row['id']; ?>"><?php echo $row['type']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
                            <div class="form-group">
                                <label style="font-family: sans-serif">No. Identificación</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-tag"></i></span>
                                    </div>
                                    <input type="text" required="" name="identificacion" id="identificacion" class="form-control" placeholder="Ingresar No. Ident.">
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
                            <div class="form-group">
                                <label style="font-family: sans-serif">Telefono</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-box-open"></i></span>
                                    </div>
                                    <input type="text" required="" name="telefono" id="telefono" class="form-control" placeholder="Ingresar telefono">
                                </div>
                            </div>
                        </div>
                        <hr style="width: 100%; margin-top: 5px; margin-bottom: 5px;">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                            <div class="form-group">
                                <label style="font-family: sans-serif">Email de contacto</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-file-signature"></i></span>
                                    </div>
                                    <input type="email" required="" name="email" id="email" class="form-control" placeholder="Ingresar Email de contacto">
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                            <div class="form-group">
                                <label style="font-family: sans-serif">Dirección / ubicación</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-file-signature"></i></span>
                                    </div>
                                    <input type="text" required="" name="direccion" id="direccion" class="form-control" placeholder="Ingresar direccion / ubicación">
                                </div>
                            </div>
                        </div>
                        <hr style="width: 100%; margin-top: 5px; margin-bottom: 5px;">
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
                            <div class="form-group">
                                <label style="font-family: sans-serif">Estado</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-check-circle"></i></span>
                                    </div>
                                    <select class="form-control" name="estado" id="estado">
                                        <option value="1">ACTIVO</option>
                                        <option value="0">INACTIVO</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer clearfix">
                    <button type="submit" class="btn btn-outline-success float-right"><span class="fas fa-save"></span> Registrar Proveedor</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<?php include_once "includes/footer.php"; ?>