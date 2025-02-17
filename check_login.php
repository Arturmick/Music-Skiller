<?php
session_start();
$msg = isset($_SESSION['nick']);
echo json_encode(['loggedIn' => $msg]);
die();
?>