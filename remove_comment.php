<?php ob_start(); ?>
<?php session_start(); ?>
<?php include_once('parts/header.php'); ?>

<?php

$comment = $_GET['comment'];

$check = deleteComment($comment, $_SESSION['id']);

if($check){
	header ("Location: viewMedia.php");
}

?>