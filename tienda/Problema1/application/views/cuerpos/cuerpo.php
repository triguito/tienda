<div class="container">
	<div class="row">
    	<?php 
		foreach ($productos as $producto):?>
	        <div class="col-lg-4">
	        	<h3><?=$producto->nombre?></h3>
	        	<?php echo validation_errors(); ?>

				<?php echo form_open('home'); ?>
		        	<p><img src="<?=base_url("/img/".$producto->Imagen)?>" class="img-responsive"></p>
		        	<h3 class="pull-right"><?=$producto->PrecioVenta." €"?></h3>
		        	<input type="number" name="cantidad" min="1" max="<?=$producto->cantidad ?>" value="1">
		        	<!--  <a href="<?=site_url("home/AddACarrito/".$producto->id)?>"><button>Añadir al carrito</button></a>-->
		        	<input type="hidden" name="id" value="<?=$producto->id ?>">
		        	<input type="submit" value="Añadir al carrito" />
		        	
	        	</form>
	    	</div>
	  	 <?php endforeach;?>
	   </div>
	   	<div class="row">
	  	 <?php echo $paginador?>
	   </div>
</div>
