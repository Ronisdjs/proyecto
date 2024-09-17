<?php
session_start();
require("../conexion.php");
$id_user = $_SESSION['idUser'];
$permiso = "usuarios";
if (empty($existe) && $id_user != 1) {
    header("Location: permisos.php");
}
if (!empty($_GET['id'])) {
    $id = $_GET['id'];
    $query_delete = mysqli_query($conexion, "UPDATE subcategory SET status = 0 WHERE id = $id");
    mysqli_close($conexion);
    header("Location: subCategorias.php");
}