<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music Skiller</title>
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

<?php if (!isset($_SESSION['nick'])) { ?>

    <div class="tituloSelectorMenu">
        <img src="imagenes/trombon.png" alt="">
        <div id="instrumento"></div>
    </div>
    <div id="tituloLogin">Usuario registrado correctamente<br>Inicie sesión</div>
    <div id="decoracionLogin">
        <div id="formulario">

            <form action="login.php" method="post" id="loginForm">
                <div id="labels">
                    <label for="nick">Usuario:</label>
                    <input type="text" id="nick" name="nick" required placeholder="Escriba aquí">
                    <label for="pass">Contraseña:</label>
                    <input type="password" id="pass" name="pass" required placeholder="Escriba aquí">
                </div>
                <input id="acceder" type="submit" value="Acceder">
            </form>
        </div>
        <div id="mensajeLogin" class=""></div>
    </div>

<?php } else { ?>

    <div class="tituloSelectorMenu">
        <img src="imagenes/trombon.png" alt="">
        <div id="instrumento">Hola</div>
    </div>
    <div id="tituloLogin">Sesión iniciada correctamente</div>



<?php } ?>
</body>
</html>