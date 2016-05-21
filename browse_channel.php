<?php ob_start(); ?>
<?php session_start(); ?>
<?php include_once('parts/header.php'); ?>

<div class = 'container'>
	<div class ="row">
		<div class ="col-md-6">
			<h3>&nbsp;&nbsp;Browse Channel</h3>
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

$channel = browseChannel($_SESSION['id']);

if (mysqli_num_rows($channel) == 0){
	echo "<h3>You have no channels</h3>";
}

else{
	while($row = mysqli_fetch_object($channel)){
		$channelId[] = $row->channel_id;
		$channelName[] = $row->channel_name;
		$description[] = $row->channel_description;
		$createdBy[] = $row->user_id;
		$createdDate[] = $row->created_date; 
	}
	for ($i=0; $i<count($channelName); $i++){
		$details = userDetails($createdBy[$i]);
		echo "<form method = 'post'>
				<div class = 'row'>
					<div class = 'col-md-3'>
					</div>
					<div class = 'col-md-2'>
						<a href = 'session_set_channel.php?cid=$channelId[$i]'><img src = 'thumbnails/channel.png' class = 'img-responsive'></a>
					</div>
					<div class = 'col-md-4'>
						<a href = 'session_set_channel.php?cid=$channelId[$i]'>$channelName[$i]</a><br>
						Created By: $details[3]";echo " ";echo"$details[4]<br>
						Created On: $createdDate[$i]<br>
						Description: $description[$i]<br>
					</div>
					<div class = 'col-md-2'>";
					if($_SESSION['id']!=1){
					echo"<input type='checkbox' name='channelId[]' value='$channelId[$i]'/>";}
					echo"</div>
				</div><hr>";
	}
	echo "<div class = 'row'>
				<div class = 'col-md-3'>
				</div>
				<div class = 'col-md-2'>";
						if($_SESSION['id']!=1){
						echo"<input type = 'submit' value = 'Subscribe Channel' name = 'subscribe' class = 'btn btn-default'>";}
				echo"</div>
			</div>
		</form>";
}

echo "</div>";
echo  "<div class ='col-md-6'>"; 

if(isset($_POST['subscribe'])){
	$subscribe = $_POST['channelId'];
	for ($i=0; $i<count($subscribe); $i++){
		$subscriptionTest = activesubscription($subscribe[$i], $_SESSION['id']);
		if ($subscriptionTest){
			$check = createSubscription($subscribe[$i], $_SESSION['id']);
			if($check){
			echo "<br><h3>Channel Subscribed!!!</h3>";
		}
		}
		else{
			echo "<br><h3>You are already subscribed to this Channel</h3>";
		}
	}
}
echo "</div>";

?>
</div>
	</div>
</div>
<?php include_once('parts/footer.php'); ?>
       

