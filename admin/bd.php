<?php

$servidor ="localhost";
$baseDatos="restaurante";
$usuario="root";
$contraseña="";
try{
   
 $conexion = new PDO("mysql:host=$servidor;dbname=$baseDatos", $usuario, $contraseña);
    echo "Conectado";
} catch(exeption $error){
  echo $error->getMessage();
}

?>