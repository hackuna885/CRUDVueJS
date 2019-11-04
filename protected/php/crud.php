<?php
error_reporting(E_ALL ^ E_DEPRECATED);
header("Content-Type: text/html; Charset=UTF-8");


include_once 'conexion.php';

$objeto = new Conexion();
$conexion = $objeto->Conectar();


//Conexión PHP con Axios

$_POST = json_decode(file_get_contents("php://input"), true);


// Recepción de datos de POST desde main.js

$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';

$id = (isset($_POST['id'])) ? $_POST['id'] : '';
$marca = (isset($_POST['marca'])) ? $_POST['marca'] : '';
$modelo = (isset($_POST['modelo'])) ? $_POST['modelo'] : '';
$stock = (isset($_POST['stock'])) ? $_POST['stock'] : '';


switch ($opcion) {
    case 1: //alta
        $consulta = "INSERT INTO moviles (marca, modelo, stock) VALUES('$marca', '$modelo', '$stock') ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        break;
    case 2: //modificación
        $consulta = "UPDATE moviles SET marca='$marca', modelo='$modelo', stock='$stock' WHERE id='$id' ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 3: //borrar
        $consulta = "DELETE FROM moviles WHERE id='$id' ";	
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        break;
    case 4: //lista
        $consulta = "SELECT id, marca, modelo, stock FROM moviles";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
}


print json_encode($data, JSON_UNESCAPED_UNICODE); // convierte el array de JSON a JS
$conexion = NULL;

?>