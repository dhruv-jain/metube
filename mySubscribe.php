<?php ob_start(); ?>
<?php session_start(); ?>
<?php include_once 'parts/header.php'; ?>

<div class = 'container'>
	<div class ="row">
		<div class ="col-md-6">
			<h3>&nbsp;&nbsp;My Subscribed Channel</h3>
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
$result = mySubscription($_SESSION['id']);

if($_SESSION['id'] == 1){
		echo "<h3>This is Guest Account. You don't have permission to view this page. Please Login or Register!!</h3>";
	}
else{
	if(mysqli_num_rows($result) == 0){
		echo "<h3>You don't have any Subscription!!</h3>";
	}
	else{
		
		while($row = mysqli_fetch_object($result)){
			$channelId[] = $row->channel_id;
			$channelName[] = $row->channel_name;
			$description[] = $row->channel_description;
			$createdBy[] = $row->user_id;
			$createdDate[] = $row->created_date;
			$subscribedDate[] = $row->subscribed_date;
		}
		
		for ($i=0; $i<count($channelId); $i++){
		$details = userDetails($createdBy[$i]);
		echo "<form method = 'post'>
				<div class = 'row'>
					<div class = 'col-md-3'>
					</div>
					<div class = 'col-md-2'>
						<a href = 'session_set_channel.php?cid=$channelId[$i]'><img src = 'thumbnails/channel.png' lass = 'img-responsive'></a>
					</div>
					<div class = 'col-md-4'>
						<a href = 'session_set_channel.php?cid=$channelId[$i]'>$channelName[$i]</a><br>
						Created By: $details[3]";echo " ";echo"$details[4]<br>
						Created On: $createdDate[$i]<br>
						Description: $description[$i]<br>
					</div>
					<div class = 'col-md-2'>
							<input type='checkbox' name='channelId[]' value='$channelId[$i]'/>
					</div>
				</div><hr>";
		}
		echo "<div class = 'row'>
					<div class = 'col-md-3'>
					</div>
					<div class = 'col-md-2'>
							<input type = 'submit' value = 'Remove Subscription' name = 'delete' class = 'btn btn-default'>
					</div>
			</div>
			</form>";
	}

	echo "</div>";

	if(isset($_POST['delete'])){
		$removeSubscription = $_POST['channelId'];
		for ($i=0; $i<count($removeSubscription); $i++){
			$check = deleteSubscription($removeSubscription[$i], $_SESSION['id']);
		}
		if($check){
			header ('Location: mySubscribe.php');
		}
	}
}
?>
</div>
	</div>
</div>
<?php include_once('parts/footer.php');
