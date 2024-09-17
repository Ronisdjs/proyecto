<?php
include('../conexion.php');
if(!empty($_POST["cat_id"])) 
{
 $id=intval($_POST['cat_id']);
$query=mysqli_query($conexion,"SELECT * FROM subcategory WHERE categoryid=$id");
?>
<option value="">Selecione Subcategoria</option>
<?php
 while($row=mysqli_fetch_array($query))
 {
  ?>
  <option value="<?php echo htmlentities($row['id']); ?>"><?php echo htmlentities($row['subcategory']); ?></option>
  <?php
 }
}
?>