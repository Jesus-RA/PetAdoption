<?php
    include('conexion.php');

    $tipo = $_POST['tipo'];
    if(!empty($tipo)){
        $bd = conectarse();
        $query = "SELECT * FROM razaMascota where tipoMascota = $tipo";
        $result = $bd->query($query);
        if(!$result){
            die('Query Error'.mysqli_error($bd));
        }
        $json = array();
        while($row = $result->fetch_assoc()){
            $json[] = array(
                "idRazaMascota" => $row['idRazaMascota'],
                "tipoMascota" => $row['tipoMascota'],
                "raza" => $row['raza']
            );
        }
        $jsonString = json_encode($json);
        echo $jsonString;
        
    }
?>