<?php
include "../conexion.php";
date_default_timezone_set('America/Bogota'); // change according timezone
$fechaHoraActual = date("Y-m-d H:i:s");
$id = intval($_GET['id']);
if (!empty($_POST)) {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $tipoId = $_POST['tipoId'];
    $genero = $_POST['genero'];
    $fechaA = $_POST['fechaA'];
    $registro = $_POST['registro'];
    $identificacion = $_POST['identificacion'];
    $telefono = $_POST['telefono'];
    $password = $_POST['identificacion'];
    $direccion = $_POST['direccion'];
    $estado = $_POST['estado'];
    $alert = "";

    if (
        empty($nombre) || empty($email) || empty($tipoId) ||  empty($genero) || empty($fechaA) || empty($registro) || empty($identificacion) ||  empty($telefono)
        || empty($direccion) || !in_array($estado, array("0", "1"))
    ) {
        $alert = '<div class="alert alert-danger" role="alert">
                Todo los campos son obligatorios
              </div>';
    } else {


            $query_insert = mysqli_query($conexion, "UPDATE users SET name='$nombre',  contactno=' $telefono',  shippingAddress='$direccion',   updationDate='$fechaA', status='$estado', identificationType='$tipoId',  gender=' $genero' WHERE id= '$id' ");
            if ($query_insert) {
                $alert = '<div class="alert alert-success" role="alert">
                    Cliente Registrado
                  </div>';
            } else {
                $alert = '<div class="alert alert-danger" role="alert">
                    Error al registrar el cliente
                  </div>';
            }

    }
}
?>

<?php
include_once "includes/header.php";
include_once "includes/slidebar.php";
?>


<div class="card card-purple card-outline">
    <div class="card-header">
        <h5 class="card-title">Actualizar Cliente</h5>
    </div>
    <div class="card-body">
        <div class="module-body">
            <h4 id="titulo" class="modal-title"></h4>
        </div>
        <form method="post" autocomplete="off" method="post" class="form" id="frmProductos">
            <?php
            $id = intval($_GET['id']);
            $query = mysqli_query($conexion, "SELECT u.*,it.id as idT,it.type as type ,g.id as idG, g.name as genderName from users u
                                            join identification_type it on it.id = u.identificationType 
                                            join genders g on g.id = u.gender WHERE u.id= '$id'");
            while ($row = mysqli_fetch_array($query)) {
                echo isset($alert) ? $alert : '';
            ?>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                            <div class="form-group">
                                <label style="font-family: sans-serif">Nombre completo del Cliente</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-file-signature"></i></span>
                                    </div>
                                    <input type="text" required="" name="nombre" id="nombre" class="form-control" value="<?php echo  htmlentities($row['name']); ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                            <div class="form-group">
                                <label style="font-family: sans-serif">Fecha Actualizacion</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                    </div>
                                    <input type="text" required="" name="fechaA" id="fechaA" class="form-control" value="<?php echo $fechaHoraActual; ?>" readonly>
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
                                        <option value="<?php echo htmlentities($row['idT']); ?>"><?php echo htmlentities($typeI = $row['type']); ?></option>
                                        <?php $typ = mysqli_query($conexion, "select * from identification_type");
                                        while ($result = mysqli_fetch_array($typ)) {
                                            echo $type = $result['type'];
                                            if ($typeI == $type) {
                                                continue;
                                            } else {
                                        ?>
                                                <option value="<?php echo $result['id']; ?>"><?php echo $result['type']; ?></option>
                                        <?php }
                                        } ?>
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
                                        <option value="<?php echo htmlentities($row['idG']); ?>"><?php echo htmlentities($genderN = $row['genderName']); ?></option>
                                        <?php $gen = mysqli_query($conexion, "select * from genders");
                                        while ($resultG = mysqli_fetch_array($gen)) {
                                            echo $genN = $resultG['name'];
                                            if ($genderN == $genN) {
                                                continue;
                                            } else {
                                        ?>
                                                <option value="<?php echo $resultG['id']; ?>"><?php echo $resultG['name']; ?></option>
                                        <?php }
                                        } ?>
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
                                        <span class="input-group-text"><i class="fas fa-tag"></i></span>
                                    </div>
                                    <input type="number" name="identificacion" id="identificacion" class="form-control" value="<?php echo  htmlentities($row['identificationNumber']); ?>" required  readonly>
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
                                    <input type="number"  name="telefono" id="telefono" class="form-control" value="<?php echo  htmlentities($row['contactno']); ?>" required>
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
                                    <select class="form-control" name="estado" id="estado" value="<?php echo  htmlentities($row['status']); ?>" required>
                                        <option value="1" <?php if ($row['status'] == 1) echo 'selected'; ?>>ACTIVO</option>
                                        <option value="0" <?php if ($row['status'] == 0) echo 'selected'; ?>>INACTIVO</option>
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
                                    <input type="email" name="email" id="email" class="form-control" value="<?php echo  htmlentities($row['email']); ?>" readonly>
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
                                    <input type="text" required="" name="direccion" id="direccion" class="form-control" value="<?php echo  htmlentities($row['shippingAddress']); ?>">
                                </div>
                            </div>
                        </div>
                        <hr style="width: 100%; margin-top: 5px; margin-bottom: 5px;">
                        <div style="color: red; text-align: center; margin: 0 auto; width: 50%;">
                            <i class="fas fa-exclamation-triangle"></i>
                            La contraseña sera el Numero de identificación del cliente, por favor ingresar a la web para cambiarla.
                        </div>

                    </div>
                </div>
            <?php } ?>
            <div class="modal-footer clearfix">
                <button type="submit" class="btn btn-outline-success float-right"><span class="fas fa-save"></span> Actualizar Cliente</button>
            </div>
        </form>
    </div>

</div>
<?php include_once "includes/footer.php"; ?>