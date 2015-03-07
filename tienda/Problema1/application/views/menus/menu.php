<div class="list-group">
  <a href="#" class="list-group-item disabled"> Menu </a>
    <?php 
    	foreach ($categorias as $categoria)
    	{
    		echo '<a href='.base_url("index.php/home/categoria/".$categoria->id).' class="list-group-item list-group-item-success">'.$categoria->nombre.'</a>';
    	}
    ?>
</div>

<div class="list-group">
  <a href="#" class="list-group-item disabled">
    Usuarios
  </a>
  <a href="?accion=Ver_usu" class="list-group-item list-group-item-success">Ver usuarios</a>
  <a href="?accion=Añadir_usu" class="list-group-item list-group-item-info">Añadir usuarios</a>
</div>