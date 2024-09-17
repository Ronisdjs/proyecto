<?php include_once "includes/header.php";
include_once "includes/slidebar.php";
include "../conexion.php";
date_default_timezone_set('America/Bogota'); // change according timezone
$fechaHoraActual = date("Y-m-d H:i:s");

if (!empty($_POST)) {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $tipoId = $_POST['tipoId'];
    $genero = $_POST['genero'];
    $fechaC = $_POST['fechaC'];
    $registro = $_POST['registro'];
    $identificacion = $_POST['identificacion'];
    $telefono = $_POST['telefono'];
    $password =  md5($_POST['identificacion']);
    $direccion = $_POST['direccion'];
    $estado = $_POST['estado'];
    $alert = "";

    if (
        empty($nombre) || empty($email) || empty($tipoId) ||  empty($genero) || empty($fechaC) || empty($registro) || empty($identificacion) ||  empty($telefono)
        || empty($direccion) || !in_array($estado, array("0", "1"))
    ) {
        $alert = '<div class="alert alert-danger" role="alert">
                Todo los campos son obligatorios
              </div>';
    } else {

        $sql = mysqli_query($conexion, "SELECT * from users where email = '$email' or identificationNumber = $identificacion ");
        $existe = mysqli_fetch_all($sql);
        if (empty($existe)) {

            $query_insert = mysqli_query($conexion, "INSERT INTO users(name, email, contactno, password, shippingAddress, shippingState, shippingCity, shippingPincode, billingAddress, billingState, billingCity, billingPincode, regDate, updationDate, status, identificationType, identificationNumber, gender, registerType)
            values ('$nombre', '$email','$telefono','$password','$direccion',NULL, NULL,NULL,'$direccion', NULL, NULL, NULL,'$fechaC','$fechaC','$estado','$tipoId','$identificacion','$genero','$registro')");
            if ($query_insert) {
                $alert = '<div class="alert alert-success" role="alert">
                    Cliente Registrado
                  </div>';
            } else {
                $alert = '<div class="alert alert-danger" role="alert">
                    Error al registrar el cliente
                  </div>';
            }
        } else {

            $alert = '<div class="alert alert-danger" role="alert">
            Cliente ya esta registrado en el sistema
            </div>';
        }
    }
}
?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid p-0">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h3 class="m-0 text-dark">Clientes</h3>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Registros</a></li>
                    <li class="breadcrumb-item active">Clientes</li>
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
                        <h5 class="card-title">Registrar Cliente</h5>
                    </div>
                    <div class="card-body">
                        <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#modal-nuevo-cliente"><i class="fas fa-file-signature"></i> Nuevo Registro</button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<br>
<?php echo isset($alert) ? $alert : ''; ?>
<div class="table-responsive">
    <table class="table table-striped table-bordered" id="tbl">
        <thead class="thead-dark">
            <tr>
                <th>Id</th>
                <th>Tipo Ident.</th>
                <th>Identificación</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Genero</th>
                <th>Telefono</th>
                <th>Dirección Envios</th>
                <th>Dirección Facturación</th>
                <th>Fecha Registro</th>
                <th>Fecha Actualización</th>
                <th>Tipo Registro</th>
                <th>Estado</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include "../conexion.php";

            $query = mysqli_query($conexion, "SELECT u.* , g.name as genderName , it.`type`as idenTypeName FROM users u
                                                INNER JOIN identification_type it on it.id = u.identificationType 
                                                INNER JOIN genders g on g.id = u.gender");
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
                        <td><?php echo $data['idenTypeName']; ?></td>
                        <td><?php echo $data['identificationNumber']; ?></td>
                        <td><?php echo $data['name']; ?></td>
                        <td><?php echo $data['email']; ?></td>
                        <td><?php echo $data['genderName']; ?></td>
                        <td><?php echo $data['contactno']; ?></td>
                        <td><?php echo $data['shippingAddress']; ?></td>
                        <td><?php echo $data['billingAddress']; ?></td>
                        <td><?php echo $data['regDate']; ?></td>
                        <td><?php echo $data['updationDate']; ?></td>
                        <td><?php echo $data['registerType']; ?></td>
                        <td><?php echo $estado; ?></td>
                        <td>
                            <?php if ($data['status'] == "1") { ?>
                                <a href="editar_cliente.php?id=<?php echo $data['id']; ?>" class="btn btn-success"><i class='fas fa-edit'></i></a>
                                <br>
                                <form action="eliminar_cliente.php?id=<?php echo $data['id']; ?>" method="post" class="confirmar d-inline">
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
<div class="modal fade" id="modal-nuevo-cliente">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 id="titulo" class="modal-title">Formulario De Registro Cliente</h4>
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
                                <label style="font-family: sans-serif">Nombre completo del Cliente</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-file-signature"></i></span>
                                    </div>
                                    <input type="text" required="" name="nombre" id="nombre" class="form-control" placeholder="Ingresar Nombre de Cliente">
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
                                <label for="genero">Genero</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-list"></i></span>
                                    </div>
                                    <select class="form-control" id="genero" name="genero" required>
                                        <option value="">Seleccione Genero</option>
                                        <?php $query = mysqli_query($conexion, "select * from genders");
                                        while ($row = mysqli_fetch_array($query)) { ?>
                                            <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
                            <div class="form-group">
                                <label style="font-family: sans-serif">Tipo de Registro</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-tag"></i></span>
                                    </div>
                                    <input type="text" required="" name="registro" id="registro" class="form-control" value="Fisico" readonly>
                                </div>
                            </div>
                        </div>
                        <hr style="width: 100%; margin-top: 5px; margin-bottom: 5px;">

                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
                            <div class="form-group">
                                <label style="font-family: sans-serif">No. Identificación</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-id-card"></i></span>
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
                        <hr style="width: 100%; margin-top: 5px; margin-bottom: 5px;">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                            <div class="form-group">
                                <label style="font-family: sans-serif">Email del Cliente</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-file-signature"></i></span>
                                    </div>
                                    <input type="email" required="" name="email" id="email" class="form-control" placeholder="Ingresar Email de Cliente">
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                            <div class="form-group">
                                <label style="font-family: sans-serif">Dirección envio / Facturación</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-file-signature"></i></span>
                                    </div>
                                    <input type="text" required="" name="direccion" id="direccion" class="form-control" placeholder="Ingresar direccion de Cliente">
                                </div>
                            </div>
                        </div>
                        <hr style="width: 100%; margin-top: 5px; margin-bottom: 5px;">
                        <div style="color: red; text-align: center; margin: 0 auto; width: 50%;">
                            <i class="fas fa-exclamation-triangle"></i>
                             La contraseña sera el Numero de identificación del cliente, por favor ingresar a la web para  cambiarla.
                        </div>
                        
                    </div>
                </div>
                <div class="modal-footer clearfix">
                    <button type="submit" class="btn btn-outline-success float-right"><span class="fas fa-save"></span> Registrar Cliente</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<?php include_once "includes/footer.php"; ?>