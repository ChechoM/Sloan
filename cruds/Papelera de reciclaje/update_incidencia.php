<?php
	include_once "../conexion.php";
	if (isset($_GET['id_incidencia'])){
		$id_incidencia=(int)$_GET['id_incidencia'];
		$buscar_registro=$con->prepare('SELECT * FROM incidencias WHERE id_incidencia= :id_incidencia');
		$buscar_registro -> execute(array(':id_incidencia'=>$id_incidencia));
		$resultado= $buscar_registro -> fetch();
	}else {
		header('location: inciencia.php');
	}
	if (isset($_POST['btn_guardar'])){
		$id_det_devolucion=$_POST['id_det_devolucion'];
		$tipo_incidencia=$_POST['tipo_incidencia'];
		$observaciones=$_POST['observaciones'];
	
		$id_incidencia=(int)$_GET['id_incidencia'];
		if (!empty ($id_incidencia) && !empty ($id_det_devolucion) && !empty ($tipo_incidencia) && !empty($observaciones) && !empty($id_incidencia)){
			$modificar_articulo= $con-> prepare ('UPDATE incidencias SET 
				id_det_devolucion=:id_det_devolucion,
				tipo_incidencia=:tipo_incidencia,
				observaciones=:observaciones WHERE id_incidencia=:id_incidencia');
			$modificar_articulo-> execute(array( 
				':id_incidencia'=>$id_incidencia,
				':id_det_devolucion'=>$id_det_devolucion, 
				':tipo_incidencia'=>$tipo_incidencia, 
				':observaciones'=> $observaciones
			));
			header('location: inciencia.php');
			
		} else {
			echo ("los campos estan vacios");
		}
	}	
?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<title>Sloan - Incidencias</title>
	</head>
	<body>
		<h2>Modificar Incidencia</h2>
		<form action="" method="post">

			<select name="id_det_devolucion">
				<option value="0">Selccione Categoria del Articulo</option>
				<?php 
					$query = $con -> prepare("SELECT * FROM det_devolucion");
					$query -> execute();
					foreach ($query as $key ) {
						echo '<option value ="'.$key[id_det_devolucion].'">'.$key[id_devolucion].'</option>';					 	
					} 
				?>			
			</select>	
			<input type="text" name="tipo_incidencia" value=" <?php if($resultado) echo $resultado['tipo_incidencia']; ?>" class="input_text">
			<input type="text" name="observaciones" value=" <?php if($resultado) echo $resultado['observaciones']; ?>" class="input_text">

			<!--boton-->
			<input type="submit" name="btn_guardar" value="Guardar">
			<input type="submit" name="btn_cancelar" value="Cancelar">
			<a href="inciencia.php">atras</a>
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