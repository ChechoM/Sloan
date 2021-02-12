<?php
	include_once "../conexion.php";
	if (isset($_GET['id_usuario'])){
		$id_usuario=(int)$_GET['id_usuario'];
		$buscar_registro=$con->prepare('SELECT * FROM usuarios WHERE id_usuario= :id_usuario');
		$buscar_registro -> execute(array(':id_usuario'=>$id_usuario));
		$resultado= $buscar_registro -> fetch();
	}else {
		header('location: usuarios.php');
	}
	if (isset($_POST['btn_guardar'])){
		$tipo_usuario=$_POST['tipo_usuario'];
		$nombre=$_POST['nombre'];
		$apellido=$_POST['apellido'];
		$numero_carnet=$_POST['numero_carnet'];
		$estado_usuario=$_POST['estado_usuario'];
		$contrasenia=$_POST['contrasenia'];
		$id_usuario=(int)$_GET['id_usuario'];
		if (!empty ($id_usuario) && !empty ($tipo_usuario) && !empty ($nombre) && !empty($apellido)&& !empty($numero_carnet)&& !empty($estado_usuario)&& !empty($contrasenia) && !empty($id_usuario)){
			$modificar_usuario= $con-> prepare ('UPDATE usuarios SET 
				tipo_usuario=:tipo_usuario,
				nombre=:nombre,
				apellido=:apellido,
				numero_carnet=:numero_carnet,
				estado_usuario=:estado_usuario,
				contrasenia=:contrasenia WHERE id_usuario=:id_usuario');
			$modificar_usuario-> execute(array( 
				':id_usuario'=>$id_usuario, 
				':tipo_usuario'=>$tipo_usuario, 
				':nombre'=>$nombre, 
				':apellido'=> $apellido,
				':numero_carnet'=>$numero_carnet,
				':estado_usuario'=>$estado_usuario,
				':contrasenia'=>$contrasenia));
			header('location: usuarios.php');
			
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
		<title>Sloan</title>
	</head>
	<body>	
		<h2>Actualizar Información de Usuario</h2>	
		<form action="" method="post">
			<select name="tipo_usuario">
				<option value="0">Seleccione tipo de Usuario</option>
				<?php 
					$query = $con -> prepare("SELECT * FROM perfiles ");
					$query -> execute();
					foreach ($query as $key ) {
						echo '<option value ="'.$key[id_perfil].'">'.$key[nombre_perfil].'</option>';					 	
					} 
				?>			
			</select>
			<input type="text" name="nombre" value=" <?php if($resultado) echo $resultado['nombre']; ?>" class="input_text" onkeypress="return soloLetras(event)" >
			<input type="text" name="apellido" value=" <?php if($resultado) echo $resultado['apellido']; ?>" class="input_text" onkeypress="return soloLetras(event)" >
			<input type="text" name="numero_carnet" value=" <?php if($resultado) echo $resultado['numero_carnet']; ?>" class="input_text" onkeypress="return validarNumero(event)" >
			<select name="estado_usuario">
				<option value="0">seleccione el estado del usario</option>
				<?php 
					$query = $con -> prepare("SELECT * FROM estados ");
					$query -> execute();
					foreach ($query as $key ) {
						echo '<option value ="'.$key[id_estado].'">'.$key[nombre_estado].'</option>';					 	
					} 
				?>
			</select>
			<input type="text" name="contrasenia" value=" <?php if($resultado) echo $resultado['contrasenia']; ?>" class="input_text" >
			<input type="submit" name="btn_guardar" value="Guardar">
			<input type="submit" name="btn_cancelar" value="Cancelar">
			<a href="usuarios.php">Atras</a>
		</form>	
		<script>
			function soloLetras(e){
                key = e.keyCode || e.which;
                tecla = String.fromCharCode(key).toLowerCase();
                letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
                especiales = "8-37-39-46";
                tecla_especial = false;
                for(var i in especiales){
                    if(key == especiales[i]){
                        tecla_especial = true;
                        break;
                    }
                }
                if(letras.indexOf(tecla)==-1 && !tecla_especial){
                	var $mensaje=alert("solo se permiten letras");
                    return false;
                }
            }
            function validarNumero(e) {
                tecla = (document.all) ? e.keyCode : e.which;
                if (tecla==8) return true; 
                patron =/[0-9]/;
                te = String.fromCharCode(tecla); 
                return patron.test(te); 
            }
		</script>
	</body>
</html>