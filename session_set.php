<?php ob_start(); ?>
<?php session_start(); ?>
<?php

$_SESSION['mid'] = $_GET['mid'];

header("Location: viewMedia.php");

?>
