<div class="side-menu animate-dropdown outer-bottom-xs" >
    <div class="head" style="background-color: #262626;"><i class="icon fa fa-align-justify fa-fw"></i> Categorias</div>        
    <nav class="yamm megamenu-horizontal" role="navigation">
  
        <ul class="nav">
            <li class="dropdown menu-item">
              <?php $sql=mysqli_query($con,"SELECT id,categoryName  from category where status = 1");
while($row=mysqli_fetch_array($sql))
{
    ?>
                <a href="category.php?cid=<?php echo $row['id'];?>" class="dropdown-toggle"><i class="icon fa fa-desktop fa-fw"></i>
                <?php echo $row['categoryName'];?></a>
                <?php }?>
                        
</li>
</ul>
    </nav>
</div>