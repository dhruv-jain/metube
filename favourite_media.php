<?php ob_start(); ?>
<?php session_start(); ?>
<?php include_once 'parts/header.php'; ?>

<div class = 'container'>
	<div class ="row">
		<div class ="col-md-6">
			<h3>&nbsp;&nbsp;Favourite Media</h3>
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

$media = getFavourites($_SESSION['id']);

if(mysqli_num_rows($media) == 0){
	echo "<h3>No Media</h3>";
}
else{
	while ($row = mysqli_fetch_object($media)){
		$mediaId[] = $row->media_id;
		$title[] = $row->title;
		$user[] = $row->user_id;
		$path[] = $row->file_path;
		$date[] = $row->upload_date;
		$desc[] = $row->description;
		$category[] = $row->category;
		$channel[] = $row->channel_id;
	}
	echo "<form method = 'post' id = 'abcd'>";
	for ($i=0; $i<count($path); $i++){
		$details = userDetails($user[$i]);
		$viewCount = viewCount($mediaId[$i]);
		$channelName = getChannelName($channel[$i]);
		if($category[$i] == 1 or $category[$i] == 3){
			
					echo"<div class = 'row'>
						<div class = 'col-md-3'>
						</div>
						<div class = 'col-md-2'>
							<a href = 'session_set.php?mid=$mediaId[$i]'><img src = 'thumbnails/image.png' class = 'img-responsive'></a>
						</div>
					<div class = 'col-md-4'>
						<a href = 'session_set.php?mid=$mediaId[$i]'>$title[$i]</a><br>
						Uploaded By: $details[3]";echo " ";echo"$details[4]<br>
						Uploaded On: $date[$i]<br>
						Description: $desc[$i]<br>
						Channel: $channelName<br>
						Views: $viewCount
					</div>
					<div class = 'col-md-2'>
						<input type='checkbox' name='mediaId[]' value='$mediaId[$i]' form = 'abcd'/>
					</div>
				</div><hr>";
		}
		elseif($category[$i] == 2){
			echo "<div class = 'row'>
					<div class = 'col-md-3'>
					</div>
					<div class = 'col-md-2'>
						<a href = 'session_set.php?mid=$mediaId[$i]'><img src = 'thumbnails/music.png' class = 'img-responsive'></a>
					</div>
					<div class = 'col-md-4'>
						<a href = 'session_set.php?mid=$mediaId[$i]'>$title[$i]</a><br>
						Uploaded By: $details[3]";echo " ";echo"$details[4]<br>
						Uploaded On: $date[$i]<br>
						Description: $desc[$i]<br>
						Channel: $channelName<br>
						Views: $viewCount
					</div>
					<div class = 'col-md-2'>
							<input type='checkbox' name='mediaId[]' value='$mediaId[$i]' form = 'abcd'/>
					</div>
				</div><hr>";
		}
		elseif($category[$i] == 4 or $category[$i] == 5 or $category[$i] == 6 or $category[$i] == 7 or $category[$i] == 8){
			echo "<div class = 'row'>
						<div class = 'col-md-3'>
						</div>
						<div class = 'col-md-2'>
							<a href = 'session_set.php?mid=$mediaId[$i]'><img src = 'thumbnails/video.png' class = 'img-responsive'></a>
						</div>
						<div class = 'col-md-4'>
							<a href = 'session_set.php?mid=$mediaId[$i]'>$title[$i]</a><br>
							Uploaded By: $details[3]";echo " ";echo"$details[4]<br>
							Uploaded On: $date[$i]<br>
							Description: $desc[$i]<br>
							Channel: $channelName<br>
							Views: $viewCount
						</div>
						<div class = 'col-md-2'>
							<input type='checkbox' name='mediaId[]' value='$mediaId[$i]' form = 'abcd'/>
						</div>
				</div><hr>";
		}
	}
	echo "<div class = 'row'>
				<div class = 'col-md-3'>
				</div>
				<div class = 'col-md-2'>
						<input type = 'submit' value = 'Remove Favourites' name = 'delete' class = 'btn btn-default'>
				</div>
		</form>";
}

if(isset($_POST['delete'])){
	
	$removeFavourites = $_POST['mediaId'];
	for ($i=0; $i<count($removeFavourites); $i++){
		$check = deleteFavourites($removeFavourites[$i], $_SESSION['id']);
	}
	if($check){
		header ('Location: favourite_media.php');
	}
}

?>

</div>
	</div>
</div>
<?php include_once('parts/footer.php'); ?>