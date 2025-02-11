<?php
session_start();

$imagenGrande = isset($_GET['imagenGrande']) ? $_GET['imagenGrande'] : null;
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
<div class="tituloSelector">
	<img src="imagenes/trombon.png" alt="">
	<div id="instrumento"><div id="instrumento"><?php echo htmlspecialchars($nivel . ' ' . $ejercicio); ?></div></div>
</div>
<div class="selectorTonalidad">
	<div class="selectores tonalidad">
		<div id="do">Do</div>
		<div id="fa">Fa</div>
		<div id="Sib">Sib</div>
        <div id=mib>Mib</div>
        <div id="lab">Lab</div>
        <div id="reb">Reb</div>
        <div id="solb">Solb</div>
        <div id="dob">Dob</div>
        <div id="sol">Sol</div>
        <div id="re">Re</div>
        <div id="la">La</div>
        <div id="mi">Mi</div>
        <div id="si">Si</div>
        <div id="fa#">Fa#</div>
        <div id="do#">Do#</div>
	</div>
</div>
<div id="partitura">
    <img src="<?php echo htmlspecialchars($imagenGrande); ?>" alt="" <img src="<?php echo htmlspecialchars($imagenGrande); ?>" alt="<?php echo htmlspecialchars($nivel . ' ' . $ejercicio); ?>">
</div>
<div class="controles">
    <div id="play">
        <img src="imagenes/jugar.png" alt="Play">
    </div>
</div>
</body>
</html>