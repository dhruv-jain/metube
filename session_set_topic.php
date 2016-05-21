<?php ob_start(); ?>
<?php session_start(); ?>
<?php

$_SESSION['tid'] = $_GET['tid'];

header("Location: topic_details.php");

?>