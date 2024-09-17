<?php
include "../conexion.php";
date_default_timezone_set('America/Bogota'); // change according timezone
$fechaHoraActual = date("Y-m-d H:i:s");

if (!empty($_POST)) {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $fechaA = $_POST['fechaA'];
    $estado = $_POST['estado'];
    $id = intval($_GET['id']);
    $alert = "";
    if (empty($nombre) || empty($descripcion) || empty($fechaA) || !in_array($estado, array("0", "1"))) {
        $alert = '<div class="alert alert-danger" role="alert">
                Todo los campos son obligatorios
              </div>';
    } else {

        $query_insert = mysqli_query($conexion, "UPDATE category SET categoryName = '$nombre', categoryDescription='$descripcion' , updationDate = '$fechaA' ,status= '$estado' WHERE id = '$id' ");
        if ($query_insert) {
            $alert = '<div class="alert alert-success" role="alert">
                Categoria actualizada
              </div>';
            // Redirigir a categorias.php después de un breve retraso (opcional)
            header("Location: categorias.php");
            exit(); // Es importante usar exit() después de header() para detener la ejecución del script.
        } else {
            $alert = '<div class="alert alert-danger" role="alert">
                Error al Actualziar la categoria
              </div>';
            // Redirigir a categorias.php después de un breve retraso (opcional)
            header("Location: categorias.php");
            exit(); // Es importante usar exit() después de header() para detener la ejecución del script.
        }
    }
}
?>
<?php echo isset($alert) ? $alert : '';
include_once "includes/header.php";
include_once "includes/slidebar.php";
echo isset($alert) ? $alert : '';
?>

<div class="card card-purple card-outline">
    <div class="card-header">
        <h5 class="card-title">Actualizar Categoría</h5>
    </div>
    <div class="card-body">
        <div class="module-body">
            <h4 id="titulo" class="modal-title"></h4>
        </div>
        <form method="post" autocomplete="off" class="form" id="frmProductos" enctype="multipart/form-data">
            <?php $id = intval($_GET['id']);
            $query = mysqli_query($conexion, "select * from category where id='$id'");
            while ($row = mysqli_fetch_array($query)) {
            ?>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                            <div class="form-group">
                                <label style="font-family: sans-serif">Nombre de la Categoria</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-list"></i></span>
                                    </div>
                                    <input type="text" name="nombre" id="nombre" class="form-control" value="<?php echo  htmlentities($row['categoryName']); ?>" >
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                            <div class="form-group">
                                <label style="font-family: sans-serif">Fecha Actualziación</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                    </div>
                                    <input type="text" required="" name="fechaA" id="fechaA" class="form-control" value="<?php echo $fechaHoraActual; ?>" readonly>
                                </div>
                            </div>
                        </div>
                        <hr style="width: 100%; margin-top: 5px; margin-bottom: 5px;">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label style="font-family: sans-serif">Descripción de Categoria</label>
                                <textarea class="form-control" required="" name="descripcion" id="descripcion" rows="3" value="<?php echo  htmlentities($row['categoryDescription']); ?>"></textarea>
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
                <button type="submit" class="btn btn-outline-success float-right"><span class="fas fa-save"></span> Actualizar Categoria</button>
            </div>
        </form>
    </div>
</div>
<?php include_once "includes/footer.php"; ?>