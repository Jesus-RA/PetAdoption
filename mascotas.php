<?php
    include('conexion.php');

    $raza = $_POST['raza'];
    if(!empty($raza)){
        $bd = conectarse();
        $query = "SELECT * FROM mascota WHERE raza = $raza";
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