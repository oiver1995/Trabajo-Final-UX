<?php

require_once "conexion.php";
/**
**/

class ModeloVentaDetalle {

	static public function mdlListarVentaDetalleID($id_cliente) {

    	$conn = Conexion::conectar();
            
        $stmt = $conn->prepare("SELECT id_vent_det AS codigo, producto, cantidad, precio, (cantidad * precio)AS subtotal FROM venta_detalle");
        $stmt->execute();

        $return = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $return;
	}

	static public function mdlRegistrarVentaDetalle($json_data, $estado, $usuario_creacion, $ip_creacion) {

		try {
       		$conn = Conexion::conectar();
      		$conn->beginTransaction();

			for ($i=0; $i<count($json_data); $i++) { 

	            $stmt = $conn->prepare("INSERT INTO venta_detalle (producto, cantidad, precio, estado, usuario_creacion, ip_creacion, fecha_creacion) 
	            	                                        VALUES(:producto, :cantidad, :precio, :estado, :usuario_creacion, :ip_creacion, NOW())");
 
                $stmt->bindParam(":producto", $json_data[$i]->producto, PDO::PARAM_STR);
                $stmt->bindParam(":cantidad", $json_data[$i]->cantidad, PDO::PARAM_INT);
                $stmt->bindParam(":precio", $json_data[$i]->precio, PDO::PARAM_INT);
				$stmt->bindParam(":estado", $estado, PDO::PARAM_STR);
				$stmt->bindParam(":usuario_creacion", $usuario_creacion, PDO::PARAM_STR);
				$stmt->bindParam(":ip_creacion", $ip_creacion, PDO::PARAM_STR);
				$stmt->execute();
	        }
 
			if ($conn->commit()) {
				$return["IND_OPERACION"] = 1;
	            $return["DES_MENSAJE"] = "Órden registrado correctamente.";
			}
			else {
				$return["IND_OPERACION"] = 0;
	            $return["DES_MENSAJE"] = "Error al registrar Órden.";
			}

			return $return;
	    }
	    catch(Exception $e) {
	      	$conn->rollBack();
	      	return ($e->getMessage());
	    }
    }

} 