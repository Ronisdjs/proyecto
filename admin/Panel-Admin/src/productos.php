<?php include_once "includes/header.php";
include_once "includes/slidebar.php";
include "../conexion.php";
date_default_timezone_set('America/Bogota'); // change according timezone
$fechaHoraActual = date("Y-m-d H:i:s");

if (!empty($_POST)) {
    $nombre = $_POST['nombre'];
    $categoria = $_POST['categoria'];
    $subcategoria = $_POST['subcategoria'];
    $precio = $_POST['precio'];
    $descuento = $_POST['descuento'];
    $descripcion = $_POST['descripcion'];
    $cantidad = $_POST['cantidad'];
    $marca = $_POST['marca'];
    $fechaC = $_POST['fechaC'];
    $fechaA = $_POST['fechaC'];
    $estado = $_POST['estado'];
    $productimage1 = $_FILES["txtFoto1"]["name"];
    $productimage2 = $_FILES["txtFoto2"]["name"];
    $productimage3 = $_FILES["txtFoto3"]["name"];
    $alert = "";
    if (
        empty($nombre) || empty($categoria) || empty($subcategoria) || $precio <  0 || $descuento <  0   || empty($descripcion) ||  $cantidad <  0
        || empty($marca) || empty($fechaC) || empty($fechaA)   || !in_array($estado, array("0", "1"))
    ) {
        $alert = '<div class="alert alert-danger" role="alert">
                Todo los campos son obligatorios
              </div>';
    } else {

        //for getting product id
        $query = mysqli_query($conexion, "select max(id) as pid from products");
        $result = mysqli_fetch_array($query);
        $productid = $result['pid'] + 1;
        $dir = "../../productimages/$productid";
        if (!is_dir($dir)) {
            mkdir("../../productimages/" . $productid);
        }

        move_uploaded_file($_FILES["txtFoto1"]["tmp_name"], "../../productimages/$productid/" . $_FILES["txtFoto1"]["name"]);
        move_uploaded_file($_FILES["txtFoto2"]["tmp_name"], "../../productimages/$productid/" . $_FILES["txtFoto2"]["name"]);
        move_uploaded_file($_FILES["txtFoto3"]["tmp_name"], "../../productimages/$productid/" . $_FILES["txtFoto3"]["name"]);

        if ($cantidad ==  0) {
            $stock = "Out of Stock";
        } else {
            $stock = "In Stock";
        }

        $query_insert = mysqli_query($conexion, "  INSERT INTO products (category, subCategory, productName, productCompany, productPrice, discount, productDescription, productImage1, productImage2, productImage3, stock, creationDate, status, brand, updateproduct,quantity) 
            VALUES('$categoria', '$subcategoria', '$nombre', '$marca', '$precio', '$descuento', '$descripcion', '$productimage1', '$productimage2', '$productimage3', '$stock', '$fechaC', '$estado', '$marca', '$fechaA','$cantidad');");
        if ($query_insert) {
            $alert = '<div class="alert alert-success" role="alert">
                Producto Registrado
              </div>';
        } else {
            $alert = '<div class="alert alert-danger" role="alert">
                Error al registrar el producto
              </div>';
        }
    }
}
?>

<script>
    function getSubcat(val) {
        $.ajax({
            type: "POST",
            url: "get_subcat.php",
            data: 'cat_id=' + val,
            success: function(data) {
                $("#subcategoria").html(data);
            }
        });
    }

    function detectarImagen(input) {
        if (input.files.length > 0) {
            const fileName = input.files[0].name;
            const inputId = input.id;

            switch (inputId) {
                case 'txtFoto1':
                    $("#no-image-selected-1").html(`${fileName}`);
                    break;
                case 'txtFoto2':
                    $("#no-image-selected-2").html(` ${fileName}`);
                    break;
                case 'txtFoto3':
                    $("#no-image-selected-3").html(` ${fileName}`);
                    break;
                default:
                    <?php $alertP = '<div class="alert alert-danger" role="alert">
                No se ha subido ninguna imagen
              </div>'; ?>
            }
        } else {
            <?php $alertP = '<div class="alert alert-danger" role="alert">
                No se ha subido ninguna imagen
              </div>'; ?>
        }
    }

    function selectCountry(val) {
        $("#search-box").val(val);
        $("#suggesstion-box").hide();
    }
</script>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid p-0">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h3 class="m-0 text-dark">Productos</h3>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Registros</a></li>
                        <li class="breadcrumb-item active">Productos</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid  p-0">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="card card-purple card-outline">
                        <div class="card-header">
                            <h5 class="card-title">Registrar Producto</h5>
                        </div>
                        <div class="card-body">
                            <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#modal-nuevo-producto"><i class="fas fa-file-signature"></i> Nuevo Registro</button>
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
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Imagen</th>
                    <th>Categoria</th>
                    <th>Sub Categoria</th>
                    <th>Marca</th>
                    <th>Precio</th>
                    <th>Descuento</th>
                    <th>Stock</th>
                    <th>Cantidad</th>
                    <th>Fecha Creacion</th>
                    <th>Fecha Actualizacion</th>
                    <th>Estado</th>
                    <th>Accion</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include "../conexion.php";

                $query = mysqli_query($conexion, "SELECT p.*, c.categoryName as categoryName, s.subcategory as subCategoryName , b.name  as brandName 
FROM products p
inner join category c on c.id = p.category 
inner join subcategory s on s.categoryid = c.id
inner join brands b on b.id = p.brand
GROUP BY p.id");
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
                            <td><?php echo $data['productName']; ?></td>
                            <td><?php echo $data['productDescription']; ?></td>
                            <td> <img src="../../productimages/<?php echo $data['id']; ?>/<?php echo $data['productImage1']; ?>" alt="<?php echo $data['productName']; ?>" style="width: 100%; height: 90%;"></td>
                            <td><?php echo $data['categoryName']; ?></td>
                            <td><?php echo $data['subCategoryName']; ?></td>
                            <td><?php echo $data['brandName']; ?></td>
                            <td><?php echo $data['productPrice']; ?></td>
                            <td><?php echo $data['discount']; ?></td>
                            <td><?php echo $data['stock']; ?></td>
                            <td><?php echo $data['quantity']; ?></td>
                            <td><?php echo $data['creationDate']; ?></td>
                            <td><?php echo $data['updateproduct']; ?></td>
                            <td><?php echo $estado ?></td>
                            <td>
                                <?php if ($data['status'] == "1") { ?>
                                    <a href="editar_producto.php?id=<?php echo $data['id']; ?>" class="btn btn-success"><i class='fas fa-edit'></i></a>
                                    <br>
                                    <form action="eliminar_producto.php?id=<?php echo $data['id']; ?>" method="post" class="confirmar d-inline">
                                        <br>
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

    <div class="modal fade" id="modal-nuevo-producto">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 id="titulo" class="modal-title">Formulario De Registro Nuevo Producto</h4>
                    <button onclick="limpiarFormulario()" type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" autocomplete="off" class="form" id="frmProductos" enctype="multipart/form-data">
                    <?php echo isset($alert) ? $alert : ''; ?>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label style="font-family: sans-serif">Nombre del producto</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-file-signature"></i></span>
                                        </div>
                                        <input type="text" required="" name="nombre" id="nombre" class="form-control" placeholder="Ingresar Nombre Producto">
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
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
                                <div class="form-group">
                                    <label for="categoria">Categoria</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-list"></i></span>
                                        </div>
                                        <select class="form-control" id="categoria" name="categoria" onChange="getSubcat(this.value);" required>
                                            <option value="">Seleccione Categoria</option>
                                            <?php $query = mysqli_query($conexion, "select * from category where status = '1'");
                                            while ($row = mysqli_fetch_array($query)) { ?>
                                                <option value="<?php echo $row['id']; ?>"><?php echo $row['categoryName']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
                                <div class="form-group">
                                    <label for="subcategoria">Sub Categoria</label>
                                    <div class="controls">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-list-ul"></i></span>
                                            </div>
                                            <select class="form-control" name="subcategoria" id="subcategoria" class="span8 tip" required>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
                                <div class="form-group">
                                    <label class="control-label" for="marca">Marca</label>
                                    <div class="controls">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-copyright"></i></span>
                                            </div>
                                            <select class="form-control" id="marca" name="marca" class="span8 tip">
                                                <option value="">Seleccione Marca</option>
                                                <?php $query = mysqli_query($conexion, "select * from brands where status = 1");
                                                while ($row = mysqli_fetch_array($query)) { ?>

                                                    <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr style="width: 100%; margin-top: 5px; margin-bottom: 5px;">
                            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3">
                                <div class="form-group">
                                    <label style="font-family: sans-serif">Precio</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                        </div>
                                        <input type="text" required="" name="precio" id="precio" class="form-control" placeholder="Ingresar Precio">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3">
                                <div class="form-group">
                                    <label style="font-family: sans-serif">Descuento</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-tag"></i></span>
                                        </div>
                                        <input type="text" required="" name="descuento" id="descuento" class="form-control" placeholder="Ingresar Descuento">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3">
                                <div class="form-group">
                                    <label style="font-family: sans-serif">Cantidad / Stock</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-box-open"></i></span>
                                        </div>
                                        <input type="text" required="" name="cantidad" id="cantidad" class="form-control" placeholder="Ingresar Stock">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3">
                                <div class="form-group">
                                    <label style="font-family: sans-serif">Estado</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-check-circle"></i></span>
                                        </div>
                                        <select class="form-control" name="estado" id="estado">
                                            <option value="1">ACTIVO</option>
                                            <option value="0">INACTIVO</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <hr style="width: 100%; margin-top: 5px; margin-bottom: 5px;">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label style="font-family: sans-serif">Descripción del Producto</label>
                                    <textarea class="form-control" required="" name="descripcion" id="descripcion" rows="3" placeholder="Ingresar Descripción del Producto"></textarea>
                                </div>
                            </div>
                            <hr style="width: 100%; margin-top: 5px; margin-bottom: 5px;">
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 ">
                                <div class="form-group">
                                    <label style="font-family: sans-serif" for="txtFoto1">Subir Imagen 1</label>

                                    <div class="input-group">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-file-image"></i></span>
                                            </div>
                                            <div class="custom-file">
                                                <input required="" type="file" name="txtFoto1" class="custom-file-input" id="txtFoto1" onchange="detectarImagen(this)">
                                                <label class="custom-file-label" for="txtFoto1">Escoger Foto 1</label>
                                            </div>
                                        </div>
                                        <div id="no-image-selected-1" value="">No ha cargado Imagen</div>
                                    </div>
                                </div>
                            </div>


                            <hr style="width: 100%; margin-top: 5px; margin-bottom: 5px;">
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
                                <div class="form-group">
                                    <label style="font-family: sans-serif" for="txtFoto2">Subir Imagen 2</label>
                                    <div class="input-group">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-file-image"></i></span>
                                            </div>
                                            <div class="custom-file">
                                                <input required="" type="file" name="txtFoto2" class="custom-file-input" id="txtFoto2" onchange="detectarImagen(this)">
                                                <label class="custom-file-label" for="txtFoto2">Escoger Foto 2</label>
                                            </div>

                                        </div>
                                        <div id="no-image-selected-2" value=""></div>
                                    </div>
                                </div>
                            </div>

                            <hr style="width: 100%; margin-top: 5px; margin-bottom: 5px;">
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
                                <div class="form-group">
                                    <label style="font-family: sans-serif" for="txtFoto3">Subir Imagen 3</label>
                                    <div class="input-group">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-file-image"></i></span>
                                            </div>
                                            <div class="custom-file">
                                                <input required="" type="file" name="txtFoto3" class="custom-file-input" id="txtFoto3" onchange="detectarImagen(this)">
                                                <label class="custom-file-label" for="txtFoto3">Escoger Foto 3</label>
                                            </div>
                                        </div>
                                        <div id="no-image-selected-3" value=""></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer clearfix">
                        <button type="submit" class="btn btn-outline-success float-right"><span class="fas fa-save"></span> Registrar Producto</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <?php include_once "includes/footer.php"; ?>