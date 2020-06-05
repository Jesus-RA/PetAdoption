<?php
    include('conexion.php');

    $cliente = $_POST['cliente'];
    if(!empty($cliente)){
        $bd = conectarse();
        $query = "call sp_MascotasCliente($cliente)";
        $result = $bd->query($query);
        if(!$result){
            die('Query error'.mysqli_error($result));
        }
        $json = array();
        while($row = $result->fetch_assoc()){
            $json[] = array(
                "idMascota" => $row['idMascota'],
                "foto" => $row['foto'],
                "tipo" => $row['tipo'],
                "nombre" => $row['nombre'],
                "edad" => $row['edad'],
                "raza" => $row['raza'],
                "descripcion" => $row['descripcion']
            );
        }
        $jsonString = json_encode($json);
        echo $jsonString;
    }

?>