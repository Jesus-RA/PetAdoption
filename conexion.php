<?php
    function conectarse(){
        $link = new mysqli("localhost", "JesusRA", "jamon", "petAdoption");
        return $link;
    }

    // $bd = conectarse();

    function getClientes(){
        $bd = conectarse();
        $query = "SELECT * FROM cliente";
        $result = $bd->query($query);
        $i = 0;
        while($row = $result->fetch_assoc()){
            $clientes[$i] = [
                "id" => $row['idCliente'],
                "nombre" => $row['nombre'],
                "telefono" => $row['telefono'],
                "ciudad" => $row['ciudad'],
                "email" => $row['email'],
                "edad" => $row['edad'],
                "genero" => $row['genero'],
                 "adopciones" => $row['adopciones']
            ];
            $i++;
        }
        return $clientes;
    }

    function getMascotas(){
        $bd = conectarse();
        $query = "SELECT * FROM mascota";
        $result = $bd->query($query);
        $i = 0;
        while($row = $result->fetch_assoc()){
            $mascotas[$i] = [
                "idMascota" => $row['idMascota'],
                "foto" => $row['foto'],
                "tipo" => $row['tipo'],
                "nombre" => $row['nombre'],
                "edad" => $row['edad'],
                "raza" => $row['raza'],
                "descripcion" => $row['descripcion']
            ];
            $i++;
        }
        return $mascotas;
    }

    function getTipoMascotas(){
        $bd = conectarse();
        $query = "SELECT * FROM tipoMascota";
        $result = $bd->query($query);
        $i = 0;
        while($row = $result->fetch_assoc()){
            $tipoMascotas[$i] = [
                "idTipoMascota" => $row['idTipoMascota'],
                "tipo" => $row['tipo']
            ];
            $i++;
        }
        return $tipoMascotas;
    }

    function getRazaMascotas(){
        $bd = conectarse();
        $query = "SELECT * FROM razaMascota";
        $result = $bd->query($query);
        $i = 0;
        while($row = $result->fetch_assoc()){
            $razaMascotas[$i] = [
                "idRazaMascota" => $row['idRazaMascota'],
                "tipoMascota" => $row['tipoMascota'],
                "raza" => $row['raza']
            ];
            $i++;
        }
        return $razaMascotas;
    }

    function getRazaMascota($tipo){
        $bd = conectarse();
        $query = "SELECT * FROM razaMascota where tipoMascota = $tipo";
        $result = $bd->query($query);
        $i = 0;
        while($row = $result->fetch_assoc()){
            $razaMascotas[$i] = [
                "idRazaMascota" => $row['idRazaMascota'],
                "tipoMascota" => $row['tipoMascota'],
                "raza" => $row['raza']
            ];
            $i++;
        }
        return $razaMascotas;
    }

?>