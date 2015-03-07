
<h2>Registro de usuario</h2>
<div class="col-xs-5">

	<?php echo form_open('login/CambiarPass'); ?>
		<div class="form-group">
			<label>Contraseña Antigua</label>
			<input type="password" name="pass" class="form-control"><?=form_error('pass')?><?=form_error('CompruebaPass')?>
		</div>
		<div class="form-group">
			<label>Contraseña</label>
			<input type="password" name="pass1" class="form-control"><?=form_error('pass1')?>
		</div>
		<div class="form-group">
			<label>Repita Contraseña</label>
			<input type="password" name="pass2" class="form-control"><?=form_error('passs1')?>
		</div>
		
		<input type="submit" class="btn btn-default" value="enviar">
		<a href="<?=base_url("/index.php/login/")?>">Atras</a>
		</form>
</div>




