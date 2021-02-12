<?php
	include_once "../conexion.php";

	
	if (isset($_POST['btn_guardar'])){

			$inputCarnet = $_POST['carnet'];

			// busca un usuario con el carnet ingresado en el input y toma su id de usuario
			$sentencia_select=$con->prepare('call carnet_id(?)');
			$sentencia_select->bindParam(1, $inputCarnet, PDO::PARAM_INT);
			$sentencia_select->execute();											
			$carnet=$sentencia_select->fetchAll();
			
			foreach ($carnet as $f_carnet) {}
			
			// lleva los input a dos variables para lluego llevarlas a el procedimiento almacenado
			$buscar_text= $f_carnet['id_usuario'];
			$buscar_text2=$_POST['id_articulo'];

			//busco las filas de prestamos que contengan el id de usuario y el id de articulo
			$sentencia_select=$con->prepare('call confirmar_dev(?,?)');
			$sentencia_select->bindParam(1, $buscar_text, PDO::PARAM_INT);
			$sentencia_select->bindParam(2, $buscar_text2, PDO::PARAM_INT);
			$sentencia_select->execute();											
			$confirmar=$sentencia_select->fetchAll();																	 

			if (empty($buscar_text)|| empty($buscar_text2)){

				//recorre el array confirmar para luego elegir que fila es mas reciente
				foreach ($confirmar as $filaV ) {}
				
				$id_articulo=$filaV['id_articulo'];
				$id_usuario=$filaV['id_usuario'];
			}
	
			if (!empty ($id_usuario) && !empty ($id_articulo)){

				// buscar en la tabla articulo para luego comparar que exista
				$sentencia_select = $con->prepare('SELECT * FROM articulos WHERE id_articulo LIKE :campo ORDER BY id_articulo ASC');
				$sentencia_select->execute(array(':campo'=>"%".$id_articulo."%"));
				$estado=$sentencia_select->fetchAll();

				
				
				/// NO ENTRA A ELFOR
				foreach ($estado as $f_art) {
					
					//compara id articulo con methodo post
					if ($id_articulo == $f_art['id_articulo']){
						
						if ($f_art['disponibilidad']==2) {
	
							//agrega loas datos de metodo post a la tabla devoluciones
							$sentencia_insert=$con->prepare('CALL devolucion(?,?)');
							$sentencia_insert->bindParam(1, $id_usuario, PDO::PARAM_INT);
							$sentencia_insert->bindParam(2, $id_articulo, PDO::PARAM_INT);
							$sentencia_insert->execute();
	
							//Busca la tabla devoluciones para sacar el id y llenar el detallle de devolucion
							$sentencia_select=$con->prepare('SELECT * FROM devoluciones ORDER BY id_devolucion ASC');
							$sentencia_select->execute();
							$resultado=$sentencia_select->fetchAll();
				
							foreach ($resultado as $fila) {}
				
							//LLENAR DETALLE DEVOLUCION
							$sentencia_insert=$con->prepare('CALL det_devolucion(?)');
							$sentencia_insert->bindParam(1,$fila['id_devolucion'], PDO::PARAM_INT);
							$sentencia_insert->execute();
							
							//cambia de estado el usuario
							$sentencia_insert=$con->prepare('CALL estado_usuario(1,?)');
							$sentencia_insert->bindParam(1, $id_usuario, PDO::PARAM_INT);
							$sentencia_insert->execute();
	
							//cambia de estado el articulo
							$sentencia_insert=$con->prepare('CALL estado_prestamo(1,?)');
							$sentencia_insert->bindParam(1, $id_articulo, PDO::PARAM_INT);
							$sentencia_insert->execute();
	
							header('location: devoluciones.php');
						}else {
							echo "error el artculo no se ha prestado";
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
        
		<title>Devoluciones Sloan</title>
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
                            <span><i class="fas fa-home"></i></span>
                        </a>
                        <h2 class="text-white h2 text-center">Administrador</h2>
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
                                <li class="nav-item"><a class="nav-link text-success h6 disabled" href="devoluciones.php">Devoluciones</a></li>
                                <li class="nav-item"><a class="nav-link text-white h6" href="prestamo.php">Préstamos</a></li>
                                <li class="nav-item"><a class="nav-link text-white h6" href="inciencia.php">Incidencias</a></li>
                                <li class="nav-item"><a class="nav-link text-white h6" href="inventario.php">Inventario</a></li>
                                <li class="nav-item"><a class="nav-link text-white h6" href="usuarios.php">Usuarios</a></li>
                                <li><div class="dropdown-divider"></div></li>
                                <li class="nav-item"><a class="nav-link text-white h6" href="../ingresoUsuarios.php">Salir</a></li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>

        </div>      

        <!-- Contenedor #2 -->
		<div class="container mt-5">
			<div class="row text-center pt-5">
				<h2 class="display-4 text-success" style="font-family: 'Yusei Magic', sans-serif;">Generar Devolución</h2>
			</div>
			<div class="row pt-3">
				<div class="col-2"></div>
				<div class="col-8">
					<div class="card border-light">
						<div class="card-header text-center"></div>
						<div class="card-body">
							<form class="row g-3" action="" method="POST">
								<div class="col-md-6">
									<label for="inputState" class="form-label h5 p-2">Numero carnet:</label>
									 <input type ="text" name ="carnet" class="form-control" placeholder="Carnet">
									 
								</div>
								<div class="col-md-6">
									<label for="inputState" class="form-label h5 p-2">Artículo:</label>
									<input type ="text" name ="id_articulo" class="form-control" placeholder="ID artículo">
								 
								</div>
								<div class="col-12 text-center">
									<input type="submit" name="btn_guardar" value="Guardar" class="btn btn-success text-white btn-lg mb-3 mt-2">
								</div>
							</form>	
						</div>
						<div class="card-footer text-muted text-center pt-3">
							<div class="row align-items-center">
								<div class="col-6">
									<a href="devoluciones.php" class="rounded-circle p-2 bg-success border border-3 border-white text-decoration-none mt-2">
										<i class="fas fa-chevron-left fa-lg text-white" title="Atras"></i>
									</a>							
								</div>
								<div class="col-6">
									<a href="insert_devoluciones.php" name="btn_cancelar" class="btn btn-outline-success has-danger d-inline">Limpiar</a>
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