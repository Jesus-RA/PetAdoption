<?php
    include("conexion.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estadisticas</title>
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

    <!-- Creación de la gráfica -->
    <?php
                    include "libchart/classes/libchart.php";
                    $chart = new PieChart(800,500);
                    $data = new XYDataSet();

                    $bd = conectarse();
                    $queryTipos = "SELECT * FROM tipoMascota";
                    $resTipos = $bd->query($queryTipos);
                    if(!$resTipos){
                        printf("Error: %s\n", $bd->error);
                        die('Query error').$bd->error;
                    }
                    while($rowTipos = $resTipos->fetch_assoc()){
                        $idTipo = $rowTipos['idTipoMascota'];
                        $tipo = $rowTipos['tipo'];
                        $query = "SELECT COUNT(*) AS cont FROM mascota m, tipoMascota t WHERE ( (m.tipo = $idTipo) AND (m.idMascota IN (SELECT mascota FROM adopcion)) ) AND idTipoMascota = $idTipo;";
                        $result = $bd->query($query);
                        $rowCount = $result->fetch_assoc();
                        if(!$result){
                            printf("Error: %s\n", $bd->error);
                            die('Query error').$bd->error;
                        }
                        $count = $rowCount['cont'];
                        $data->addPoint(new Point("$tipo", "$count"));
                    }
                    
                    $chart->setDataSet($data);
                    $chart->getPlot()->setGraphPadding(new Padding(5, 40, 40, 17));
                    $chart->setTitle("Adopciones");
                    $chart->render("generated/adopciones.png");
                    $bd->close();
                ?>
    <section>
        <div class="row">
            <div class="col-lg-12" id="titulo">Estadisticas</div>
            <div class="col-lg-12" id="divImgEstadisticas">
                <img src="generated/adopciones.png" alt="Grádica de adopciones" id="grafico">
            </div>
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