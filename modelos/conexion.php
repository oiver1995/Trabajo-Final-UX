<?php
class Conexion {

    static public function conectar(){

        $usuario = "admin";
        $password = "root";

        $nombreBaseDeDatos = "gestion";

        # Puede ser 127.0.0.1 o el nombre de tu equipo; o la IP de un servidor remoto
        $rutaServidor = "localhost";

        $puerto = "3306";

        $link = new PDO("mysql:host=$rutaServidor; dbname=$nombreBaseDeDatos", "$usuario", "$password");

        $link->exec("set names utf8");

        $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $link->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

        return $link;
    }          

}