<?php 
include "../conexion.php";
date_default_timezone_set('America/Bogota'); // change according timezone
$fechaHoraActual = date("Y-m-d H:i:s");

if (!empty($_POST)) {
    $proveedor = $_POST['proveedor'];
    $fechaC = $_POST['fechaC'];
    $nombre = $_POST['nombre'];
    $estado = $_POST['estado'];
    $productimage1 = $_FILES["productimage1"]["name"];
    $alert = "";




    if (empty($proveedor) || empty($fechaC) || empty($nombre) || empty($productimage1)  || !in_array($estado, array("0", "1"))) {

        $alert = '<div class="alert alert-danger" role="alert">
                Todo los campos son obligatorios
              </div>';
    } else {


        move_uploaded_file($_FILES["productimage1"]["tmp_name"], "../../../brandsimage/" . $_FILES["productimage1"]["name"]);
        $query_insert = mysqli_query($conexion, "INSERT INTO brands(name,status,supplier,creationDate,image) values 
        ('$nombre', '$estado','$proveedor','$fechaC','$productimage1')");
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
<?php include_once "includes/header.php";
include_once "includes/slidebar.php";
echo isset($alert) ? $alert : ''; 

?>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid p-0">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h3 class="m-0 text-dark">Marcas</h3>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Registros</a></li>
                    <li class="breadcrumb-item active">Marcas</li>
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
                        <h5 class="card-title">Registrar Marca</h5>
                    </div>
                    <div class="card-body">
                        <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#modal-marca"><i class="fas fa-file-signature"></i> Nuevo Registro</button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<?php echo isset($alert) ? $alert : ''; ?>
<br>
<div class="table-responsive">
    <table class="table table-striped table-bordered" id="tbl">
        <thead class="thead-dark">
            <tr>
                <th>Id</th>
                <th>Nombre </th>
                <th>Proveedor</th>
                <th>Fecha de creación</th>
                <th>Imagen</th>
                <th>Estado</th>
                <th>Accion</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include "../conexion.php";

            $query = mysqli_query($conexion, "SELECT b.*, s.company_name as companyName FROM brands b INNER JOIN suppliers s on b.supplier = s.id ");
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
                        <td><?php echo $data['name']; ?></td>
                        <td><?php echo $data['companyName']; ?></td>
                        <td><?php echo $data['creationDate']; ?></td>
                        <td><?php echo $data['image']; ?></td>
                        <td><?php echo $estado ?></td>
                        <td>
                            <?php if ($data['status'] == "1") { ?>

                                <a href="editar_marca.php?id=<?php echo $data['id']; ?>" class="btn btn-success"><i class='fas fa-edit'></i></a>
                                <form action="eliminar_marca.php?id=<?php echo $data['id']; ?>" method="post" class="confirmar d-inline">
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


<div class="modal fade" id="modal-marca">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 id="titulo" class="modal-title">Formulario De Registro Nueva Marca</h4>
                <button onclick="cancelarPeticion();" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form" method="post" autocomplete="off" id="frmSubCategorias" enctype="multipart/form-data">
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
                                        <option value="">Seleccione Proveedor</option>
                                        <?php $query = mysqli_query($conexion, "select * from suppliers");
                                        while ($row = mysqli_fetch_array($query)) { ?>
                                            <option value="<?php echo $row['id']; ?>"><?php echo $row['company_name']; ?></option>
                                        <?php } ?>
                                    </select>
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

                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                            <div class="form-group">
                                <label style="font-family: sans-serif">Nombre de la Marca</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-list-ul"></i></span>
                                    </div>
                                    <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Ingresar Nombre de la Marca" required>
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
                                    <select class="form-control" name="estado" id="estado" required>
                                        <option value="1">ACTIVO</option>
                                        <option value="0">INACTIVO</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <hr style="width: 100%; margin-top: 5px; margin-bottom: 5px;">
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 ">
                            <div class="control-group">
                                <label class="control-label" for="basicinput">Imagen 1 del Producto</label>
                                <div class="controls">
                                    <input type="file" name="productimage1" id="productimage1" value="" class="span8 tip" required>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="modal-footer clearfix">
                    <button type="submit" class="btn btn-outline-success float-right"><span class="fas fa-save"></span> Registrar Marca</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<?php include_once "includes/footer.php"; ?>