<?php ob_start(); ?>
<?php session_start(); ?>
<?php include_once('parts/header.php'); ?>

<div class = 'container'>
	<div class ="row">
		<div class ="col-md-6">
			<h3>&nbsp;&nbsp;Create Playlist</h3>
		</div>
	</div>    
    <div class ="row">
        <div class ="col-md-3"> 
            <?php include_once('parts/sidebar.php'); ?>
        </div>
        <div class ="col-md-1"> 
        </div>
        <div class ="col-md-8">



<?php

if($_SESSION['id'] == 1){
	echo "<h3>This is Guest Account. You don't have permission to view this page. Please Login or Register!!</h3>";
}
else{
	echo "<form method = 'post' id = 'playlist'>

		<div class='form-group'>
			<label>Playlist Name</label>
			<input type='text' name = 'name' class='form-control' id='' placeholder='Name' required>
		</div>
		<div class='form-group'>
			<label>Descrption</label>
			<textarea class='form-control' rows='5' name='desc' placeholder='Enter Playlist Description!!!' form ='playlist'></textarea>
		</div>
		
		<input type = 'submit' value = 'Create Playlist' name = 'submit' class = 'btn btn-default'>
		
		</form>
		";
	if(isset($_POST['submit'])){
		$description = nl2br(htmlentities($_POST['desc'], ENT_QUOTES, 'UTF-8'));
		$check = createPlaylist($_POST['name'], $description, $_SESSION['id']);
		if($check){
			header ("Location: myPlaylist.php");		
		}
	}
}
?>
</div>
	</div>
</div>
<?php include_once('parts/footer.php'); ?>
