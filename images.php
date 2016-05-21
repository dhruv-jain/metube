<?php ob_start(); ?>
<?php session_start(); ?>
<?php include_once('parts/header.php'); ?>



<div class = 'container'>
	<div class ="row">
		<div class ="col-md-6">
			<h3>&nbsp;&nbsp;Images</h3>
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
        
$media = getImages($_SESSION['id']);

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
	}

	for ($i=0; $i<count($path); $i++){
		$userName = getUserName($user[$i]);
		$viewCount = viewCount($mediaId[$i]);
		echo "<div class = 'row'>
					<div class = 'col-md-3'>
					</div>
					<div class = 'col-md-1'>
						<a href = 'session_set.php?mid=$mediaId[$i]'><img src = 'thumbnails/image.png' class = 'img-responsive'></a>
					</div>
					<div class = 'col-md-8'>
						<a href = 'session_set.php?mid=$mediaId[$i]'>$title[$i]</a><br>
						Uploaded By: $userName<br>
						Uploaded On: $date[$i]<br>
						Description: $desc[$i]<br>
						Views: $viewCount
					</div>
				</div><hr>";
	}
}

?>
</div>
	</div>
</div>
<?php include_once('parts/footer.php'); ?>
