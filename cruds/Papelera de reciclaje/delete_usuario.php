<?php
	include_once "../conexion.php";
	if (isset ($_GET['id_usuario'])){
		$id_usuario=(int)$_GET['id_usuario'];
		$delete_usuario= $con-> prepare('DELETE FROM usuarios WHERE id_usuario=:id_usuario');
		$delete_usuario-> execute(array(':id_usuario'=>$id_usuario));
		header ('location: usuarios.php');
	} else {
	    header ('location: usuarios.php');
	}
?>