<?php ob_start(); ?>
<?php session_start(); ?>
<?php include_once 'parts/header.php'; ?>

<div class = 'container'>
	<div class ="row">
		<div class ="col-md-6">
			<h3>&nbsp;&nbsp;Playlist Media</h3>
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

echo"<div class = 'container'>";
	
$playlistMedia = playlistMedia($_SESSION['pid']);

if (mysqli_num_rows($playlistMedia) == 0){
	echo "<h3>There are no media associated with this Playlist</h3>";
}

else{
	while($row = mysqli_fetch_object($playlistMedia)){
		$mediaId[] = $row->media_id;
		$title[] = $row->title;
		$user[] = $row->user_id;
		$path[] = $row->file_path;
		$date[] = $row->upload_date;
		$desc[] = $row->description;
		$category[] = $row->category; 
	}
	echo "<form method = 'post' id='remove'>";
	for ($i=0; $i<count($path); $i++){
		$userName = getUserName($user[$i]);
		$viewCount = viewCount($mediaId[$i]);
		if($category[$i] == 1 or $category[$i] == 3){
					echo "<div class = 'row'>
					<div class = 'col-md-3'>
					</div>
					<div class = 'col-md-2'>
						<a href = 'session_set.php?mid=$mediaId[$i]'><img src = 'thumbnails/image.png' class = 'img-responsive'></a>
					</div>
					<div class = 'col-md-4'>
						<a href = 'session_set.php?mid=$mediaId[$i]'>$title[$i]</a><br>
						Uploaded By: $userName<br>
						Uploaded On: $date[$i]<br>
						Description: $desc[$i]<br>
						Views: $viewCount
					</div>
					<div class = 'col-md-2'>
							<input type='checkbox' name='mediaId[]' value='$mediaId[$i]' form = 'remove'/>
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
						Uploaded By: $userName<br>
						Uploaded On: $date[$i]<br>
						Description: $desc[$i]<br>
						Views: $viewCount
					</div>
					<div class = 'col-md-2'>
							<input type='checkbox' name='mediaId[]' value='$mediaId[$i]' form = 'remove'/>
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
						Uploaded By: $userName<br>
						Uploaded On: $date[$i]<br>
						Description: $desc[$i]<br>
						Views: $viewCount
					</div>
					<div class = 'col-md-2'>
							<input type='checkbox' name='mediaId[]' value='$mediaId[$i]' form = 'remove'/>
					</div>
				</div><hr>";
		}
	}
	echo "		<div class = 'row'>
				<div class = 'col-md-3'>
				</div>
				<div class = 'col-md-2'>
						<input type = 'submit' value = 'Remove Media' name = 'remove' class = 'btn btn-default'>
				</div>
			</div>
		</form>";
}

if(isset($_POST['remove'])){
	$remove = $_POST['mediaId'];
	
	for ($i=0; $i<count($remove); $i++){
		$check = removePlaylistMedia($_SESSION['pid'], $remove[$i]);
	}
	if($check){
		header ('Location: playlist_media.php');
	}
}

?>
</div>
	</div>
</div>
<?php include_once('parts/footer.php'); ?>
