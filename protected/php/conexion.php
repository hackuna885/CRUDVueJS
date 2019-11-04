<?php

    class Conexion{
        public static function Conectar(){
            define('servidor', 'localhost');
            define('nombre_db', 'crudconvuejs');
            define('usuario', 'root');
            define('password', '');

            $opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');

            try{
                $conexion = new PDO("mysql:host=".servidor."; dbname=".nombre_db , usuario, password, $opciones);
                return $conexion;
            }catch (Exception $e){
                die("El problema de Conexión es: ". $e->getMessage());
            }
        }
    }



?>