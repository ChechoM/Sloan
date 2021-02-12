<?php
	include_once"../conexion.php";
	$sentencia_select=$con->prepare('SELECT * FROM usuarios ORDER BY id_usuario ASC');
	$sentencia_select->execute();
	$resultado=$sentencia_select->fetchAll();
	if(isset($_POST['btn_buscar'])){
		$buscar_text=$_POST['buscar'];
		$select_buscar=$con->prepare('SELECT * FROM usuarios WHERE id_usuario LIKE :campo OR nombre LIKE :campo OR apellido LIKE :campo;');
		$select_buscar->execute(array(':campo' =>"%".$buscar_text."%"));
		$resultado=$select_buscar->fetchAll();
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
        
		<title>Usuarios Sloan</title>
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
                                <li class="nav-item"><a class="nav-link text-white h6" href="prestamo.php">Préstamos</a></li>
                                <li class="nav-item"><a class="nav-link text-white h6" href="inciencia.php">Incidencias</a></li>
                                <li class="nav-item"><a class="nav-link text-white h6" href="inventario.php">Inventario</a></li>
                                <li class="nav-item"><a class="nav-link text-success h6 disabled" href="usuarios.php">Usuarios</a></li>
                                <li><div class="dropdown-divider"></div></li>
                                <li class="nav-item"><a class="nav-link text-white h6" href="../index.php">Salir</a></li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>   

        <!-- CARRUSEL CON BOTON DE BUSQUEDA -->
        <div class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="../img/Fondo.jpeg" class="d-block w-100 h-100" alt="Logo Carrusel">
                </div>
                <div class="carousel-caption d-sm-block mt-sm-5 d-md-block">
                    <h1 class="display-2 text-white mb-5 d-none d-md-block">Usuarios</h1>
					<form class="row text-center justify-content-center align-items-center" method="post">
	                    <div class="input-group mb-3">
                            <span class="input-group-text mb-5" id="basic-addon1"><i class="fas fa-search"></i></span>
							<input type="text" class="form-control mb-5" name="buscar" placeholder="Buscar usuario" value="<?php if(isset($buscar_text)) echo $buscar_text; ?>">
                            <input type="submit" class="btn btn-warning text-white btn-lg mb-5" name="btn_buscar" value="Buscar">
	                    </div>
                        <div class="col-12">
                            <a href="insert_usuario.php" class="btn btn-success text-white btn-lg mb-5 ml-3 shadow">Agregar Usuario</a>							
                        </div>
					</form>
                </div>
            </div>
        </div>

		<!-- Contenedor #2 -->
		<div class="container">

            <!-- TABLA -->
			<div class="row pt-5">
				<div class="col-12">
        			<table class="table table-striped table-hover shadow p-3 mb-5 bg-white rounded">
        				<thead>
        					<tr class="text-center">
								<th class="h5" scope="col">Id. Usuario</th>
								<th class="h5" scope="col">Tipo de Usuario</th>
								<th class="h5" scope="col">Nombre</th>
								<th class="h5" scope="col">Apellido</th>
								<th class="h5" scope="col">Número de Carnet</th>
								<th class="h5" scope="col">Estado Usuario</th>
								<th class="h5" scope="col">Contraseña</th>
 		           				<th class="h5" scope="col"><i class="fas fa-exclamation-triangle mr-5"></i></th>
                                <th class="h5" scope="col"><i class="fas fa-trash-alt"></i></th>
        					</tr>
        				</thead>
        				<tbody>
							<?php foreach($resultado as $fila):?>
        					<tr class="text-center">
								<td class="h6" scope="row"><?php echo $fila['id_usuario']; ?> </td>
								<td class="h6"><?php echo $fila['tipo_usuario']; ?> </td>
								<td class="h6"><?php echo $fila['nombre']; ?> </td>
								<td class="h6"><?php echo $fila['apellido']; ?> </td>
								<td class="h6"><?php echo $fila['numero_carnet'];?></td>
								<td class="h6"><?php echo $fila['estado_usuario']; ?></td>
								<td class="h6"><?php echo $fila['contrasenia']; ?></td>

								<!-- BOTONES -->
								<td><a href="update_usuario.php?id_usuario= <?php echo $fila['id_usuario']; ?>" class="h6 text-info">Modificar</a></td>
								<td><a href="delete_usuario.php?id_usuario= <?php echo $fila['id_usuario']; ?>" class="h6 text-danger" onclick="return confirmarEliminar()">Eliminar</a></td>
        					</tr>
        					<?php endforeach ?>
        				</tbody>
        			</table>
				</div>
			</div>

            <!-- OPCIONES -->
            <div class="row mt-5" style="font-family: 'Yusei Magic', sans-serif;">
                <div class="col-12">
                    <div class="container bg-dark border shadow p-3 mb-5 rounded">
                        <div class="row text-center pt-4 pb-lg-4">
                            <div class="col-12 col-md-6 col-lg-4">
                                <h2 class="pb-2"><a href="devoluciones.php" class="text-info text-decoration-none">Devoluciones</a></h2>
                                <p class="text-secondary h6">Úsalo para tramitar</p>
                                <p class="text-secondary h6">devoluciones</p>
                                <p class="text-secondary h6">de artículos</p>
                            </div>
                            <div class="col-12 col-md-6 col-lg-4">
                                <h2 class="pb-2"><a href="prestamo.php" class="text-primary text-decoration-none">Préstamos</a></h2>
                                <p class="text-secondary h6">Úsalo para tramitar</p>
                                <p class="text-secondary h6">préstamos</p>
                                <p class="text-secondary h6">de artículos</p>
                            </div>

                            <div class="col-12 col-md-12 col-lg-4">
                                <h2 class="pb-2"><a href="inciencia.php" class="text-success text-decoration-none">Incidencias </a></h2>
                                <p class="text-secondary h6">Úsalo para consultar</p>
                                <p class="text-secondary h6">reportes</p>
                                <p class="text-secondary h6">de incidencias</p>
                            </div>
                        </div> 
                        <div class="row text-center pt-sm-0 pb-4">
                            <div class="col-lg-6 col-md-6">
                                <h2 class="pb-2"><a href="inventario.php" class="text-warning text-decoration-none">Inventario</a></h2>
                                <p class="text-secondary h6">Úsalo para</p>
                                <p class="text-secondary h6">administrar</p>
                                <p class="text-secondary h6">tu inventario</p>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <h2 class="pb-2"><a href="usuarios.php" class="text-secondary nav-link disabled text-decoration-none">Usuarios</a></h2>
                                <p class="text-secondary h6">Úsalo para tramitar</p>
                                <p class="text-secondary h6">administrar</p>
                                <p class="text-secondary h6">prestadores</p>
                            </div>
                        </div>           
                    </div> 
                </div>
            </div>
		</div>

		<!--script para crear la ventana modal para confirmacion de eliminacion de un registro  -->
		<script>
	  		function confirmarEliminar(){
		  		var respuesta = confirm("¿ Estás seguro que deseas eliminar este registro ?");
		  		if (respuesta == true){
		  			return true;
		  		}else {
		  			return false;
		  		}
			}
		</script>
		
		<!-- Scripts de Bootstrap -->
		<script type="text/javascript" src="../js/jquery-3.5.1.slim.min.js"></script>
		<script type="text/javascript" src="../js/popper.min.js"></script>
		<script type="text/javascript" src="../js/bootstrap.min.js"></script>
	</body>
</html>