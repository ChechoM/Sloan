<?php
   $database="proyectosloan";
   $usuario="root";
   $password="";
   try{
      $con=new PDO('mysql:host=localhost;dbname='.$database,$usuario,$password);
   }catch (PDOexception $e) {
      echo "Conexion erronea".$e -> getMessage ();
   }
?>