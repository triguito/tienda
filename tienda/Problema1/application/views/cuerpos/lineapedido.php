<div class="container">
	<div class="col-lg-8">
	<table class="table">
		<tr>
			<td>
				<h4>Nombre Producto</h4>
			</td>
			<td>
				<h4>Cantidad</h4>
			</td>
			<td>
				<h4>Precio</h4>
			</td>
		<?php
		$cont=0;
		$total=0;
		
		foreach ($LineaPedidos as $Linea):?>
			
				<tr>
					<td>
        				<h6><?=$productos[0]->nombre?></h6>
        			</td>
        			<td>
        				<h6><?=$Linea->cantidad?></h6>
        			</td>
        			<td>
        				<h6><?=$Linea->PrecioVenta?></h6>
        			</td>
        		</tr>
        		<?php $cont++;
        				$total+=$Linea->PrecioVenta?>	
	<?php endforeach;?>
	<tr>
		<td>
			Total
		</td>
		<td>
			<?=$total?>
		</td>
		<td>
		<a href="<?=base_url("/index.php/login/Listapedidos/")?>">Atras</a>
		</td>
	
	
	</table>

	</div>
</div>
