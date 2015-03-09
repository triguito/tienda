<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Mostrar</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
    <link type="tex/css" rel="stylesheet" href="css/envios.css">
</head>
<body>
<div id="cabecera" class="navbar navbar-default">
      <div class="container">
		<div class="col-xs-12">
			<?=$cabecera?>
		</div>
	</div>
</div>
<div class="container">
	<div id="menu">
		<div class="col-xs-2" align="center">
			<?=$menu?>
		</div>
	</div>

	<div id="cuerpo">
		<div class="col-xs-9">
			<?=$cuerpo?>
		</div>
	</div>
</div>
<div class="container">	
	<div id="pie">
		<div class="row">
			<div class="col-xs-12" align="center">
				<?=$pie?>
			</div>
		</div>
	</div>
</div>

</body>
</html>