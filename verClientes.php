<?php
    include("conexion.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clientes</title>
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
    <?php
        $clientes = getClientes();
        $tipos = getTipoMascotas();
    ?>
    <section>
        <div class="row">
            <div class="col-lg-12" id="titulo">Clientes</div>
            <div class="col-lg-6" id="divForm">
                <!-- Foto -->
                <div class="col-lg-6" id="imgMascotasCliente">
                    <img class="col-lg-12" src="images/mascotasFamilia.png" alt="Familia">
                </div>
                <!-- Selects -->
                <div class="col-lg-6" id="selects">
                    <!-- Cliente -->
                    <div class="row">
                        <div class="col-lg-12" id="selectCliente">
                            <label for="cliente">Cliente:</label>
                            <select name="cliente" id="cliente">
                                <option value="">Seleccionar...</option>
                                <?php foreach ($clientes as $cliente) : ?>
                                <option value="<?php echo $cliente["id"]?>"><?php echo $cliente["nombre"] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Tabla -->
            <div class="col-lg-6" id="divResultado">
                <table>
                    <thead>
                        <th>Foto</th>
                        <th>Nombre</th>
                        <th>Edad</th>
                        <th>Descripción</th>
                    </thead>
                    <tbody id="mascotas">
                       
                    </tbody>
                </table>
                <div class="col-lg-12" id="noResultados">
                    <p id="nada"></p>
                </div>
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