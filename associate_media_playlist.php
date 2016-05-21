<?php ob_start(); ?>
<?php session_start(); ?>
<?php include_once('parts/header.php'); ?>
<div class = 'container'>
	<div class ="row">
		<div class ="col-md-6">
			<h3>&nbsp;&nbsp;Associate Media to Playlist</h3>
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
			$playlist = getPlaylist($_SESSION['id']);
			if(mysqli_num_rows($playlist) == 0){
				echo "<h3>You don't have any Playlist. Create a Playlist First</h3>";
			}
			else{
				while ($row = mysqli_fetch_object($playlist)){
					$playlistId[] = $row->playlist_id;
					$playlistName[] = $row ->playlist_name;
				}
				$media = getMedia($_SESSION['id']);
					if(mysqli_num_rows($media) == 0){
						echo "<h3>No Media</h3>";
					}
					else{
						echo "<form method = 'post'>";
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
											<div class = 'col-md-2'>
												<a href = 'session_set.php?mid=$mediaId[$i]'><img src = 'thumbnails/image.png' class = 'img-responsive'></a>
											</div>
											<div class = 'col-md-5'>
												<a href = 'session_set.php?mid=$mediaId[$i]'>$title[$i]</a><br>
												Uploaded By: $details[3]";echo " ";echo"$details[4]<br>
												Uploaded On: $date[$i]<br>
												Description: $desc[$i]<br>
												Channel: $channelName<br>
												Views: $viewCount
											</div>
											<div class = 'col-md-2'>
												<input type='checkbox' name='mediaId[]' value='$mediaId[$i]'/>
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
										<div class = 'col-md-5'>
											<a href = 'session_set.php?mid=$mediaId[$i]'>$title[$i]</a><br>
											Uploaded By: $details[3]";echo " ";echo"$details[4]<br>
											Uploaded On: $date[$i]<br>
											Description: $desc[$i]<br>
											Channel: $channelName<br>
											Views: $viewCount
										</div>
										<div class = 'col-md-2'>
												<input type='checkbox' name='mediaId[]' value='$mediaId[$i]'/>
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
										<div class = 'col-md-5'>
											<a href = 'session_set.php?mid=$mediaId[$i]'>$title[$i]</a><br>
											Uploaded By: $details[3]";echo " ";echo"$details[4]<br>
											Uploaded On: $date[$i]<br>
											Description: $desc[$i]<br>
											Channel: $channelName<br>
											Views: $viewCount
										</div>
										<div class = 'col-md-2'>
												<input type='checkbox' name='mediaId[]' value='$mediaId[$i]'/>
										</div>
									</div><hr>";
							}				
						}
						
						echo "<div class = 'row'>
									<div class = 'col-md-3'>
									</div>
									<div class='form-group'>
										<label>Select Playlist</label>
										<select class = 'form-control' name = 'list'>"; 
											for($i = 0; $i<count($playlistId); $i++){
												echo "<option value = '$playlistId[$i]'>$playlistName[$i]</option>";
											}
						echo"			</select>
									</div>";
						
						echo "<div class = 'row'>
									<div class = 'col-md-3'>
									</div>
									<div class = 'col-md-2'>
										<input type = 'submit' value = 'Add to Playlist' name = 'submit' class = 'btn btn-default'>
									</div>
								</div>
						</form>";
					}
			}
									
			if(isset($_POST['submit'])){
				
				for($i = 0; $i<count($_POST['mediaId']); $i++){
					$add = addPlaylistMedia($_POST['list'], $_POST['mediaId'][$i]);
				}
				if($add){
					echo "<h3>Media added to Playlist</h3>";
				}
			}
			
			echo "</div>";
	
		
		?>
</div>
	</div>
</div>
<?php include_once('parts/footer.php'); ?>