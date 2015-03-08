

<div class="container">
	<table  class="col-lg-6"  border="1">
		<tr>
			<td><h3>Producto</h3></td>
			<td><h3>Precio</h3></td>
			<td><h3>Cantidad</h3></td>
			<td><h3>Total</h3></td>
		</tr>
		<?php $total=0; ?>
	<?php
	 foreach ($carrito as $producto):?>
        
    	<tr>
    		<td><?=$producto['name']?></td>
    		<td><?=$producto['price']?>€</td>
    		<td><?=$producto['qty']?></td>
    		<td><?=$producto['subtotal']?>€</td>
    		<td><a href="<?=base_url("/index.php/home/EliminaProducto/".$producto['rowid'])?>">Eliminar</a></td>
        	
        	
        	<?php $total+=$producto['subtotal']?>
	  	 <?php endforeach;?>
	  	 <tr>
	  	 <td colspan="3" align="center">Total Compra</td>
	  	 <td><?=$total?>€</td>
	  	 </tr>
	</table>
</div>
<div>
	<div class="col-lg-6">
  		 <a href="<?=base_url("/index.php/home/EmilinarCompra/")?>">Eliminar Compra </a>
  	</div>
  	
  	<div class="col-lg-6">
  		Es necesario estar registrado para completar la compra
  		 <a href="<?=base_url("/index.php/login/index/")?>">Acceder </a>
  	</div>
</div>


  	
		  	
