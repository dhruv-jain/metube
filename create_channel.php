<?php ob_start(); ?>
<?php session_start(); ?>
<?php include_once('parts/header.php'); ?>

<div class = 'container'>
	<div class ="row">
		<div class ="col-md-6">
			<h3>&nbsp;&nbsp;Create Channel</h3>
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
	echo "<form method = 'post' id = 'channel'>

		<div class='form-group'>
			<label>Channel Name</label>
			<input type='text' name = 'name' class='form-control' id='' placeholder='Name' required>
		</div>
		<div class='form-group'>
			<label>Descrption</label>
			<textarea class='form-control' rows='5' name='desc' placeholder='Enter Channel Description!!!' form ='channel'></textarea>
		</div>
		
		<input type = 'submit' value = 'Create Channel' name = 'submit' class = 'btn btn-default'>
		
		</form>
		";
	if(isset($_POST['submit'])){
		$description = nl2br(htmlentities($_POST['desc'], ENT_QUOTES, 'UTF-8'));
		$check = createChannel($_POST['name'], $description, $_SESSION['id']);
		if($check){
			header("Location: browse_channel.php");		
		}
	}

	echo "</div>";
}
?>
</div>
	</div>
</div>
<?php include_once('parts/footer.php'); ?>
