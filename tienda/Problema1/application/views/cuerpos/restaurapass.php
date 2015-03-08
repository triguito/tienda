<h2>Restaura Contraseña</h2>
<div class="col-xs-5">

	<?php echo form_open('login/RestauraPass'); ?>
		<div class="form-group">
			<label>Email</label>
			<input type="text" name="email" class="form-control"><?=form_error('email')?><?=form_error('CompruebaMail')?>
		</div>
		
		<input type="submit" class="btn btn-default" value="enviar">
		<a href="<?=base_url("/index.php/login/")?>">Atras</a>
		</form>
</div>
