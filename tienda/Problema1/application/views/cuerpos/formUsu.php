
<h2>Registro de usuario</h2>
<div class="col-xs-5">

	<?php echo form_open('login/formNuevo_usuario'); ?>
	
		<div class="form-group">
			<label>Nombre Usuario</label>
			<input type="text" name="usuario" value="<?=set_value('usuario')?>" class="form-control"> <?=form_error('usuario')?><?=form_error('usuario_ok')?>
		</div>
		<div class="form-group">
			<label>Contraseña</label>
			<input type="password" name="pass" class="form-control"><?=form_error('pass')?>
		</div>
		<div class="form-group">
			<label>Repita Contraseña</label>
			<input type="password" name="pass2" class="form-control"><?=form_error('passs')?>
		</div>
		<div class="form-group">
			<label>Email</label>
			<input type="email" name="email" value="<?=set_value('email')?>" class="form-control"><?=form_error('email')?><?=form_error('validarDNI')?>
		</div>
		<div class="form-group">
			<label>Nombre</label>
			<input type="text" name="nombre" value="<?=set_value('nombre')?>" class="form-control"><?=form_error('nombre')?>
		</div>
		<div class="form-group">
			<label>Apellidos</label>
			<input type="text" name="apellidos" value="<?=set_value('apellidos')?>" class="form-control"><?=form_error('apellidos')?>
		</div>
		<div class="form-group">
			<label>Dni</label>
			<input type="text" name="dni" value="<?=set_value('dni')?>" class="form-control"><?=form_error('dni')?>
		</div>
		<div class="form-group">
			<label>Direccion</label>
			<input type="text" name="direccion" value="<?=set_value('direccion')?>" class="form-control"><?=form_error('direccion')?>
		</div>
		<div class="form-group">
			<label>Codigo Postal</label>
			<input type="text" name="cp" value="<?=set_value('cp')?>" class="form-control"><?=form_error('cp')?>
		</div>
		
		<div class="form-group">
								<label>Provincia</label><?=form_error('provincia')?>
							 	<select name="provincia" class="form-control" >
							 	<option value="<?=set_value('provincia')?>" selected></option>
											<?php
											foreach ($provincias as $provincia) :?>
											
											<option value=<?=$provincia->cod;?>><?=$provincia->nombre;?></option>
											<?php endforeach;?>
								</select>
		</div>
		<input type="submit" class="btn btn-default" value="enviar">
		<a href="<?=base_url("/index.php/login/")?>">Atras</a>
		</form>
</div>



