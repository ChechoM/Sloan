<?php
	include_once "../conexion.php";
	if (isset($_POST['btn_guardar'])){

		//no se coloca el campo primario
		$id_usuario=$_POST['id_usuario'];
		$id_articulo=$_POST['id_articulo'];

		if (!empty ($id_usuario) && !empty ($id_articulo)){
			
			// traer tabla articulo para comparar
			$sentencia_select = $con->prepare('SELECT * FROM articulos ORDER BY id_articulo ASC');
			$sentencia_select->execute();
			$estado=$sentencia_select->fetchAll();

			foreach ($estado as $f_art) {
				//comparar articulo con metodo post para saber si esta diponible
				if ($id_articulo == $f_art['id_articulo']){

					

					if ($f_art['disponibilidad']==2) {
						
						// inserta el id de usuario y el de articulo en la tabla de prestamos
						$sentencia_insert=$con->prepare('CALL prestamos(?,?)');
						$sentencia_insert->bindParam(1, $id_usuario, PDO::PARAM_INT);
						$sentencia_insert->bindParam(2, $id_articulo, PDO::PARAM_INT);
						$sentencia_insert->execute();

						// cambia de estado el articulo
						$sentencia_insert=$con->prepare('CALL estado_prestamo(1,?)');
						$sentencia_insert->bindParam(1, $id_articulo, PDO::PARAM_INT);
						$sentencia_insert->execute();

						// cambia de estado el usuario
						$sentencia_insert=$con->prepare('CALL estado_usuario(2,?)');
						$sentencia_insert->bindParam(1, $id_usuario, PDO::PARAM_INT);
						$sentencia_insert->execute();

						header('location: prestamo.php');
					}else {
						echo "error el artculo no esta disponible";
					}
				}
			}

			
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
                        <a class="navbar-brand" href="../home2.php">
                            <span><i class="fas fa-home fa-2x"></i></span>
                            <h2 class="text-white h2 text-center d-inline">Monitor</h2>
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
                                <li class="nav-item"><a class="nav-link text-success h6 disabled" href="prestamo.php">Préstamos</a></li>
                                <li class="nav-item"><a class="nav-link text-white h6" href="inciencia.php">Incidencias</a></li>
                                <li class="nav-item"><a class="nav-link text-white h6" href="inventario.php">Inventario</a></li>
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
				<h2 class="display-4 text-success" style="font-family: 'Yusei Magic', sans-serif;">Generar Préstamo</h2>
			</div>
			<div class="row pt-3">
				<div class="col-2"></div>
				<div class="col-8">
					<div class="card border-light">
						<div class="card-header text-center"></div>
						<div class="card-body">
							<form class="row g-3" action="" method="POST">
								<div class="col-md-6">
									<label for="inputState" class="form-label h5 p-2">Usuario:</label>
									<select id="inputState" class="form-select h6" name="id_usuario">
										<option  value="0" selected class="h6">Seleccione usuario</option>
										<?php 
											$query = $con -> prepare("SELECT * FROM usuarios");
											$query -> execute();
											foreach ($query as $key ) {
												echo '<option value ="'.$key[id_usuario].'">'.$key[nombre].'</option>';					 	
											} 
										?>
									</select>
								</div>
								<div class="col-md-6">
									<label for="inputState" class="form-label h5 p-2">Artículo:</label>
									<select id="inputState" class="form-select h6" name="id_articulo">
										<option  value="0" selected class="h6">Seleccione Artículo</option>
										<?php 
											$query = $con -> prepare("SELECT * FROM articulos");
											$query -> execute();
											foreach ($query as $key ) {
												echo '<option value ="'.$key[id_articulo].'">'.$key[nombre_articulo].'</option>';					 	
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
									<a href="prestamo.php" class="rounded-circle p-2 bg-success border border-3 border-white text-decoration-none mt-2">
										<i class="fas fa-chevron-left fa-lg text-white" title="Atras"></i>
									</a>							
								</div>
								<div class="col-6">
									<a href="insert_prestamos.php" name="btn_cancelar" class="btn btn-outline-success has-danger d-inline">Limpiar</a>
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