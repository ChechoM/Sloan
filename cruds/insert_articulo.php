<?php
	include_once "../conexion.php";
	if (isset($_POST['btn_guardar'])){

		//no se coloca el campo primario
		$categoria=$_POST['categoria'];
		$nombre_articulo=$_POST['nombre_articulo'];
		$descripcion=$_POST['descripcion'];
		$codigo_barras=$_POST['codigo_barras'];
		$disponibilidad=$_POST['disponibilidad'];
		$estado=$_POST['estado'];

		if (!empty ($categoria) && !empty ($nombre_articulo) && !empty($descripcion) && !empty($codigo_barras) && !empty($disponibilidad) && !empty($estado)){
			$insert_articulo= $con-> prepare ('INSERT INTO articulos(categoria,nombre_articulo,descripcion,codigo_barras,disponibilidad,estado) VALUES (:categoria,:nombre_articulo,:descripcion,:codigo_barras,:disponibilidad,:estado)');
			$insert_articulo-> execute(array(			
			':categoria'=>$categoria,
			':nombre_articulo'=>$nombre_articulo,
			':descripcion'=>$descripcion,
			':codigo_barras'=>$codigo_barras,
			':disponibilidad'=>$disponibilidad,
			':estado'=>$estado
		));
		header('location: inventario.php');
		}
		else {
			echo ("los campos estan vacios");
		}
	}
?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

        <!-- Google Fonts -->
		<link rel="preconnect" href="https://fonts.gstatic.com">
		<link href="https://fonts.googleapis.com/css2?family=Lato&family=Yusei+Magic&display=swap" rel="stylesheet">

        <!-- ICONO Font Awesome -->
        <script src="https://kit.fontawesome.com/9f429f9981.js" crossorigin="anonymous"></script>

		<!-- Bootstrap CSS -->
        <link rel="stylesheet" href="../sass/custom.css">
        
		<title>Préstamos Sloan</title>
		<link rel="shortcut icon" href="../img/Logo.png">
	</head>
	<body style="font-family: 'Lato', sans-serif;">
		<!-- Contenedor #1 -->
		<div class="container-fluid">
            
            <!-- NAVBAR -->
            <div class="row bg-warning">
                <div class="col-12">
                    <nav class="navbar navbar-dark align-items-center">
                        <a class="navbar-brand" href="../home1.php">
                            <span><i class="fas fa-home fa-2x"></i></span>
                            <h2 class="text-white h2 text-center d-inline">Administrador</h2>
                        </a>
                        <button class="navbar-toggler border-white" 
                            type="button" 
                            data-toggle="collapse" 
                            data-target="#navbarSupportedContent" 
                            aria-controls="navbarSupportedContent"
                            aria-expanded="false"
                            aria-label="Toggle navigation"
                            title="Menu">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse text-center" id="navbarSupportedContent">
                            <ul class="navbar-nav">
                                <li><div class="dropdown-divider"></div></li>
                                <li class="nav-item"><a class="nav-link text-white h6" href="devoluciones.php">Devoluciones</a></li>
                                <li class="nav-item"><a class="nav-link text-white h6" href="prestamo.php">Préstamos</a></li>
                                <li class="nav-item"><a class="nav-link text-white h6" href="inciencia.php">Incidencias</a></li>
                                <li class="nav-item"><a class="nav-link text-success h6 disabled" href="inventario.php">Inventario</a></li>
                                <li class="nav-item"><a class="nav-link text-white h6" href="usuarios.php">Usuarios</a></li>
                                <li><div class="dropdown-divider"></div></li>
                                <li class="nav-item"><a class="nav-link text-white h6" href="../index.php">Salir</a></li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>   

        <!-- Contenedor #2 -->
		<div class="container mt-5">
			<div class="row text-center pt-5">
				<h2 class="display-4 text-success" style="font-family: 'Yusei Magic', sans-serif;">Agregar Artículo</h2>
			</div>
			<div class="row pt-3">
				<div class="col-2"></div>
				<div class="col-8">
					<div class="card border-light">
						<div class="card-header text-center"></div>
						<div class="card-body">
							<form class="row g-3" action="" method="POST">
								<div class="col-md-4">
									<label for="inputState" class="form-label h5 p-2">Categoria:</label>
									<select id="inputState" class="form-select h6" name="categoria">
										<option  value="0" selected class="h6">Seleccione categoria del artículo</option>
										<?php 
											$query = $con -> prepare("SELECT * FROM categorias");
											$query -> execute();
											foreach ($query as $key ) {
												echo '<option value ="'.$key[id_categoria].'">'.$key[nombre_categoria].'</option>';					 	
											} 
										?>
									</select>
								</div>
								<div class="col-md-4">
									<label for="inputState" class="form-label h5 p-2">Artículo:</label>
									<input class="form-control" type="text" name="nombre_articulo" placeholder="Ingrese el nombre del artículo" onkeypress="return soloLetras(event)" required>
								</div>
								<div class="col-md-4">
									<label for="inputState" class="form-label h5 p-2">Descripción:</label>
									<input class="form-control" type="text" name="descripcion" placeholder="Ingrese la marca o descripción del articulo" required>
								</div>
								<div class="col-md-4">
									<label for="inputState" class="form-label h5 p-2">Codigo de barras:</label>
									<input class="form-control" type="number" name="codigo_barras" placeholder="Codigo de barras" onkeypress="return validarNumero(event)" required>
								</div>	

								<div class="col-md-4">
									<label for="inputState" class="form-label h5 p-2">Disponibilidad:</label>
									<select id="inputState" class="form-select h6" name="disponibilidad">
										<option  value="0" selected class="h6">Seleccione disponibilidad del artículo</option>
										<?php 
											$query = $con -> prepare("SELECT * FROM disponibles");
											$query -> execute();
											foreach ($query as $key ) {
												echo '<option value ="'.$key[id_disponible].'">'.$key[nombre_disponible].'</option>';					 	
											} 
										?>
									</select>
									
								</div>
								<div class="col-md-4">
									<label for="inputState" class="form-label h5 p-2">Estado:</label>
									<select id="inputState" class="form-select h6" name="estado">
										<option  value="0" selected class="h6">Seleccione estado del artículo</option>
										<?php 
											$query = $con -> prepare("SELECT * FROM estados");
											$query -> execute();
											foreach ($query as $key ) {
												echo '<option value ="'.$key[id_estado].'">'.$key[nombre_estado].'</option>';					 	
											} 
										?>
									</select>
								</div>	


								<div class="col-12 text-center">
									<input type="submit" name="btn_guardar" value="Guardar" class="btn btn-success text-white btn-lg mb-3 mt-2">
								</div>
							</form>	
						</div>
						<div class="card-footer text-muted text-center pt-3">
							<div class="row align-items-center">
								<div class="col-6">
									<a href="inventario.php" class="rounded-circle p-2 bg-success border border-3 border-white text-decoration-none mt-2">
										<i class="fas fa-chevron-left fa-lg text-white" title="Atras"></i>
									</a>							
								</div>
								<div class="col-6">
									<a href="insert_articulo.php" name="btn_cancelar" class="btn btn-outline-success has-danger d-inline">Limpiar</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-2"></div>
			</div>
		</div>

		<!-- Scripts de Bootstrap -->
		<script type="text/javascript" src="../js/jquery-3.5.1.slim.min.js"></script>
		<script type="text/javascript" src="../js/popper.min.js"></script>
		<script type="text/javascript" src="../js/bootstrap.min.js"></script>
	</body>
</html>