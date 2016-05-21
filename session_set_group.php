<?php ob_start(); ?>
<?php session_start(); ?>
<?php

$_SESSION['gid'] = $_GET['gid'];

header("Location: group_details.php");

?>
