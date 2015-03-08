<!--  <pre><?php /*print_r($_POST); */
 
?></pre>-->
<h2 class="list-group-item-info">Acceder</h2>
<div class="col-xs-5">
	<?php echo form_open('login/Entrar'); ?>
	<div class="form-group">
		<label>Nombre Usuario</label>
		<input type="text" name="user" value="<?=set_value('user')?>" class="form-control"><?=form_error('user')?> 
	</div>
	
	<div class="form-group">
		<label>Contraseña</label>
		<input type="password" name="password" class="form-control"> <?=form_error('password')?><?=form_error('CompruebaLogin')?>
	</div>
	
	<input type="submit" class="btn btn-default" value="Entrar">
	<a href="<?=base_url("/index.php/login/restaurapass/")?>">¿Ha olvidado la contraseña?</a>
	</form>
</div>
<div class="col-xs-6">
	
	<a href="<?=base_url("/index.php/login/formNuevo_usuario/")?>">Registrate</a>
</div>


