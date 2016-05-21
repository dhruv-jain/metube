<?php ob_start(); ?>
<?php session_start(); ?>
<?php include_once('parts/header.php'); ?>
<div class = 'container'>
	<div class ="row">
		<div class ="col-md-6">
			<h3>&nbsp;&nbsp;Add Playlist</h3>
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
	$mediaId = $_GET['media'];
	
	$playlist = getPlaylist($_SESSION['id']);
	if(mysqli_num_rows($playlist) == 0){
		echo "<h3>You don't have any Playlist. Create a Playlist First</h3>";
	}
	else{
		while ($row = mysqli_fetch_object($playlist)){
		$playlistId[] = $row->playlist_id;
		$playlistName[] = $row ->playlist_name;
		}
	
		echo "<form method = 'post'>
				<div class='form-group'>
					<label>Select Playlist</label>
						<select class = 'form-control' name = 'list'>"; 
							for($i = 0; $i<count($playlistId); $i++){
								echo "<option value = '$playlistId[$i]'>$playlistName[$i]</option>";
							}
		echo"			</select>
				</div>";
		echo "	<div class = 'form-group'>
					<input type = 'submit' value = 'Add to Playlist' name = 'submit' class = 'btn btn-default'>
				</div>
			</form>";
	}
	if(isset($_POST['submit'])){
		$check = playlistMediaCheck($mediaId, $_POST['list']);
		if($check){
			$add = addPlaylistMedia($_POST['list'], $mediaId);
			if($add){
				echo "<h3>Media added to Playlist</h3>";
			}
		}
		else{
			echo "<h3>Media already added to Playlist</h3>";
		}
	}
?>

</div>
	</div>
</div>
<?php include_once('parts/footer.php'); ?>