
	<div class="col-lg-6">
	   <div class="navbar-brand navbar-right">Tienda</div>
	</div>
	<div class="col-lg-6" > 
          <ul  class="nav navbar-nav navbar-right">
            <li><a href="<?=base_url("/index.php/home/VerCarrito/")?>"> <img src="<?=base_url("/img/cart.png")?>" class="responsive" alt="Cinque Terre" width="30" height="30"></a></li>
            <?php if($this->session->userdata('logueado')==false)
            {?>
            <li><a href="<?=site_url("login/index/")?>"><span class="glyphicon glyphicon-log-in"></a></li>
            <?php 
            }
            else 
            {
            ?>
            <li><a href="<?=site_url("login/Salir/")?>"><span class="glyphicon glyphicon-log-out" ></a></li>
            <li><a href="<?=site_url("login/Perfil")?>"><span class="glyphicon glyphicon-user" ></a></li>
            <?php }?>
		</ul>
 	</div>