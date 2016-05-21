<?php ob_start(); ?>
<?php session_start(); ?>
<?php include_once 'parts/header.php'; ?>

<div class = 'container'>
	<div class ="row">
		<div class ="col-md-6">
			<h3>&nbsp;&nbsp;View Media</h3>
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

	if($_SESSION['id'] != 1){
		addView($_SESSION['mid']);
	}
	$result = mediaDetails($_SESSION['mid']);

	$details = mysqli_fetch_object($result);
	
	$mediaId = $details->media_id;
	$title = $details->title;
	$uploaderId = $details->user_id;
	$desc = $details->description;
	$category = $details->category;
	$extn = $details->file_extension;
	$uploadedDate = $details->upload_date;
	$path = $details->file_path;
	$channelId = $details->channel_id;

	$channelDetails = getChannel($channelId);

	while($row = mysqli_fetch_object($channelDetails)){
		$channelName = $row->channel_name;
	}

	$rating = getRating($_SESSION['mid']);
	$viewCount = viewCount($_SESSION['mid']);

	$commentDetails = getComment($_SESSION['mid']);

	if(mysqli_num_rows($commentDetails) !== 0){
		while($row = mysqli_fetch_object($commentDetails)){
			$user[] = $row->user_id;
			$comment[] = $row->comment;
		}
	}
	else{
		$comment = 0;
	}

	$ratingAccess = ratingAccess($_SESSION['id'], $_SESSION['mid']);
	$download = downloadAccess($_SESSION['id'], $_SESSION['mid']);
	$discussion = discussionAccess($_SESSION['id'], $_SESSION['mid']);

	if($category == 1){
		echo "<div class = 'row'>
				<div class = 'col-md-12'>
					<h3>$title</h3>
					<img src = '$path' height = '320px' width = '400px'><br>
					<a href='image_fullscreen.php'>Full Screen</a>
					<h5>Description: $desc</h5>
					<h5>Channel Name: $channelName</h5>";
					if($ratingAccess){
						echo "<h5>Current Rating: $rating</h5>";
					}
					echo "<h5>View Count: $viewCount</h5>
				</div>
			</div>";
		if($download){
			echo "<div class = 'row'>
					<div class = 'col-md-2'>
						<a class = 'btn btn-default' href='file_download.php?name=$path'>Download</a>
					</div>
					<div class = 'col-md-2'>
						<form method = 'post'>
							<div class='form-group'>
								<input type = 'submit' value = 'Favourites' name = 'favourites' class = 'btn btn-default'>
							</div>
						</form>
					</div>
					<div class = 'col-md-2'>
						<form method = 'post'>
							<div class='form-group'>
								<input type = 'submit' value = 'Block' name = 'block' class = 'btn btn-default'>
							</div>
						</form>
					</div>
					<div class = 'col-md-2'>
						<form method = 'post'>
							<div class='form-group'>
								<input type = 'submit' value = 'Subscribe' name = 'subscribe' class = 'btn btn-default'>
							</div>
						</form>
					</div>
					<div class = 'col-md-2'>
						<a class = 'btn btn-default' href='add_playlist.php?media=$mediaId'>Add to Playlist</a>
					</div>
				</div>";
		}
		else{
			echo "<div class = 'row'>
					<div class = 'col-md-3'>
						<form method = 'post'>
							<div class='form-group'>
								<input type = 'submit' value = 'Favourites' name = 'favourites' class = 'btn btn-default'>
							</div>
						</form>
					</div>
					<div class = 'col-md-3'>
						<form method = 'post'>
							<div class='form-group'>
								<input type = 'submit' value = 'Block' name = 'block' class = 'btn btn-default'>
							</div>
						</form>
					</div>
					<div class = 'col-md-3'>
						<form method = 'post'>
							<div class='form-group'>
								<input type = 'submit' value = 'Subscribe' name = 'subscribe' class = 'btn btn-default'>
							</div>
						</form>
					</div>
					<div class = 'col-md-3'>
						<a class = 'btn btn-default' href='add_playlist.php?media=$mediaId'>Add to Playlist</a>
					</div>
				</div>";
		}
			
		echo "<div class = 'row'>
				<div class = 'col-md-12'>";
		if($ratingAccess){
			echo"<form method = 'post'>
					<div class='form-group'>
						<select class = 'form-control' name = 'rating'>
							<option value = '1'>1</option>
							<option value = '2'>2</option>
							<option value = '3'>3</option>
							<option value = '4'>4</option>
							<option value = '5'>5</option>
						</select>				
						<br>
						<input type = 'submit' value = 'Rate' name = 'rate' class = 'btn btn-default'>
					</div>
				</form>";
		}
		if($discussion){
			echo "<form method = 'post'>
					<div class='form-group'>
						<textarea class='form-control' rows='5' name='comment' placeholder='Enter Comment Here!!!'></textarea>
						<br>
						<input type = 'submit' value = 'Comment' name = 'submit' class = 'btn btn-default'>
					</div>
				</form>";
		}
		if($comment != 0){
			echo"<br><div class='table-responsive'>          
					<table class='table'>
						<thead>
							<tr>
								<th>User</th>
								<th>Says</th>
							</tr>
						</thead>";
						for ($i=0; $i<count($user); $i++){
							$details = userDetails($user[$i]);
							echo "<tbody>
									<tr>
										<td>".$details[3]." ".$details[4]."</td>
										<td>$comment[$i]</td>
										<td>";
										if($user[$i] == $_SESSION['id']){
											echo "<a class = 'btn btn-default' href='remove_comment.php?comment=".$comment[$i]."'>Remove Comment</a>";
										}
								echo"	</td>
									</tr>
								</tbody>";
						}
		}
		echo"			</table>
					</div>
				</div>
			</div>";
	}

	elseif($category == 2){	
		echo "<div class = 'row'>
				<div class = 'col-md-12'>
					<h3>$title</h3>
					<audio controls>
						<source src= '$path' type = 'audio/$extn'>
					</audio><br>
					<h5>Description: $desc</h5>
					<h5>Channel Name: $channelName</h5>";
					if($ratingAccess){
						echo "<h5>Current Rating: $rating</h5>";
					}
					echo "<h5>View Count: $viewCount</h5>
				</div>
			</div>";
			
		if($download){
			echo "<div class = 'row'>
					<div class = 'col-md-2'>
						<a class = 'btn btn-default' href='file_download.php?name=$path'>Download</a>
					</div>
					<div class = 'col-md-2'>
						<form method = 'post'>
							<div class='form-group'>
								<input type = 'submit' value = 'Favourites' name = 'favourites' class = 'btn btn-default'>
							</div>
						</form>
					</div>
					<div class = 'col-md-2'>
						<form method = 'post'>
							<div class='form-group'>
								<input type = 'submit' value = 'Block' name = 'block' class = 'btn btn-default'>
							</div>
						</form>
					</div>
					<div class = 'col-md-2'>
						<form method = 'post'>
							<div class='form-group'>
								<input type = 'submit' value = 'Subscribe' name = 'subscribe' class = 'btn btn-default'>
							</div>
						</form>
					</div>
					<div class = 'col-md-2'>
						<a class = 'btn btn-default' href='add_playlist.php?media=$mediaId'>Add to Playlist</a>
					</div>
				</div>";
		}
		else{
			echo "<div class = 'row'>
					<div class = 'col-md-3'>
						<form method = 'post'>
							<div class='form-group'>
								<input type = 'submit' value = 'Favourites' name = 'favourites' class = 'btn btn-default'>
							</div>
						</form>
					</div>
					<div class = 'col-md-3'>
						<form method = 'post'>
							<div class='form-group'>
								<input type = 'submit' value = 'Block' name = 'block' class = 'btn btn-default'>
							</div>
						</form>
					</div>
					<div class = 'col-md-3'>
						<form method = 'post'>
							<div class='form-group'>
								<input type = 'submit' value = 'Subscribe' name = 'subscribe' class = 'btn btn-default'>
							</div>
						</form>
					</div>
					<div class = 'col-md-3'>
						<a class = 'btn btn-default' href='add_playlist.php?media=$mediaId'>Add to Playlist</a>
					</div>
				</div>";
		}
			
		echo "<div class = 'row'>
				<div class = 'col-md-12'>";
		if($ratingAccess){
			echo"<form method = 'post'>
					<div class='form-group'>
						<select class = 'form-control' name = 'rating'>
							<option value = '1'>1</option>
							<option value = '2'>2</option>
							<option value = '3'>3</option>
							<option value = '4'>4</option>
							<option value = '5'>5</option>
						</select>				
						<br>
						<input type = 'submit' value = 'Rate' name = 'rate' class = 'btn btn-default'>
					</div>
				</form>";
		}
		if($discussion){
			echo "<form method = 'post'>
					<div class='form-group'>
						<textarea class='form-control' rows='5' name='comment' placeholder='Enter Comment Here!!!'></textarea>
						<br>
						<input type = 'submit' value = 'Comment' name = 'submit' class = 'btn btn-default'>
					</div>
				</form>";
		}
		if($comment != 0){
			echo"<br><div class='table-striped'>          
					<table class='table'>
						<thead>
							<tr>
								<th>User</th>
								<th>Says</th>
							</tr>
						</thead>";
						for ($i=0; $i<count($user); $i++){
							$details = userDetails($user[$i]);
							echo "<tbody>
									<tr>
										<td>".$details[3]." ".$details[4]."</td>
										<td>$comment[$i]</td>";
										if($user[$i] == $_SESSION['id']){
											echo "<a class = 'btn btn-default' href='remove_comment.php?comment=".$comment[$i]."'>Remove Comment</a>";
										}
								echo"	</td>
									</tr>
								</tbody>";									
						}
		}
		echo"			</table>
					</div>
				</div>
			</div>";
	}

	elseif($category == 3){
		echo "<div class = 'row'>
				<div class = 'col-md-12'>
					<h3>$title</h3>
					<img src = '$path' height = '320px' width = '400px'><br>
					<h5>Description: $desc</h5>
					<h5>Channel Name: $channelName</h5>";
					if($ratingAccess){
						echo "<h5>Current Rating: $rating</h5>";
					}
					echo "<h5>View Count: $viewCount</h5>
				</div>
			</div>";
		if($download){
			echo "<div class = 'row'>
					<div class = 'col-md-2'>
						<a class = 'btn btn-default' href='file_download.php?name=$path'>Download</a>
					</div>
					<div class = 'col-md-2'>
						<form method = 'post'>
							<div class='form-group'>
								<input type = 'submit' value = 'Favourites' name = 'favourites' class = 'btn btn-default'>
							</div>
						</form>
					</div>
					<div class = 'col-md-2'>
						<form method = 'post'>
							<div class='form-group'>
								<input type = 'submit' value = 'Block' name = 'block' class = 'btn btn-default'>
							</div>
						</form>
					</div>
					<div class = 'col-md-2'>
						<form method = 'post'>
							<div class='form-group'>
								<input type = 'submit' value = 'Subscribe' name = 'subscribe' class = 'btn btn-default'>
							</div>
						</form>
					</div>
					<div class = 'col-md-2'>
						<a class = 'btn btn-default' href='add_playlist.php?media=$mediaId'>Add to Playlist</a>
					</div>
				</div>";
		}
		else{
			echo "<div class = 'row'>
					<div class = 'col-md-3'>
						<form method = 'post'>
							<div class='form-group'>
								<input type = 'submit' value = 'Favourites' name = 'favourites' class = 'btn btn-default'>
							</div>
						</form>
					</div>
					<div class = 'col-md-3'>
						<form method = 'post'>
							<div class='form-group'>
								<input type = 'submit' value = 'Block' name = 'block' class = 'btn btn-default'>
							</div>
						</form>
					</div>
					<div class = 'col-md-3'>
						<form method = 'post'>
							<div class='form-group'>
								<input type = 'submit' value = 'Subscribe' name = 'subscribe' class = 'btn btn-default'>
							</div>
						</form>
					</div>
					<div class = 'col-md-3'>
						<a class = 'btn btn-default' href='add_playlist.php?media=$mediaId'>Add to Playlist</a>
					</div>
				</div>";
		}
			
		echo "<div class = 'row'>
				<div class = 'col-md-12'>";
		if($ratingAccess){
			echo"<form method = 'post'>
					<div class='form-group'>
						<select class = 'form-control' name = 'rating'>
							<option value = '1'>1</option>
							<option value = '2'>2</option>
							<option value = '3'>3</option>
							<option value = '4'>4</option>
							<option value = '5'>5</option>
						</select>				
						<br>
						<input type = 'submit' value = 'Rate' name = 'rate' class = 'btn btn-default'>
					</div>
				</form>";
		}
		if($discussion){
			echo "<form method = 'post'>
					<div class='form-group'>
						<textarea class='form-control' rows='5' name='comment' placeholder='Enter Comment Here!!!'></textarea>
						<br>
						<input type = 'submit' value = 'Comment' name = 'submit' class = 'btn btn-default'>
					</div>
				</form>";
		}
		if($comment != 0){
			echo"<br><div class='table-striped'>          
					<table class='table'>
						<thead>
							<tr>
								<th>User</th>
								<th>Says</th>
							</tr>
						</thead>";
						for ($i=0; $i<count($user); $i++){
							$details = userDetails($user[$i]);
							echo "<tbody>
									<tr>
										<td>".$details[3]." ".$details[4]."</td>
										<td>$comment[$i]</td>";
										if($user[$i] == $_SESSION['id']){
											echo "<a class = 'btn btn-default' href='remove_comment.php?comment=".$comment[$i]."'>Remove Comment</a>";
										}
								echo"	</td>
									</tr>
								</tbody>";
						}
		}
		echo"			</table>
					</div>
				</div>
			</div>";
	}

	elseif($category == 4 or $category == 5 or $category == 6 or $category == 7 or $category == 8){
		echo "<div class = 'row'>
				<div class = 'col-md-12'>
					<h3>$title</h3>
					<video height = '240' width = '320' controls>
						<source src= '$path' type = 'video/$extn'>
					</video><br>
					<h5>Description: $desc</h5>
					<h5>Channel Name: $channelName</h5>";
					if($ratingAccess){
						echo "<h5>Current Rating: $rating</h5>";
					}
					echo "<h5>View Count: $viewCount</h5>
				</div>
			</div>";
		if($download){
			echo "<div class = 'row'>
					<div class = 'col-md-2'>
						<a class = 'btn btn-default' href='file_download.php?name=$path'>Download</a>
					</div>
					<div class = 'col-md-2'>
						<form method = 'post'>
							<div class='form-group'>
								<input type = 'submit' value = 'Favourites' name = 'favourites' class = 'btn btn-default'>
							</div>
						</form>
					</div>
					<div class = 'col-md-2'>
						<form method = 'post'>
							<div class='form-group'>
								<input type = 'submit' value = 'Block' name = 'block' class = 'btn btn-default'>
							</div>
						</form>
					</div>
					<div class = 'col-md-2'>
						<form method = 'post'>
							<div class='form-group'>
								<input type = 'submit' value = 'Subscribe' name = 'subscribe' class = 'btn btn-default'>
							</div>
						</form>
					</div>
					<div class = 'col-md-2'>
						<a class = 'btn btn-default' href='add_playlist.php?media=$mediaId'>Add to Playlist</a>
					</div>
				</div>";
		}
		else{
			echo "<div class = 'row'>
					<div class = 'col-md-3'>
						<form method = 'post'>
							<div class='form-group'>
								<input type = 'submit' value = 'Favourites' name = 'favourites' class = 'btn btn-default'>
							</div>
						</form>
					</div>
					<div class = 'col-md-3'>
						<form method = 'post'>
							<div class='form-group'>
								<input type = 'submit' value = 'Block' name = 'block' class = 'btn btn-default'>
							</div>
						</form>
					</div>
					<div class = 'col-md-3'>
						<form method = 'post'>
							<div class='form-group'>
								<input type = 'submit' value = 'Subscribe' name = 'subscribe' class = 'btn btn-default'>
							</div>
						</form>
					</div>
					<div class = 'col-md-3'>
						<a class = 'btn btn-default' href='add_playlist.php?media=$mediaId'>Add to Playlist</a>
					</div>
				</div>";
		}
			
		echo "<div class = 'row'>
				<div class = 'col-md-12'>";
		if($ratingAccess){
			echo"<form method = 'post'>
					<div class='form-group'>
						<select class = 'form-control' name = 'rating'>
							<option value = '1'>1</option>
							<option value = '2'>2</option>
							<option value = '3'>3</option>
							<option value = '4'>4</option>
							<option value = '5'>5</option>
						</select>				
						<br>
						<input type = 'submit' value = 'Rate' name = 'rate' class = 'btn btn-default'>
					</div>
				</form>";
		}
		if($discussion){
			echo "<form method = 'post'>
					<div class='form-group'>
						<textarea class='form-control' rows='5' name='comment' placeholder='Enter Comment Here!!!'></textarea>
						<br>
						<input type = 'submit' value = 'Comment' name = 'submit' class = 'btn btn-default'>
					</div>
				</form>";
		}
		if($comment != 0){
			echo"<br><div class='table-striped'>          
					<table class='table'>
						<thead>
							<tr>
								<th>User</th>
								<th>Says</th>
							</tr>
						</thead>";
						for ($i=0; $i<count($user); $i++){
							$details = userDetails($user[$i]);
							echo "<tbody>
									<tr>
										<td>".$details[3]." ".$details[4]."</td>
										<td>$comment[$i]</td>";
										if($user[$i] == $_SESSION['id']){
											echo "<a class = 'btn btn-default' href='remove_comment.php?comment=".$comment[$i]."'>Remove Comment</a>";
										}
								echo"	</td>
									</tr>
								</tbody>";
						}
		}
		echo"			</table>
					</div>
				</div>
			</div>";
	}

	if(isset($_POST['rate'])){
		if($_POST['rating'] != NULL){
			$check = addRating($_SESSION['mid'], $_SESSION['id'], $_POST['rating']);
			header ("Location: viewMedia.php");
		}
	}

	elseif(isset($_POST['submit'])){
		if($_POST['comment'] != NULL){
			$content = nl2br(htmlentities($_POST['comment'], ENT_QUOTES, 'UTF-8'));
			$check = addComment($_SESSION['mid'], $_SESSION['id'], $content);
			header ("Location: viewMedia.php");
		}
	}

	elseif(isset($_POST['subscribe'])){
		$subscriptionTest = activesubscription($channelId, $_SESSION['id']);
		if($subscriptionTest){
			$check = createSubscription($channelId, $_SESSION['id']);
			echo "<h3>Channel Subscribed</h3>";;
		}
		else{
			echo "<h3>Channel already subscribed</h3>";
		}
	}

	elseif(isset($_POST['favourites'])){
		$favourites = favourites($_SESSION['mid'], $_SESSION['id']);
		if($favourites){
			echo "<h3>Favourites Added</h3>";
		}
		else{
			echo "<h3>Already Favourite Media</h3>";
		}
	}

	elseif(isset($_POST['block'])){
		$block = blockMedia($_SESSION['mid'], $_SESSION['id']);
		if($block){
			echo "<h3>Media Blocked</h3>";
		}
	}
if($_SESSION['id'] != 1){
	$check = userHistory($_SESSION['id'], $category);
}
?>
</div>
	</div>
</div>
<?php include_once('parts/footer.php'); ?>