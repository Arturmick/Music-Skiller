<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music Skiller</title>
    <link rel="icon" href="imagenes/logoFondoBlanco.png" type="image/png">
    <link rel="stylesheet" href="css/styles.css">
    <script src="scripts/scripts.js"></script>
</head>
<body>

<div class="cabecera">
    <a href="index.php" class="menuLogo">
        <img class="logo" src="imagenes/musica skilller3.png" alt="Logo">
    </a>
    <div id="nombreCabecera">Music Skiller</div>
    <div class="menu">
        <div>INICIO</div>
        <div>CONOCENOS</div>
        <div>SERVICIOS</div>
    </div>
    
    <?php if (isset($_SESSION['nick'])) { ?>

        <a href="userData.php" class="menu3">
            <div id="nick"><?php echo htmlspecialchars($_SESSION['nick']); ?></div>
        </a>

    <?php } else { ?>

    <a href="login.php" class="menu2">
        <div>Log in</div>
        <img id="login" src="imagenes/login.png" alt="Login">
    </a>

    <?php } ?>
</div>
</div>
<div class="tituloSelectorMenu">
    <img src="imagenes/trombon.png" alt="">
    <div id="instrumento">Trombón</div>
</div>
<div class="selectorEjercicio">
    <div class="selectores ejercicios">
        <div id="escalas">Escalas</div>
        <div id="arpegios">Intervalos</div>
        <div id="picado">Picado</div>
        <div id="ligado">Ligado</div>
        <div id="trino">Trino</div>
        <div id="agudos">Agudos</div>
        <div id="grvaes">Graves</div>
        <div id="flexibilidad">Flexibilidad</div>
    </div>
    <div id='nivel' class="selectores">
        <div id="principiante">Principiante</div>
        <div id="medio">Medio</div>
        <div id="avanzado" class="">Avanzado</div>
    </div>
    <div id="ejercicios">
    </div>
</div>
</body>
</html>
