<?php
require_once "../conexion.php";
$id = "1";
if (!empty($_POST)) {
    $alert = '';
    if (empty($_POST['nombre']) || empty($_POST['telefono']) || empty($_POST['descripcion']) || empty($_POST['email']) || empty($_POST['direccion']) || empty($_POST['nit'])) {
        $alert = '<div class="alert alert-danger" role="alert">
            Todo los campos son obligatorios
        </div>';
    } else {
        $nombre = $_POST['nombre'];
        $nit = $_POST['nit'];
        $telefono = $_POST['telefono'];
        $descripcion = $_POST['descripcion'];
        $email = $_POST['email'];
        $direccion = $_POST['direccion'];
        $id = "1";
        $update = mysqli_query($conexion, "UPDATE configuration SET name = '$nombre', phone = '$telefono', email = '$email', address = '$direccion' , description = '$descripcion', nit = '$nit' WHERE id = $id");
        if ($update) {
            $alert = '<div class="alert alert-success" role="alert">
            Datos de la empresa Actualizados
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
        <h5 class="card-title">Configurar Datos Empresa</h5>
    </div>
    <div class="card-body">
        <div class="module-body">
            <h4 id="titulo" class="modal-title"></h4>
        </div>
        <form action="" method="post" class="p-3">
            <?php echo isset($alert) ? $alert : '';
            $sql = mysqli_query($conexion, "SELECT * FROM configuration WHERE id = '$id'");
            $data = mysqli_fetch_all($sql, MYSQLI_ASSOC);
            ?>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                        <div class="form-group">
                            <label>Nombre de la empresa:</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-list"></i></span>
                                </div>
                                <input type="text" name="nombre" class="form-control" value="<?php echo htmlentities($data[0]['name']); ?>" id="nombre" placeholder="Nombre de la Empresa" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Teléfono de la empresa:</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-list"></i></span>
                                </div>
                                <input type="number" name="telefono" class="form-control" value="<?php echo htmlentities($data[0]['phone']); ?>" id="telefono" placeholder="teléfono de la Empresa" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label style="font-family: sans-serif">Descripción de la empresa</label>
                            <textarea class="form-control" required="" name="descripcion" id="descripcion" rows="4"><?php echo htmlentities($data[0]['description']); ?></textarea>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                        <div class="form-group">
                            <label>NIT / ID de la empresa :</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-list"></i></span>
                                </div>
                                <input type="hidden" name="id" value="">
                                <input type="text" name="nit" class="form-control" value="<?php echo htmlentities($data[0]['nit']); ?>" required class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Correo Electrónico de la Empresa:</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-list"></i></span>
                                </div>
                                <input type="email" name="email" class="form-control" value="<?php echo htmlentities($data[0]['email']); ?>" id="email" placeholder="Correo de la Empresa" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Dirección / Ubicación de la empresa :</label>
                            <textarea class="form-control" required="" name="direccion" id="direccion" rows="4"><?php echo htmlentities($data[0]['address']); ?></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer clearfix">
                <button type="submit" class="btn btn-outline-success float-right"><span class="fas fa-save"></span> Actualizar Datos</button>
            </div>
        </form>
    </div>
</div>

<?php include_once "includes/footer.php"; ?>