<?php
include "../conexion.php";
date_default_timezone_set('America/Bogota'); // change according timezone
$fechaHoraActual = date("Y-m-d H:i:s");
$id = intval($_GET['id']);

if (!empty($_POST)) {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $tipoId = $_POST['tipoId'];
    $fechaA = $_POST['fechaA'];
    $direccion = $_POST['direccion'];
    $identificacion = $_POST['identificacion'];
    $telefono = $_POST['telefono'];
    $estado = $_POST['estado'];
    $alert = "";

    if (empty($nombre) || empty($email) ||  empty($tipoId) ||  empty($fechaA) || empty($direccion) ||  empty($identificacion) || empty($telefono) ||  !in_array($estado, array("0", "1"))) {
        $alert = '<div class="alert alert-danger" role="alert">
                Todo los campos son obligatorios
              </div>';
    } else {

        $query_insert = mysqli_query($conexion, "UPDATE suppliers SET company_name='$nombre', address='$direccion', phone='$telefono',status='$estado', typeDocumentId='$tipoId', updateDate='$fechaA' WHERE id='$id' ");
        if ($query_insert) {
            $alert = '<div class="alert alert-success" role="alert">
                    Proveedor Actualziado
                  </div>';
        } else {
            $alert = '<div class="alert alert-danger" role="alert">
                    Error al Actualziar el Proveedor
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
        <h5 class="card-title">Actualizar Proveedor</h5>
    </div>
    <div class="card-body">
        <div class="module-body">
            <h4 id="titulo" class="modal-title"></h4>
        </div>
        <form method="post" autocomplete="off" method="post" class="form" id="frmProductos">
            <?php $id = intval($_GET['id']);
            $query = mysqli_query($conexion, "SELECT s.* , it.type as type  , it.id as idT  from suppliers s  join identification_type it on it.id = s.typeDocumentId  where s.id= '$id' ");
            while ($row = mysqli_fetch_array($query)) {
            echo isset($alert) ? $alert : '';
            ?>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                            <div class="form-group">
                                <label style="font-family: sans-serif">Nombre Empresa / Compañia</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-file-signature"></i></span>
                                    </div>
                                    <input type="text" required name="nombre" id="nombre" class="form-control" value="<?php echo  htmlentities($row['company_name']); ?>">
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
                                <label style="font-family: sans-serif">No. Identificación</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-tag"></i></span>
                                    </div>
                                    <input type="number" required="" name="identificacion" id="identificacion" class="form-control" value="<?php echo  htmlentities($row['identificationNumber']); ?>" readonly>
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
                                    <input type="number" required="" name="telefono" id="telefono" class="form-control" value="<?php echo  htmlentities($row['phone']); ?>">
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
                                    <input type="email" required="" name="email" id="email" class="form-control" value="<?php echo  htmlentities($row['email']); ?>" readonly>
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
                                    <input type="text" required="" name="direccion" id="direccion" class="form-control" value="<?php echo  htmlentities($row['address']); ?>">
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
                                    <select class="form-control" name="estado" id="estado" value="<?php echo  htmlentities($row['status']); ?>">
                                        <option value="1" <?php if ((int)$row['status'] === 1) echo 'selected'; ?>>ACTIVO</option>
                                        <option value="0" <?php if ((int)$row['status'] === 0) echo 'selected'; ?>>INACTIVO</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <div class="modal-footer clearfix">
                <button type="submit" class="btn btn-outline-success float-right"><span class="fas fa-save"></span> Registrar Proveedor</button>
            </div>
        </form>
    </div>

</div>
<?php include_once "includes/footer.php"; ?>