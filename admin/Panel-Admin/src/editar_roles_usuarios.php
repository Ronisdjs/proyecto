<?php
include "../conexion.php";
date_default_timezone_set('America/Bogota'); // change according timezone
$fechaHoraActual = date("Y-m-d H:i:s");

$id = intval($_GET['id']);
$alert = "";
if (!empty($_POST)) {
    $nombre = $_POST['nombre'];
    $fechaA = $_POST['fechaA'];
    $estado = $_POST['estado'];
    $alert = "";

    if (empty($nombre) || empty($fechaA) ||  !in_array($estado, array("0", "1"))) {

        $alert = '<div class="alert alert-danger" role="alert">
                Todo los campos son obligatorios
              </div>';
    } else {

        $query_insert = mysqli_query($conexion, "UPDATE  positions SET name ='$nombre',status='$estado' WHERE id = '$id'");
        if ($query_insert) {
            $alert = '<div class="alert alert-success" role="alert">
               Rol  Actualizado
              </div>';
              header("Location: roles_usuarios.php");
              exit(); // Es importante usar exit() después de header() para detener la ejecución del script.
        } else {
            $alert = '<div class="alert alert-danger" role="alert">
                Error al Actualziar el  Rol
              </div>';
              header("Location: roles_usuarios.php");
              exit(); // Es importante usar exit() después de header() para detener la ejecución del script.
        }
    }
}

include_once "includes/header.php";
include_once "includes/slidebar.php";
echo isset($alert) ? $alert : '';
?>



<div class="card card-purple card-outline">
    <div class="card-header">
        <h5 class="card-title">Actualizar Rol Empleado</h5>
    </div>
    <div class="card-body">
        <div class="module-body">
            <h4 id="titulo" class="modal-title"></h4>
        </div>

        <form class="form" method="post" autocomplete="off" id="frmRol" enctype="multipart/form-data">
        <?php
        $query = mysqli_query($conexion, "SELECT * from positions WHERE id='$id'");
        while ($row = mysqli_fetch_array($query)) {
            ?>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                        <div class="form-group">
                            <label style="font-family: sans-serif">Nombre de Rol</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-list-ul"></i></span>
                                </div>
                                <input type="text" name="nombre" id="nombre" class="form-control" value="<?php echo  htmlentities($row['name']); ?>">
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

                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                        <div class="form-group">
                            <label style="font-family: sans-serif">Estado</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-check-circle"></i></span>
                                </div>
                                <select class="form-control" name="estado" id="estado" value="<?php echo  htmlentities($row['status']); ?>">
                                    <option value="1" <?php if ($row['status'] == 1) echo 'selected'; ?>>ACTIVO</option>
                                    <option value="0" <?php if ($row['status'] == 0) echo 'selected'; ?>>INACTIVO</option>
                                    </select>
                                </select>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            <?php } ?>
            <div class="modal-footer clearfix">
                <button type="submit" class="btn btn-outline-success float-right"><span class="fas fa-save"></span> Actualizar Rol</button>
            </div>
        </form>
    </div>
    <!-- /.modal-content -->
</div>