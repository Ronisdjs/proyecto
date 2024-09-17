<?php

require("../conexion.php");

if (!empty($_GET['id'])) {
    $id = $_GET['id'];
    $query_delete = mysqli_query($conexion, "UPDATE products SET status = 0 WHERE id = $id");
    mysqli_close($conexion);
    header("Location: productos.php");
}
