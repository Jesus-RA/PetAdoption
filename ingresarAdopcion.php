<?php
    include("conexion.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet Adoption</title>
    <link rel="stylesheet" href="css/style.css">
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous"> -->
    <link href="https://fonts.googleapis.com/css2?family=Chelsea+Market&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Barra de navegación -->
    <nav>
        <ul class="row">
            <div class="col-lg-4" id="petAdoption"><li><a href="index.php">Pet Adoption</a></li></div>
            <div class="col-lg-2"></div>
            <div class="col-lg-6" id="navBtn">
                <div class="col-lg-3" id="adoptar"><li><a href="adoptar.php">Adoptar</a></li></div>
                <div class="col-lg-3" id="verClientes"><li><a href="verClientes.php">Clientes</a></li></div>
                <div class="col-lg-3" id="verMascotas"><li><a href="verMascotas.php">Mascotas</a></li></div>
                <div class="col-lg-3" id="estadisticas"><li><a href="estadisticas.php">Estadisticas</a></li></div>
            </div>
        </ul>
    </nav>

    <!-- Formulario de adopción -->
    <section>
        <?php
            $cliente = $_REQUEST['cliente'];
            $mascota = $_REQUEST['mascota'];
            
            $bd = conectarse();
            //Insertamos la adopcion
            $query = "INSERT INTO adopcion (cliente, mascota) VALUES ($cliente, $mascota)";
            $result = $bd->query($query);
            if(!$result){
                // die("Query error: ".mysqli_error($bd));
                $adoptar = false;
            }else{
                $adoptar = true;
                //Obtenemos la informacion de la mascota
                $query = "SELECT * FROM mascota WHERE idMascota = $mascota";
                $result = $bd->query($query);
                if(!$result){
                    die("Query error".mysqli_error($bd));
                }
                $row = $result->fetch_assoc();
                $foto = $row['foto'];
                $nombreMascota = $row['nombre'];
                $edad = $row['edad'];
                $des = $row['descripcion'];

                //Obtenemos la información del cliente
                $query = "SELECT nombre FROM cliente WHERE idCliente = $cliente";
                if(!$result){
                    die("Query error".mysqli_error($bd));
                }
                $result = $bd->query($query);
                $row = $result->fetch_assoc();
                $nombreCliente = $row['nombre'];
            }

        ?>
        
        <div class="row">
            <!-- Tabla -->
            <?php if ($adoptar === true):?>
            <div class="col-lg-12" id="divAdoptado">
                <div class="row" id="felicidades">
                    <div class="col-lg-6">
                        <p>En hora buena <?php echo $nombreCliente?>! Has adoptado a <?php echo $nombreMascota?></p>
                    </div>
                </div>
                <div class="col-lg-6" id="mascotaAdoptada">
                    <table>
                        <thead>
                            <th>Mascota</th>
                            <th>Foto</th>
                            <th>Edad</th>
                            <th>Descripción</th>
                        </thead>
                        <tbody id="mascotas">
                        <tr>
                            <td><img src="images/<?php echo $foto ?>" alt=""></td>
                            <td><?php echo $nombreMascota ?></td>
                            <td><?php echo $edad ?> meses</td>
                            <td><?php echo $des ?></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <a href="index.php"><button class="col-lg-1" id="goHome">Inicio</button></a>
                </div>
            </div>
            <?php else: ?>
                <div class="row" id="noAdoptar">
                    <div class="col-lg-6" id="noMas">
                        <p>Lo sentimos, ya no puedes adoptar más mascotas</p>
                    </div>
                    <div class="row">
                        <a href="index.php"><button class="col-lg-1" id="goHome">Inicio</button></a>
                    </div>
                </div>
            <?php endif ?>
        </div>
    </section>

    <footer>
        <div class="row">
            <div class="col-lg-12">
                <p>Copyright <span>&copy;</span> Designed by Jesús Ramírez Alejandro</p>
            </div>
        </div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="js/getTipoMascotas.js"></script>
    <script src="js/getMascotas.js"></script>
</body>
</html>