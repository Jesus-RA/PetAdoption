<?php
    include('conexion.php');

    $tipo = $_POST['tipo'];
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
        $jsonPaginas = array();
        $jsonPaginas[] = array(
            "numeroPagina" => $paginas
        );
        $jsonString = json_encode($jsonPaginas);
        echo $jsonString;
    }
?>