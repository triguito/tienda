
<h2>Registro de usuario</h2>
<div class="col-xs-5">

	<?php echo form_open('login/Modificar'); ?>
			<?php 
			foreach ($usuarios as $usuario):?>
		<div class="form-group">
			<label>Nombre Usuario</label>
			<input type="text" name="usuario" value="<?=$usuario->nombreUsu?>" class="form-control"> <?=form_error('usuario')?><?=form_error('usuario_ok')?>
		</div>
		<div class="form-group">
			<label>Email</label>
			<input type="email" name="email" value="<?=$usuario->email?>" class="form-control"><?=form_error('email')?><?=form_error('validarDNI')?>
		</div>
		<div class="form-group">
			<label>Nombre</label>
			<input type="text" name="nombre" value="<?=$usuario->nombre?>" class="form-control"><?=form_error('nombre')?>
		</div>
		<div class="form-group">
			<label>Apellidos</label>
			<input type="text" name="apellidos" value="<?=$usuario->apellido?>" class="form-control"><?=form_error('apellidos')?>
		</div>
		<div class="form-group">
			<label>Dni</label>
			<input type="text" name="dni" value="<?=$usuario->dni?>" class="form-control"><?=form_error('dni')?>
		</div>
		<div class="form-group">
			<label>Direccion</label>
			<input type="text" name="direccion" value="<?=$usuario->direccion?>" class="form-control"><?=form_error('direccion')?>
		</div>
		<div class="form-group">
			<label>Codigo Postal</label>
			<input type="text" name="cp" value="<?=$usuario->cp?>" class="form-control"><?=form_error('cp')?>
		</div>
		
		<div class="form-group">
								<label>Provincia</label><?=form_error('provincia')?>
							 	<select name="provincia" class="form-control" >
							 	<?php foreach ($provinciasUsus as $provinciaUsu)?>
							 	<option value="<?=$usuario->provincia_cod?>" selected><?=$provinciaUsu->nombre?></option>
											<?php
											foreach ($provincias as $provincia) :?>
											
											<option value=<?=$provincia->cod;?>><?=$provincia->nombre;?></option>
											<?php endforeach;?>
								</select>
		</div>
		<?php endforeach;?>
		<input type="submit" class="btn btn-default" value="Modificar">
		<a href="<?=base_url("/index.php/login/Perfil")?>">Atras</a>
		
		</form>
</div>




