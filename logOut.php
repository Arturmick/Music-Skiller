<?php
session_start();
$old_user = $_SESSION['nick'];
unset($_SESSION['nick']);
session_destroy();
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
    <div id="tituloLogin">Introduzca sus datos</div>
    <div id="decoracionLogin">
        <div id="formulario">

            <div id="loginForm">
                <div id="labels">
                    <div>Usuario: <?php echo htmlspecialchars($_SESSION['nick']); ?></div>
                    <?php if (isset($_SESSION['email'])) { ?>
                        <div>Email: <?php echo htmlspecialchars($_SESSION['email']); ?></div>
                    <?php } ?>
                    <?php if (isset($_SESSION['instrumento'])) { ?>
                        <div>Instrumento: <?php echo htmlspecialchars($_SESSION['instrumento']); ?></div>
                    <?php } ?>
                    <?php if (isset($_SESSION['nombre'])) { ?>
                        <div>Nombre: <?php echo htmlspecialchars($_SESSION['nombre']); ?></div>
                    <?php } ?>
                    <?php if (isset($_SESSION['teléfono'])) { ?>
                        <div>Teléfono: <?php echo htmlspecialchars($_SESSION['teléfono']); ?></div>
                    <?php } ?>
                    <?php if (isset($_SESSION['dirección'])) { ?>
                        <div>Dirección: <?php echo htmlspecialchars($_SESSION['dirección']); ?></div>
                    <?php } ?>
                </div>
                <a id="acceder" href="logOut.php">Cerar sesión</a>
            </div>
        </div>
        <div id="newUserLink">
            <a href="newUser.html">Crear nueva cuenta</a>
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


<script>
    const registroForm = document.getElementById('registroForm');

    if (registroForm) {
        registroForm.addEventListener('submit', function(event) {
            event.preventDefault();
            var formData = new FormData(this);

            fetch('new_user.php', {
                method: 'POST',
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    var textoDiv = document.getElementById('texto');
                    if (data.status === 'success') {
                        textoDiv.textContent = data.message;
                        window.location.href = 'index.html'; // Redirect to index.html
                    } else {
                        textoDiv.textContent = data.message;
                    }
                })

        });
    }
</script>
</body>
</html>