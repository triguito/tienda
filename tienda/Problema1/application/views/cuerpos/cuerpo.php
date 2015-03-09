<div class="container">
	<div class="row">
    	<?php 
		foreach ($productos as $producto):?>
	    <div class="col-lg-4">
	        	<h3><?=$producto->nombre?></h3>

	        	<?php echo validation_errors(); ?>

				<?php echo form_open('home'); ?>

		        	<p><img src="<?=base_url("/img/".$producto->Imagen)?>" height="250px" width="250"></p>
		        	<h4><?=$producto->PrecioVenta." €"?></h4>
		        	<input type="number" name="cantidad" min="1" max="<?=$producto->cantidad ?>" value="1">
		        	<input type="hidden" name="id" value="<?=$producto->id ?>">
		        	<input type="submit" value="Añadir al carrito" />
	</div>
	        	</form>
	    	
	  	 <?php endforeach;?>
	</div>
</div>
   	<div class="row">
  	 <?php echo $paginador?>
   </div>
</div>
