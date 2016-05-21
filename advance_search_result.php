<?php ob_start(); ?>
<?php session_start(); ?>
<?php include_once('parts/header.php'); ?>

<div class = 'container'>
	<div class ="row">
		<div class ="col-md-6">
			<h3>&nbsp;&nbsp;Advance Search Result</h3>
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
	
	if($_POST['title'] == NULL and $_POST['description'] == NULL and $_POST['extension'] == NULL
		and $_POST['channel'] == NULL and $_POST['uploadedBy'] == NULL and $_POST['date'] == NULL and $_POST['keyword'] == NULL){
			echo "<h3>Enter atleast one field</h3>";
		}
	else{
		
		$media = advanceSearch($_POST['title'], $_POST['description'], $_POST['extension'], $_POST['channel'],
		$_POST['uploadedBy'], $_POST['date'], $_POST['keyword'], $_SESSION['id']);
		
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
					$extn[] = $row->file_extension;
				}

				for ($i=0; $i<count($path); $i++){
					$details = userDetails($user[$i]);
					$viewCount = viewCount($mediaId[$i]);
					$channelName = getChannelName($channel[$i]);
					if($category[$i] == 1 or $category[$i] == 3){
						echo "<div class = 'row'>
								<div class = 'col-md-3'>
								</div>
								<div class = 'col-md-1'>
									<a href = 'session_set.php?mid=$mediaId[$i]'><img src = 'thumbnails/image.png' class = 'img-responsive'></a>
								</div>
								<div class = 'col-md-8'>
									<a href = 'session_set.php?mid=$mediaId[$i]'>$title[$i]</a><br>
									Uploaded By: $details[3]";echo " ";echo"$details[4]<br>
									Uploaded On: $date[$i]<br>
									Description: $desc[$i]<br>
									Channel: $channelName<br>
									Views: $viewCount
								</div>
							</div><hr>";
					}
					elseif($category[$i] == 2){
						echo "<div class = 'row'>
								<div class = 'col-md-3'>
								</div>
								<div class = 'col-md-1'>
									<a href = 'session_set.php?mid=$mediaId[$i]'><img src = 'thumbnails/music.png' class = 'img-responsive'></a>
								</div>
								<div class = 'col-md-8'>
									<a href = 'session_set.php?mid=$mediaId[$i]'>$title[$i]</a><br>
									Uploaded By: $details[3]";echo " ";echo"$details[4]<br>
									Uploaded On: $date[$i]<br>
									Description: $desc[$i]<br>
									Channel: $channelName<br>
									Views: $viewCount
								</div>
							</div><hr>";
					}
					elseif($category[$i] == 4 or $category[$i] == 5 or $category[$i] == 6 or $category[$i] == 7 or $category[$i] == 8){
						echo "<div class = 'row'>
								<div class = 'col-md-3'>
								</div>
								<div class = 'col-md-1'>
									<a href = 'session_set.php?mid=$mediaId[$i]'><img src = 'thumbnails/video.png' class = 'img-responsive'></a>
								</div>
								<div class = 'col-md-8'>
									<a href = 'session_set.php?mid=$mediaId[$i]'>$title[$i]</a><br>
									Uploaded By: $details[3]";echo " ";echo"$details[4]<br>
									Uploaded On: $date[$i]<br>
									Description: $desc[$i]<br>
									Channel: $channelName<br>
									Views: $viewCount
								</div>
							</div><hr>";
					}
				}
			}
		
	}	
?>
</div>
	</div>
</div>
<?php include_once('parts/footer.php'); ?>