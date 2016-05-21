<?php ob_start(); ?>
<?php session_start(); ?>
<?php

$_SESSION['pid'] = $_GET['pid'];

header("Location: playlist_media.php");

?>
