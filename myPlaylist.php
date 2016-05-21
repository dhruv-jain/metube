<?php ob_start(); ?>
<?php session_start(); ?>
<?php include_once 'parts/header.php'; ?>

<div class = 'container'>
	<div class ="row">
		<div class ="col-md-6">
			<h3>&nbsp;&nbsp;My Playlist</h3>
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
$result = myPlaylist($_SESSION['id']);

if($_SESSION['id'] == 1){
		echo "<h3>This is Guest Account. You don't have permission to view this page. Please Login or Register!!</h3>";
	}
else{
	if(mysqli_num_rows($result) == 0){
		echo "<h3>You don't have any Playlist!!</h3>";
	}
	else{
		
		while($row = mysqli_fetch_object($result)){
			$playlistId[] = $row->playlist_id;
			$playlistName[] = $row->playlist_name;
			$description[] = $row->playlist_description;
			$createdDate[] = $row->created_date;
		}
		
		for ($i=0; $i<count($playlistId); $i++){

		echo "<form method = 'post'>
				<div class = 'row'>
					<div class = 'col-md-3'>
					</div>
					<div class = 'col-md-2'>
						<a href = 'session_set_playlist.php?pid=$playlistId[$i]'><img src = 'thumbnails/channel.png' lass = 'img-responsive'></a>
					</div>
					<div class = 'col-md-4'>
						<a href = 'session_set_playlist.php?pid=$playlistId[$i]'>$playlistName[$i]</a><br>
						Created On: $createdDate[$i]<br>
						Description: $description[$i]<br>
					</div>
					<div class = 'col-md-2'>
							<input type='checkbox' name='playlistId[]' value='$playlistId[$i]'/>
					</div>
				</div><hr>";
		}
		echo "<div class = 'row'>
					<div class = 'col-md-3'>
					</div>
					<div class = 'col-md-2'>
							<input type = 'submit' value = 'Delete Playlist' name = 'delete' class = 'btn btn-default'>
					</div>
			</div>
			</form>";
	}

	echo "</div>";

	if(isset($_POST['delete'])){
		$delete = $_POST['playlistId'];
		for ($i=0; $i<count($delete); $i++){
			$check = deletePlaylist($delete[$i], $_SESSION['id']);
		}
		if($check){
			header ('Location: myPlaylist.php');
		}
	}
}
?>
</div>
	</div>
</div>
<?php include_once('parts/footer.php'); ?>
