<?php
date_default_timezone_set('America/Bogota'); // change according timezone
$fechaHoraActual = date("Y-m-d H:i:s");

include "../conexion.php";
$oid = intval($_GET['oid']);

if (!empty($_POST)) {
  $status = $_POST['estado'];
  $remark = $_POST['observacion'];
  $date = $_POST['fecha'];
  $alert = "";
  $query = mysqli_query($conexion, "insert into ordertrackhistory(orderId,status,remark,postingDate) values('$oid','$status','$remark','$date')");
  $sql = mysqli_query($conexion, "update orders set orderStatus='$status' where id='$oid'");
  $alert = '<div class="alert alert-success" role="alert">
                Estado de pedido Actualizado
              </div>';
} else {
 
}

?>
<?php
include_once "includes/header.php";
include_once "includes/slidebar.php";
echo isset($alert) ? $alert : '';
?>

<div class="mx-auto">
  <div class="card card-purple card-outline ">
    <div class="card-header">
      <h5 class="card-title">Actualizar Estado Pedido</h5>
    </div>
    <div class="card-body">
      <div class="module-body">
        <h4 id="titulo" class="modal-title d-flex justify-content-center align-items-center">PEDIDO No : <?php echo $oid; ?></h4>
      </div>
      <form class="form" method="post" autocomplete="off">
        <?php

        $id = intval($_GET['oid']);
        $query = mysqli_query($conexion, "SELECT * from Orders WHERE id = '$id' ");
        while ($row = mysqli_fetch_array($query)) {
        ?>
          <div class="modal-body d-flex justify-content-center align-items-center ">
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">

              <div class="form-group">
                <label style="font-family: sans-serif">Fecha Actualizacion</label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                  </div>
                  <input type="text" required="" name="fecha" id="fecha" class="form-control" value="<?php echo $fechaHoraActual; ?>" readonly>
                </div>
              </div>

              <div class="form-group">
                <label>Observación:</label>
                <textarea class="form-control" required="" name="observacion" id="observacion" rows="4"></textarea>
              </div>

              <div class="form-group">
                <label style="font-family: sans-serif">Estado</label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-check-circle"></i></span>
                  </div>
                  <select class="form-control" name="estado" id="estado" value="<?php echo  htmlentities($row['orderStatus']); ?>">
                    <option value="En Progreso" <?php if ($row['orderStatus'] == "En Progreso") echo 'selected'; ?>>En Progreso</option>
                    <option value="Enviado" <?php if ($row['orderStatus'] == "Enviado") echo 'selected'; ?>>Enviado</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
        <?php } ?>
        <div class="modal-footer clearfix">
          <button type="submit" class="btn btn-outline-success float-right"><span class="fas fa-save"></span> Actualizar Pedido</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php include_once "includes/footer.php"; ?>