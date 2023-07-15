<?php
session_start();
date_default_timezone_set('America/Lima');

require_once "../modelos/ventadetalle.php";

class ControladorVentaDetalle {

    public function ctrGetPublicIp() {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if(getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if(getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if(getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if(getenv('HTTP_FORWARDED'))
            $ipaddress = getenv('HTTP_FORWARDED');
        else if(getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';

        return $ipaddress;
    }

    public function ctrListarVentaDetalleID($id_cliente){

        $objeto = new ModeloVentaDetalle();

        $rpta = $objeto->mdlListarVentaDetalleID($id_cliente);

        include_once "../vistas/ventadetalle/modalVentaDetalle.php";

        return $rpta;
    }

    public function ctrRegistrarVentaDetalle($json_data, $estado, $usuario_creacion, $ip_creacion){

        $objeto = new ModeloVentaDetalle();

        $rpta = $objeto->mdlRegistrarVentaDetalle($json_data, $estado, $usuario_creacion, $ip_creacion);
        
        echo json_encode($rpta);
        exit;
    }
}

if (isset($_GET["accion"]) AND $_GET["accion"] == "listarVentaDetalleID"){
    $objeto = new ControladorVentaDetalle();

    $id_cliente = $_POST["id_cliente"];

    $objeto->ctrListarVentaDetalleID($id_cliente);
}

if (isset($_GET["accion"]) AND $_GET["accion"] == "registrarVentaDetalle"){
        
    $objeto = new ControladorVentaDetalle();
 
    $json_data = json_decode($_POST["json_data"]);

    $estado = "En proceso";

    $usuario_creacion = "Admin";

    $ip_creacion = $objeto->ctrGetPublicIp();

    $objeto->ctrRegistrarVentaDetalle($json_data, $estado, $usuario_creacion, $ip_creacion);
}


