<?php ob_start(); ?>
<?php session_start(); ?>
<?php include_once('parts/header.php'); ?>

<div class = 'container'>
	<div class ="row">
		<div class ="col-md-6">
			<h3>&nbsp;&nbsp;Compose</h3>
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
	$result = getContacts($_SESSION['id']);
	
	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
		foreach ($row as $column){
			$user[] = $column;
		}
	}
	
	echo "<div class = 'container'>
			<form method = 'post' id = 'messaging'>
				<div class='form-group'>
					<label>To:</label>
					<select class = 'form-control' name = 'to'>";
						for($i = 0; $i<count($user); $i++){
							$userid = userId($user[$i]);
							echo $userid;
							echo "<option value = '$userid'>$user[$i]</option>";
						}
	echo "			</select>
				</div>
					<div class='form-group'>
						<label>Message:</label>
						<textarea class='form-control' rows='5' name='message' placeholder='Send Message' form = 'messaging'></textarea>
						<br>
						<input type = 'submit' value = 'Send Message' name = 'submit' class = 'btn btn-default'>
					</div>
				</form>
				";
	
	if(isset($_POST['submit'])){
		$content = nl2br(htmlentities($_POST['message'], ENT_QUOTES, 'UTF-8'));
		$send = sendMessage($content, $_SESSION['id'], $_POST['to']);
		if($send){
			echo "<h3>Message Sent</h3>";
		}
	}
}

?>

</div>
	</div>
</div>
<?php include_once('parts/footer.php'); ?>