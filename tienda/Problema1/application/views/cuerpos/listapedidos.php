
<div class="container">
	<div class="col-lg-8">
	<table class="table">
		<tr>
			<td>
				<h4>Codigo pedido</h4>
			</td>
			<td>
				<h4>Fecha/hora pedido</h4>
			</td>
			<td>
				<h4>Fecha/hora entrega</h4>
			</td>
			<td>
				<h4>Estado</h4>
			</td>
		<?php
		foreach ($pedidos as $pedido):?>
			
				<tr>
					<td>
        				<h6><?=$pedido->codPedido?></h6>
        			</td>
        			<td>
        				<h6><?=$pedido->fechaPedido?></h6>
        			</td>
        			<td>
        				<h6><?=$pedido->fechaEntrega?></h6>
        			</td>
        			<td>
        				<h6><?=$pedido->estado?></h6>
        			</td>
        			<?php if($pedido->estado=='p'):?>
        			<td>
        				<a href="<?=base_url("/index.php/login/CancelarPedido/$pedido->id")?>">Cancelar pedido</a>
        			</td>
        			<td>
        				<a href="<?=base_url("/index.php/login/VerLineaPedido/$pedido->id")?>">Ver detalles</a>
        			</td>
        			<?php endif;?>
        		</tr>	
	<?php endforeach;?>
	
	</table>
	<h6>a:Anulado p:pendiente e:enviado r:recibido</h6>
	</div>
</div>