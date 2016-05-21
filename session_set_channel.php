<?php ob_start(); ?>
<?php session_start(); ?>
<?php

$_SESSION['cid'] = $_GET['cid'];

header("Location: channel_media.php");

?>
