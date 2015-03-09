<div class="list-group">
  <a href="#" class="list-group-item disabled"> Menu </a>
    <?php 
    	foreach ($categorias as $categoria)
    	{
    		echo '<a href='.site_url("home/categoria/".$categoria->id).' class="list-group-item list-group-item-success">'.$categoria->nombre.'</a>';
    	}
    ?>
</div>
