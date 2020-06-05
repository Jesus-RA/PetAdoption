<?php
    include('conexion.php');

    $tipo = $_POST['tipo'];
    $pag = $_POST['pag'];
    if(!empty($tipo)){
        $db = conectarse();
        $query = "SELECT * FROM mascota WHERE tipo = $tipo";
        $result = $db->query($query);
        if(!$result){
            die('Query error'.mysqli_error($db));
        }
        if(empty($pag)){
            $pag = 1;
        }
        $articulos_x_pagina = 4;
        $articulos_bd = $result->num_rows;
        $paginas = $articulos_bd/$articulos_x_pagina;
        $paginas = ceil($paginas);

        $from = ($pag-1) * $articulos_x_pagina;
        $query_mascotas = "SELECT * FROM mascota WHERE tipo = $tipo LIMIT $from, $articulos_x_pagina";
        $result = $db->query($query_mascotas);
        if(!$result){
            die('Query error'.mysqli_error($db));
        }
        
        $j = 0;
        $json = array();
        while($row = $result->fetch_assoc()){
            $m = $row['idMascota'];
            $query_duenos = "SELECT nombre FROM cliente WHERE idCliente = (SELECT cliente FROM adopcion WHERE mascota = $m)";
            $res = $db->query($query_duenos);
            if(!$res){
                die('Query error'.mysqli_error($db));
            }
            if($res != null){
                $row1 = $res->fetch_assoc();
                if($row1!=null){
                    $name = $row1['nombre'];
                }else{
                    $name = "Sin dueño";
                }
                
            }
            $json[] = array(
                "idMascota" => $row['idMascota'],
                "foto" => $row['foto'],
                "tipo" => $row['tipo'],
                "nombre" => $row['nombre'],
                "edad" => $row['edad'],
                "raza" => $row['raza'],
                "descripcion" => $row['descripcion'],
                "dueno" => $name
            );
        }
        $jsonString = json_encode($json);
        echo $jsonString;

    }

?>