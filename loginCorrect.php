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

<?php if (isset($_SESSION['nick'])) { ?>

    <div class="tituloSelectorMenu">
        <img src="imagenes/trombon.png" alt="">
        <div id="instrumento"><?php echo htmlspecialchars($_SESSION['nick']); ?></div>
    </div>
    <div id="tituloLogin">Bienvenido</div>
    <div id="decoracionLogin">
        <div id="formulario">

            <div id="loginForm">
                <div id="labels">
                    <div>Usuario: <br><?php echo htmlspecialchars($_SESSION['nick']); ?><br><br></div>
                    <?php if (isset($_SESSION['email'])) { ?>
                        <div>Email: <br><?php echo htmlspecialchars($_SESSION['email']); ?><br><br></div>
                    <?php } ?>
                    <?php if (isset($_SESSION['instrumento'])) { ?>
                        <div>Instrumento: <br><?php echo htmlspecialchars($_SESSION['instrumento']); ?><br><br></div>
                    <?php } ?>
                    <!--                    --><?php //if (isset($_SESSION['nombre'])) { ?>
                    <!--                        <div>Nombre: --><?php //echo htmlspecialchars($_SESSION['nombre']); ?><!--</div>-->
                    <!--                    --><?php //} ?>
                    <!--                    --><?php //if (isset($_SESSION['teléfono'])) { ?>
                    <!--                        <div>Teléfono: --><?php //echo htmlspecialchars($_SESSION['teléfono']); ?><!--</div>-->
                    <!--                    --><?php //} ?>
                    <!--                    --><?php //if (isset($_SESSION['dirección'])) { ?>
                    <!--                        <div>Dirección: --><?php //echo htmlspecialchars($_SESSION['dirección']); ?><!--</div>-->
                    <!--                    --><?php //} ?>
                </div>
                <a id="acceder" href="logOut.php">Cerrar sesión</a>
            </div>
        </div>
        <div id="mensajeLogin" class=""></div>
    </div>

<?php } else { ?>

    <div class="tituloSelectorMenu">
        <img src="imagenes/trombon.png" alt="">
        <div id="instrumento">Adiós</div>
    </div>
    <div id="tituloLogin">Sesión cerrada correctamente</div>



<?php } ?>
</body>
</html>