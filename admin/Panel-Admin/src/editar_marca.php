<?php
include "../conexion.php";
date_default_timezone_set('America/Bogota'); // change according timezone
$fechaHoraActual = date("Y-m-d H:i:s");

if (!empty($_POST)) {
    $proveedor = $_POST['proveedor'];
    $fechaA = $_POST['fechaA'];
    $nombre = $_POST['nombre'];
    $estado = $_POST['estado'];
    $alert = "";
    $id = intval($_GET['id']);

    if (empty($proveedor) || empty($fechaA) || empty($nombre) || !in_array($estado, array("0", "1"))) {

        $alert = '<div class="alert alert-danger" role="alert">
                Todo los campos son obligatorios
              </div>';
    } else {


        $query_insert = mysqli_query($conexion, "UPDATE brands SET name='$nombre' , supplier ='$proveedor' , updateDate='$fechaA' , status = '$estado' WHERE  id = '$id'");
        if ($query_insert) {
            $alert = '<div class="alert alert-success" role="alert">
                Marca Registrada
              </div>';
        } else {
            $alert = '<div class="alert alert-danger" role="alert">
                Error al registrar la Marca
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
        <h5 class="card-title">Actualizar Marca</h5>
    </div>
    <div class="card-body">
        <div class="module-body">
            <h4 id="titulo" class="modal-title"></h4>
        </div>
        <form class="form" method="post" autocomplete="off" id="frmSubCategorias" enctype="multipart/form-data">
            <?php
            $id = intval($_GET['id']);
            $query = mysqli_query($conexion, "SELECT s.id as idS, s.company_name as company_name, b.* from brands b join suppliers s on s.id = b.supplier  WHERE b.id='$id' ");
            while ($row = mysqli_fetch_array($query)) {
                echo isset($alert) ? $alert : '';
            ?>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                            <div class="form-group">
                                <label for="proveedor">Proveedor</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-list"></i></span>
                                    </div>
                                    <select class="form-control" id="proveedor" name="proveedor" required>
                                        <option value="<?php echo htmlentities($row['idS']); ?>"><?php echo htmlentities($suplname = $row['company_name']); ?></option>
                                        <option value="">Seleccione Proveedor</option>
                                        <?php $ret = mysqli_query($conexion, "select * from suppliers");
                                        while ($result = mysqli_fetch_array($ret)) {
                                            echo $sup = $result['company_name'];
                                            if ($suplname == $sup) {
                                                continue;
                                            } else {
                                        ?>
                                                <option value="<?php echo $result['id']; ?>"><?php echo $result['company_name']; ?></option>
                                        <?php }
                                        } ?>
                                    </select>
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
                                <label style="font-family: sans-serif">Nombre de la Marca</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-list-ul"></i></span>
                                    </div>
                                    <input type="text" name="nombre" id="nombre" class="form-control" value="<?php echo  htmlentities($row['name']); ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
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
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 ">


                            <div class="control-group">
                                <label class="control-label" for="basicinput">Imagen 1 de Producto</label>
                                <div class="controls">
                                    <img src="../../../brandsimage/<?php echo htmlentities($row['image']); ?>" width="200" height="100"> <a href="actualizar_imagen_marca.php?id=<?php echo $row['id']; ?>">Cambiar  Imagen</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            <?php } ?>
            <div class="modal-footer clearfix">
                <button type="submit" class="btn btn-outline-success float-right"><span class="fas fa-save"></span> Actualizar Marca</button>
            </div>
        </form>
    </div>
    <!-- /.modal-content -->
</div>