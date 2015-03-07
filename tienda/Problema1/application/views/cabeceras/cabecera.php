<div class="navbar-header">
	<div class="col-lg-4">
	   <a href="../" class="navbar-brand">Tienda</a>
	</div>
	<div class="col-lg-8">
        <div class="navbar-collapse collapse" id="navbar-main">  
          <ul  class="nav navbar-nav navbar-right">
            <li><a href="<?=base_url("/index.php/home/VerCarrito/")?>"> <img src="<?=base_url("/img/cart.png")?>" class="responsive" alt="Cinque Terre" width="30" height="30"></a></li>
            <?php if($this->session->userdata('logueado')==false)
            {?>
            <li><a href="<?=base_url("/index.php/login/index/")?>"><span class="glyphicon glyphicon-log-in"></a></li>
            <?php 
            }
            else 
            {
            ?>
            <li><a href="<?=base_url("/index.php/login/Salir/")?>"><span class="glyphicon glyphicon-log-out" ></a></li>
            <li><a href="<?=base_url("/index.php/login/Perfil")?>"><span class="glyphicon glyphicon-user" ></a></li>
            <?php }?>
	          </ul>
 	</div>

	

</div>