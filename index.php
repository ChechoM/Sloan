<?php  
	/* Conexión */
	include_once"conexion.php";
	
	/* Variables */
	$claseU = "class = \"form-control mt-3 mb-4 pr-3 pl-3\"";
	$clasec = "class = \"form-control mb-3 pr-3 pl-3\"";
	$placeholderU = " placeholder=\"Usuario\"";
	$placeholderP = " placeholder=\"Contraseña\"";

	$sentencia_select = $con->prepare('SELECT * FROM usuarios ORDER BY id_usuario ASC');
	$sentencia_select->execute();
	$resultado = $sentencia_select->fetchAll();

	/* Ciclos donde se verifican los datos */
	if(isset($_POST['inicio'])) {
		$buscar_text = $_POST['nUsuario'];
		$select_buscar = $con->prepare('SELECT * FROM usuarios WHERE id_usuario LIKE :campo OR nombre LIKE :campo OR apellido LIKE :campo;');
		$select_buscar->execute(array(':campo' =>"%".$buscar_text."%"));
		$resultado = $select_buscar->fetchAll();
		$arrayVacio = 0;
		foreach ($resultado as $fila) {
			$arrayVacio++;
			if ($fila['nombre'] == $_POST['nUsuario']) {
				if ($fila['contrasenia'] == $_POST['contraseña']) {
					if ($fila['tipo_usuario'] == 1) {
						header('location: home1.php');
					}
					if ($fila['tipo_usuario'] == 2) {
						header('location: home2.php');
					}
				}else{
					$placeholderP= "placeholder = \"Contraseña incorrecta\"";
					$clasec ="class = \"form-control border-danger mb-4\"";
				}
			}
		}
		if ($arrayVacio <= 0) {
			$placeholderU= "placeholder = \"Usuario no existe\"";
			$claseU ="class = \"form-control border-danger mt-3 mb-4\"";
		}
	}
?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

        <!-- ICONO Font Awesome -->
        <script src="https://kit.fontawesome.com/9f429f9981.js" crossorigin="anonymous"></script>
		
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="sass/custom.css">

		<title>Ingreso de usuarios SLOAN</title>
		<link rel="shortcut icon" href="img/Logo.png">
	</head>
	<body class="text-dark" style="font-family: 'Lato', sans-serif; background-image: url(img/F6.jpg); background-size:cover; height: 100%; background-attachment: fixed;">
		
		<!-- Targeta con formulario de acceso -->
		<div class="container position-relative">
			<div class="row mt-4 mt-lg-4 pt-lg-5">
				<div class="col-4"></div>
				<div class="col-4 mt-5 mt-lg-5">
					<div class="card text-center shadow-lg p-3 mb-5 rounded">
						<div class="card-header">
							<img width="200" src="img/Logo1.png" class="img-fluid" alt="logo">
						</div>
						<div class="card-body">
							<form method="post" class="form-group">
								<input name="nUsuario" <?php echo $claseU;?> type="text" <?php echo $placeholderU;?> required>
								<input name="contraseña" <?php echo $clasec;?> type="password" <?php echo $placeholderP;?> required>
								<button class="btn btn-success text-white btn-lg mt-3 pr-5 pl-5 mb-2 shadow" id="btnInicio" name="inicio">Ingresar</button>
							</form>
						</div>
						<div class="card-footer pt-4 pb-3">
							<a id="aLogin" href="recuperarContraseña.php" class="h6 text-info text-decoration-none">¿Olvidó su contraseña?</a>				
						</div>
					</div>
				</div>
				<div class="col-4"></div>
			</div>
		</div>
		
		<!-- Scripts de Bootstrap -->
		<script type="text/javascript" src="js/jquery-3.5.1.slim.min.js"></script>
		<script type="text/javascript" src="js/popper.min.js"></script>
		<script type="text/javascript" src="js/bootstrap.min.js"></script>
	</body>
</html>