<?php
include "../conexion.php";
date_default_timezone_set('America/Bogota'); // change according timezone
$fechaHoraActual = date("Y-m-d H:i:s");
$pid = intval($_GET['id']); // product id
if (!empty($_POST)) {
 
    $nombre = $_POST['nombre'];
    $productimage = $_FILES["productimage"]["name"];
    $alert = "";

    if (empty($productimage)) {

        $alert = '<div class="alert alert-danger" role="alert">
                No se ha cargado la nueva imagen
              </div>';
    } else {


        move_uploaded_file($_FILES["productimage"]["tmp_name"], "../../../brandsimage/" . $_FILES["productimage"]["name"]);
        $query_insert = mysqli_query($conexion, "UPDATE brands SET image = '$productimage'  WHERE  id = '$pid'");
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
echo isset($alert) ? $alert : '';

?>


<div class="card card-purple card-outline">
    <div class="card-header">
        <h5 class="card-title">Actualizar Sub Categoría</h5>
    </div>
    <div class="card-body">
        <div class="module-body">
            <h4 id="titulo" class="modal-title"></h4>
        </div>
        <form class="form" method="post" autocomplete="off"  enctype="multipart/form-data">
            <?php

            $query = mysqli_query($conexion, "select * from brands where id='$pid'");
            while ($row = mysqli_fetch_array($query)) {
            ?>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                    <div class="form-group">
                        <label style="font-family: sans-serif">Nombre de la Marca</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-list-ul"></i></span>
                            </div>
                            <input type="text" name="nombre" id="nombre" class="form-control" readonly value="<?php echo  htmlentities($row['name']); ?>" require>
                        </div>
                    </div>
                </div>


                <hr style="width: 100%; margin-top: 5px; margin-bottom: 5px;">


                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">


                    <div class="control-group">
                        <label class="control-label" for="basicinput">Imagen Actual</label>
                        <div class="controls">
                            <img src="../../../brandsimage/<?php echo htmlentities($row['image']); ?>" width="200" height="100">
                        </div>
                    </div>
                </div>

                <hr style="width: 100%; margin-top: 5px; margin-bottom: 5px;">

                <div class="control-group">
                    <label class="control-label" for="basicinput">Nueva Imagen</label>
                    <div class="controls">
                        <input type="file" name="productimage" id="productimage" value="" class="span8 tip" required>
                    </div>
                </div>

            <?php } ?>
            <div class="modal-footer clearfix">
                <button type="submit" class="btn btn-outline-success float-right"><span class="fas fa-save"></span> Actualizar Imagen</button>
            </div>
        </form>
    </div>
    <!-- /.modal-content -->
</div>