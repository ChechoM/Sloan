<?php
	include_once "../conexion.php";
	if (isset($_GET['id_articulo'])){
		$id_articulo=(int)$_GET['id_articulo'];
		$buscar_registro=$con->prepare('SELECT * FROM articulos WHERE id_articulo= :id_articulo');
		$buscar_registro -> execute(array(':id_articulo'=>$id_articulo));
		$resultado= $buscar_registro -> fetch();
	}else {
		header('location: inventario.php');
	}
	if (isset($_POST['btn_guardar'])){
		$categoria=$_POST['categoria'];
		$nombre_articulo=$_POST['nombre_articulo'];
		$descripcion=$_POST['descripcion'];
		$codigo_barras=$_POST['codigo_barras'];
		$disponibilidad=$_POST['disponibilidad'];
		$estado=$_POST['estado'];

		$id_articulo=(int)$_GET['id_articulo'];
		if (!empty ($id_articulo) && !empty ($categoria) && !empty ($nombre_articulo) && !empty($descripcion)&& !empty($codigo_barras)&& !empty($disponibilidad)&& !empty($estado) && !empty($id_articulo)){
			$modificar_articulo= $con-> prepare ('UPDATE articulos SET 
				categoria=:categoria,
				nombre_articulo=:nombre_articulo,
				descripcion=:descripcion,
				codigo_barras=:codigo_barras,
				disponibilidad=:disponibilidad,
				estado=:estado WHERE id_articulo=:id_articulo');
			$modificar_articulo-> execute(array( 
				':id_articulo'=>$id_articulo,
				':categoria'=>$categoria, 
				':nombre_articulo'=>$nombre_articulo, 
				':descripcion'=> $descripcion,
				':codigo_barras'=>$codigo_barras,
				':disponibilidad'=>$disponibilidad,
				':estado'=>$estado));
				header('location: inventario.php');
			
		} else {
			echo ("los campos estan vacios");
		}
	}	
?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<title>Sloan - Modificar Articulo</title>
	</head>
	<body>
		<h2>Actualizar Articulos Audiovisuales</h2>
		<form action="" method="post">
			<select name="categoria">
				<option value="0">Selccione Categoria del Articulo</option>
				<?php 
					$query = $con -> prepare("SELECT * FROM categorias");
					$query -> execute();
					foreach ($query as $key ) {
						echo '<option value ="'.$key[id_categoria].'">'.$key[nombre_categoria].'</option>';					 	
					} 
				?>			
			</select>	
			<input type="text" name="nombre_articulo" value=" <?php if($resultado) echo $resultado['nombre_articulo']; ?>" class="input_text" onkeypress="return soloLetras(event)">
			<input type="text" name="descripcion" value=" <?php if($resultado) echo $resultado['descripcion']; ?>" class="input_text">
			<input type="text" name="codigo_barras" value=" <?php if($resultado) echo $resultado['codigo_barras']; ?>" class="input_text" onkeypress="return validarNumero(event)">
			<select name="disponibilidad">
				<option value="0">Seleccione Disponibilidad del Articulo</option>
				<?php 
					$query = $con -> prepare("SELECT * FROM disponibles");
					$query -> execute();
					foreach ($query as $key ) {
						echo '<option value ="'.$key[id_disponible].'">'.$key[nombre_disponible].'</option>';					 	
					} 
				?>
			</select>				
			<select name="estado">
				<option value="0">Seleccione Estado del Articulo</option>
				<?php 
					$query = $con -> prepare("SELECT * FROM estados");
					$query -> execute();
					foreach ($query as $key ) {
						echo '<option value ="'.$key[id_estado].'">'.$key[nombre_estado].'</option>';					 	
					} 
				?>
			</select>	

			<!--boton-->
			<input type="submit" name="btn_guardar" value="Guardar">
			<input type="submit" name="btn_cancelar" value="Cancelar">
			<a href="inventario.php">atras</a>
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
                	var $mensaje=alert("Solo se Permiten Letras");
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