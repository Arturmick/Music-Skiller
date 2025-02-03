<?php
session_start();

$id = isset($_GET['id']) ? $_GET['id'] : null;
$nivel = isset($_GET['nivel']) ? $_GET['nivel'] : null;
$ejercicio = isset($_GET['ejercicio']) ? $_GET['ejercicio'] : null;
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
		<div>CONOCENOS</div>
		<div>SERVICIOS</div>
		<div>PORFOLIO</div>
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
<div class="tituloSelector">
	<img src="imagenes/trombon.png" alt="">
	<div id="instrumento"></div>
</div>
<div class="selectorEjercicio">
	<div class="selectores ejercicios">
		<div id="escalas">Escalas</div>
		<div id="arpegios">Arpegios</div>
		<div id="picado">Picado</div>
		<div id="ligado">Ligado</div>
		<div id="trino">Trino</div>
		<div id="agudos">Agudos</div>
		<div id="grvaes">Graves</div>
		<div id="flexibilidad">Flexibilidad</div>
	</div>
	<div id='nivel' class="selectores">
		<div id="do">DO</div>
		<div id="fa">Fa</div>
		<div id="Sib">Sib</div>
        <div id="do">DO</div>
        <div id="fa">Fa</div>
        <div id="Sib">Sib</div>
	</div>
	<div id="ejercicios">
		<img src="<?php echo htmlspecialchars($id); ?>" alt=""<img src="<?php echo htmlspecialchars($id); ?>" alt="<?php echo htmlspecialchars($nivel . ' ' . $ejercicio); ?>">>
	</div>
</div>
</body>
</html>