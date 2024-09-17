<?php
include "../conexion.php";
date_default_timezone_set('America/Bogota'); // change according timezone
$fechaHoraActual = date("Y-m-d H:i:s");
$id = intval($_GET['id']);
if (!empty($_POST)) {
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $email = $_POST['email'];
    $tipoId = $_POST['tipoId'];
    $genero = $_POST['genero'];
    $fechaA = $_POST['fechaA'];
    $cargo = $_POST['cargo'];
    $identificacion = $_POST['identificacion'];
    $telefono = $_POST['telefono'];
    $estado = $_POST['estado'];
    $alert = "";
    if (empty($nombre) || empty($apellidos) || empty($email) ||  empty($tipoId) || empty($genero) || empty($fechaA) || empty($cargo) ||  empty($identificacion) || empty($telefono) ||  !in_array($estado, array("0", "1"))) {
        $alert = '<div class="alert alert-danger" role="alert">
                Todo los campos son obligatorios
              </div>';
    } else {

   
            $query_insert = mysqli_query($conexion, "UPDATE employees SET  name='$nombre', last_name='$apellidos', phone='$telefono', gender='$genero', `position`='$cargo', status='$estado', updateDate = '$fechaA' WHERE identification='$identificacion' and id = '$id'");
            if ($query_insert) {
                $alert = '<div class="alert alert-success" role="alert">
                    Empleado actualizado
                  </div>';
            } else {
                $alert = '<div class="alert alert-danger" role="alert">
                    Error al actualziar el Empleado
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
        <h5 class="card-title">Actualizar Empleado</h5>
    </div>
    <div class="card-body">
        <div class="module-body">
            <h4 id="titulo" class="modal-title"></h4>
        </div>
        <form method="post" autocomplete="off" method="post" class="form" id="frmProductos" enctype="multipart/form-data">
        <?php
            $id = intval($_GET['id']);
            $query = mysqli_query($conexion, "SELECT e.*, it.id as idT,it.type as type ,  g.id as idG, g.name as genderName , p.id as idP, p.name as positionName from employees e 
                                                join identification_type it on it.id = e.identificationType 
                                                join genders g on g.id = e.gender 
                                                join positions p  on p.id = e.`position` 
                                                where e.id = '$id' ");
            while ($row = mysqli_fetch_array($query)) {
            ?>
            <?php echo isset($alert) ? $alert : ''; ?>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                        <div class="form-group">
                            <label style="font-family: sans-serif">Nombre del Empleado</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-file-signature"></i></span>
                                </div>
                                <input type="text" required="" name="nombre" id="nombre" class="form-control" value="<?php echo  htmlentities($row['name']); ?>" >
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                        <div class="form-group">
                            <label style="font-family: sans-serif">Fecha Actualización</label>
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
                            <label style="font-family: sans-serif">Apellidos del Empleado</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-file-signature"></i></span>
                                </div>
                                <input type="text" required="" name="apellidos" id="apellidos" class="form-control" value="<?php echo  htmlentities($row['last_name']); ?>" required>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                        <div class="form-group">
                            <label style="font-family: sans-serif">Email del Empleado</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-file-signature"></i></span>
                                </div>
                                <input type="email" required="" name="email" id="email" class="form-control" value="<?php echo  htmlentities($row['email']); ?>" required readonly>
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
                            <label for="cargo">Cargo</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-list"></i></span>
                                </div>
                                <select class="form-control" id="cargo" name="cargo" required>
                                <option value="<?php echo htmlentities($row['idP']); ?>"><?php echo htmlentities($posN = $row['positionName']); ?></option>
                                    <?php $pos = mysqli_query($conexion, "select * from positions");
                                    while ($resulP = mysqli_fetch_array($pos)) { 
                                         echo $poN = $resultP['name'];
                                        if ($posN == $poN) {
                                            continue;
                                        } else {
                                    ?>
                                        <option value="<?php echo $resulP['id']; ?>"><?php echo $resulP['name']; ?></option>
                                    <?php } 
                                    }?>
                                </select>
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
                                <input type="number"  name="identificacion" id="identificacion" class="form-control" value="<?php echo  htmlentities($row['identification']); ?>" require readonly>
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
                                <input type="number" required="" name="telefono" id="telefono" class="form-control" value="<?php echo  htmlentities($row['phone']); ?>" require>
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
                                <select class="form-control" name="estado" id="estado"  value="<?php echo  htmlentities($row['status']); ?>" required>
                                <option value="1" <?php if ($row['status'] == 1) echo 'selected'; ?>>ACTIVO</option>
                                <option value="0" <?php if ($row['status'] == 0) echo 'selected'; ?>>INACTIVO</option>
                                </select>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <?php } ?>
            <div class="modal-footer clearfix">
                <button type="submit" class="btn btn-outline-success float-right"><span class="fas fa-save"></span> Actualizar Empleado</button>
            </div>
        </form>
    </div>
    <!-- /.modal-content -->
</div>