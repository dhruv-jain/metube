<?php

function connect(){
	include 'config.php';
	$link = mysqli_connect($db_host, $db_user, $db_password, $db_database);
	
	if(!$link){
		die("Failed to connect to MySQL: " . mysqli_connect_error());
	}
	return $link;
}

function registrationValidation($username, $password, $first_name, $last_name, $dob, $sex, $email, $phone){
	$conn = connect();
	$query1 = "SELECT * FROM user WHERE user_name = '$username'";
	$result1 = mysqli_query($conn, $query1);
	$query2 = "SELECT * FROM user WHERE email = '$email'";
	$result2 = mysqli_query($conn, $query2);
	$query3 = "SELECT * FROM user WHERE phone = '$phone'";
	$result3 = mysqli_query($conn, $query3);
	if (!$result1){
		die ("Query Failed: ".mysqli_error($conn));
	}
	elseif (!$result2){
		die ("Query Failed: ".mysqli_error($conn));
	}
	else{
		$count1 = mysqli_num_rows($result1);
		$count2 = mysqli_num_rows($result2);
		$count3 = mysqli_num_rows($result3);
		if($count1!=0){
			echo "<h3>Username already registered. Try Login instead</h3>";
			return false;
		}
		elseif($count2!=0){
			echo "<h3>EMail already registered. Try Login instead</h3>";
			return false;
		}
		elseif($count3 != 0){
			echo "<h3>Phone Number already registered. Try Login instead</h3>";
			return false;
		}
		else{
			$query3 = "INSERT INTO user VALUES (default, '$username', 'password','$first_name', 
							'$last_name','$dob', '$sex', '$email', '$phone')";
			$result3 = mysqli_query ($conn, $query3);
			if(!$result3){
				die ("Query Failed: ".mysqli_error($conn));
			}
			else{
				return true;
			}
		}
	}
	mysqli_free_result($result1);
	mysqli_free_result($result2);
	mysqli_free_result($result3);
	mysqli_close($conn);
}

function userValidation($credential, $password){
	$conn = connect();
	$query = "SELECT * FROM user WHERE user_name = '$credential' 
				or email = '$credential' or phone = '$credential'";
	$result = mysqli_query($conn, $query);
	if (!$result){
		die ("Query Failed: ".mysqli_error($conn));
	}
	else{
		$value = mysqli_fetch_row ($result);
		if($value[2] != $password){
			return false;
		}
		else{
			$_SESSION['id'] = $value[0];
			return true;
		}			
	}
	mysqli_free_result($result);
	mysqli_close($conn);	
}

function guest(){
	$conn = connect();
	$query = "SELECT * FROM user WHERE user_name = 'guest'";
	$result = mysqli_query($conn, $query);
	if (!$result){
		die ("Query Failed: ".mysqli_error($conn));
	}
	else{
		$value = mysqli_fetch_row ($result);
		$_SESSION['id'] = $value[0];
		return $value[1];
	}
	mysqli_free_result($result);
	mysqli_close($conn);	
}

function forgotPassword($credential){
	$conn = connect();
	$query = "SELECT password, email FROM user WHERE user_name = '$credential' 
				or email = '$credential' or phone = '$credential'";
	$result = mysqli_query($conn, $query);
	if (!$result){
		die ("Query Failed: ".mysqli_error($conn));
	}
	else{
		$value = mysqli_fetch_row ($result);
		return $value;
	}
	mysqli_free_result($result);
	mysqli_close($conn);
}

function userDetails($userid){
	$conn = connect();
	$query = "SELECT * FROM user WHERE user_id= $userid";
	$result = mysqli_query($conn, $query);
	if (!$result){
		die ("Query Failed: ".mysqli_error($conn));
	}
	else{
		$value = mysqli_fetch_row($result);
		return $value;
	}
	mysqli_free_result($result);
	mysqli_close($conn);
}

function getUserName($userid){
	$conn = connect();
	$query = "SELECT concat(first_name, last_name) as name FROM user WHERE user_id= $userid";
	$result = mysqli_query($conn, $query);
	if (!$result){
		die ("Query Failed: ".mysqli_error($conn));
	}
	else{
		$value = mysqli_fetch_object($result);
		return $value->name;
	}
	mysqli_free_result($result);
	mysqli_close($conn);
}

function userId($username){
	$conn = connect();
	$query = "SELECT user_id FROM user WHERE user_name= '$username'";
	$result = mysqli_query($conn, $query);
	if (!$result){
		die ("Query Failed: ".mysqli_error($conn));
	}
	else{
		$value = mysqli_fetch_object($result);
		$userId = $value->user_id;
		return $userId;
	}
	mysqli_free_result($result);
	mysqli_close($conn);
}

function accountEdit($userid, $username, $password, $first_name, $last_name, $dob, $sex, $email, $phone){
	echo $userid."<br>".$username."<br>".$password."<br>".$first_name."<br>".$last_name."<br>".$dob."<br>".$sex."<br>".$email."<br>".$phone;
	$conn = connect();
	if($username != NULL){
		$query1 = "UPDATE user SET user_name = '$username' WHERE user_id = $userid";
		$result1 = mysqli_query($conn,$query1);
		if (!$result1){
		die ("Query Failed: ".mysqli_error($conn));
		}
		else{
			return true;
		}
	}
	if($password != NULL){
		$query2 = "UPDATE user SET password = '$password' WHERE user_id = $userid";
		$result2 = mysqli_query($conn,$query2);
		if (!$result2){
		die ("Query Failed: ".mysqli_error($conn));
		}
		else{
			return true;
		}
	}
	if($first_name != NULL){
		$query3 = "UPDATE user SET first_name = '$first_name' WHERE user_id = $userid";
		$result3 = mysqli_query($conn,$query3);
		if (!$result3){
		die ("Query Failed: ".mysqli_error($conn));
		}
		else{
			return true;
		}
	}
	if($last_name != NULL){
		$query4 = "UPDATE user SET last_name = '$lat_name' WHERE user_id = $userid";
		$result4 = mysqli_query($conn,$query4);
		if (!$result4){
		die ("Query Failed: ".mysqli_error($conn));
		}
		else{
			return true;
		}
	}
	if($dob != NULL){
		$query5 = "UPDATE user SET dob = '$dob' WHERE user_id = $userid";
		$result5 = mysqli_query($conn,$query5);
		if (!$result5){
		die ("Query Failed: ".mysqli_error($conn));
		}
		else{
			return true;
		}
	}
	if($sex != NULL){
		$query6 = "UPDATE user SET sex = '$sex' WHERE user_id = $userid";
		$result6 = mysqli_query($conn,$query6);
		if (!$result6){
		die ("Query Failed: ".mysqli_error($conn));
		}
		else{
			return true;
		}
	}
	if($email != NULL){
		$query7 = "UPDATE user SET email = '$email' WHERE user_id = $userid";
		$result7 = mysqli_query($conn,$query7);
		if (!$result7){
		die ("Query Failed: ".mysqli_error($conn));
		}
		else{
			return true;
		}
	}
	if($phone != NULL){
		$query8 = "UPDATE user SET phone = '$phone' WHERE user_id = $userid";
		$result8 = mysqli_query($conn,$query8);
		if (!$result8){
		die ("Query Failed: ".mysqli_error($conn));
		}
		else{
			return true;
		}
	}
	mysqli_close($conn);
}

function accountDelete($userid){
	$conn = connect();
	$query = "DELETE FROM user WHERE user_id = $userid";
	$result = mysqli_query($conn, $query);
	if(!$result){
		die ("Query Failed: ".mysqli_error($conn));
	}
	else{
		return true;
	}
	mysqli_close($conn);
}

function allUsers($userid){
	$conn = connect();
	$query = "SELECT user_name FROM user WHERE user_id != $userid 
				and user_id NOT IN (SELECT user_id FROM user WHERE user_id = 1)
				and user_id NOT IN (SELECT user_id1 from blocked where user_id2 = '$userid')				
				and user_id NOT IN (SELECT user_id2 from blocked where user_id1 = '$userid')
				and user_id NOT IN (SELECT user_id2 from contacts where user_id1 = '$userid')	
				and user_id NOT IN (SELECT user_id2 from friends where user_id1 = '$userid')
				ORDER BY user_id";	
	$result = mysqli_query($conn,$query);
	if(!$result){
		die("Query Failed: ".mysqli_error($conn));
	}
	else{
		return $result;
	}
	mysqli_free_result($result);
	mysqli_close($conn);
}

function myContacts($userid){
	$conn = connect();
	$query = "SELECT user_name FROM user WHERE user_id IN 
				(SELECT user_id2 from contacts WHERE user_id1 = $userid) ORDER BY user_id";
	$result = mysqli_query($conn,$query);
	if(!$result){
		die("Query Failed: ".mysqli_error($conn));
	}
	else{
		return $result;
	}
	mysqli_free_result($result);
	mysqli_close($conn);
}

function myFriends($userid){
	$conn = connect();
	$query = "SELECT user_name FROM user WHERE user_id IN 
				(SELECT user_id2 from friends WHERE user_id1 = $userid) ORDER BY user_id";
	$result = mysqli_query($conn,$query);
	if(!$result){
		die("Query Failed: ".mysqli_error($conn));
	}
	else{
		return $result;
	}
	mysqli_free_result($result);
	mysqli_close($conn);
}

function myBlockedContact($userid){
	$conn = connect();
	$query = "SELECT user_name FROM user WHERE user_id IN 
				(SELECT user_id2 from blocked WHERE user_id1 = $userid) ORDER BY user_id";
	$result = mysqli_query($conn,$query);
	if(!$result){
		die("Query Failed: ".mysqli_error($conn));
	}
	else{
		return $result;
	}
	mysqli_free_result($result);
	mysqli_close($conn);
}

function addContacts($userid1, $userid2){
	$conn = connect();
	$query = "INSERT INTO contacts VALUES (default,$userid1, $userid2)";
	$result = mysqli_query($conn, $query);
	if(!$result){
		die ("Query Failed: ".mysqli_error($conn));
	}
	else{
			return true;
	}
	mysqli_free_result($result);
	mysqli_close($conn);
}

function addFriends($userid1, $userid2){
	$conn = connect();
	$query = "INSERT INTO friends VALUES (default, $userid1, $userid2)";
	$result = mysqli_query($conn, $query);
	if(!$result){
		die ("Query Failed: ".mysqli_error($conn));
	}
	else{
			return true;
	}
	mysqli_free_result($result);
	mysqli_close($conn);
}

function blockUser($userid1, $userid2){
	$conn = connect();
	$query = "INSERT INTO blocked VALUES (default, $userid1, $userid2)";
	$result = mysqli_query($conn, $query);
	if(!$result){
		die ("Query Failed: ".mysqli_error($conn));
	}
	else{
			return true;
	}
	mysqli_free_result($result);
	mysqli_close($conn);
}

function removeFriends($userid1, $userid2){
	$conn = connect();
	$query = "DELETE FROM friends WHERE user_id1 = $userid1 and user_id2 = $userid2";
	$result = mysqli_query($conn, $query);
	if(!$result){
		die ("Query Failed: ".mysqli_error($conn));
	}
	else{
		return true;
	}
	mysqli_free_result($result);
	mysqli_close($conn);
}

function removeContacts($userid1, $userid2){
	$conn = connect();
	$query = "DELETE FROM contacts WHERE user_id1 = $userid1 and user_id2 = $userid2";
	$result = mysqli_query($conn, $query);
	if(!$result){
		die ("Query Failed: ".mysqli_error($conn));
	}
	else{
			return true;
	}
	mysqli_free_result($result);
	mysqli_close($conn);
}

function removeBlock($userid1, $userid2){
	$conn = connect();
	$query = "DELETE FROM blocked WHERE user_id1 = $userid1 and user_id2 = $userid2";
	$result = mysqli_query($conn, $query);
	if(!$result){
		die ("Query Failed: ".mysqli_error($conn));
	}
	else{
		return true;
	}
	mysqli_free_result($result);
	mysqli_close($conn);
}

function mediaUpload ($userid, $title, $description, $category, $keywords, $filename, $extension, $shareAccess, $downloadAccess, $ratingAccess, $discussionAccess, $path, $channelid){	
	$conn = connect();
	$query = "INSERT INTO media VALUES (default, $userid, '$title', '$description', $category, '$keywords', '$filename', '$extension', $shareAccess, $downloadAccess, $ratingAccess, $discussionAccess, '$path', CURRENT_TIMESTAMP, $channelid)";
	$result = mysqli_query($conn, $query);
	if(!$result){
		die ("Query Failed: ".mysqli_error($conn));
	}
	else{
		return true;
	}
	mysqli_free_result($result);
	mysqli_close($conn);
}

function friendCheck ($userid){
	$conn = connect();
	$query = "SELECT user_id2 FROM friends WHERE user_id1 = $userid";
	$result = mysqli_query($conn, $query);
	if(!$result){
		die ("Query Failed: ".mysqli_error($conn));
	}
	else{
		$count = mysqli_num_rows($result);
		if($count != 0){
			return true;
		}
		else{
			return false;
		}
	}
	mysqli_free_result($result);
	mysqli_close($conn);
}

function mediaDetails($mediaId){	
	$conn = connect();
	$query = "SELECT * FROM media WHERE media_id = $mediaId";
	$result = mysqli_query($conn, $query);
	if(!$result){
		die ("Query Failed: ".mysqli_error($conn));
	}
	else{
		return $result;
	}
	mysqli_free_result($result);
	mysqli_close($conn);
}

function getMedia($userid){	
	$conn = connect();
	$username = getUserName($userid);
	$query1 = "SELECT * FROM usermedia_$username WHERE 
				media_id NOT IN (SELECT media_id FROM blockedmedia WHERE user_id = $userid)";
	$result1 = mysqli_query($conn, $query1);
	if(!$result1){
		$query2 = "CREATE VIEW usermedia_$username AS
				(SELECT * from media where file_share_access = '1' or user_id = $userid) 
				UNION 
				(SELECT * FROM media WHERE user_id IN (SELECT user_id2 from friends where user_id1 = $userid) and file_share_access = 2)";
		$result2 = mysqli_query($conn, $query2);
		if(!$result2){
			die ("Query Failed: ".mysqli_error($conn));
		}
		else{
			$query3 = "SELECT * FROM usermedia_$username WHERE 
						media_id NOT IN (SELECT media_id FROM blockedmedia WHERE user_id = $userid)";
			$result3 = mysqli_query($conn, $query3);
			if(!$result3){
				die ("Query Failed: ".mysqli_error($conn));
			}
			else{
				return $result3;
			}
		}
	}
	else{
		return $result1;
	}
	mysqli_free_result($result1);
	mysqli_free_result($result2);
	mysqli_free_result($result3);
	mysqli_close($conn);
}

function getImages($userid){	
	$conn = connect();
	$username = getUserName($userid);
	$query = "SELECT * FROM usermedia_$username WHERE category = 1
				AND media_id NOT IN (SELECT media_id FROM blockedmedia WHERE user_id = $userid)";
	$result = mysqli_query($conn, $query);
	if(!$result){
		die ("Query Failed: ".mysqli_error($conn));
	}
	else{
		return $result;
	}
	mysqli_free_result($result);
	mysqli_close($conn);
}

function getAudios($userid){	
	$conn = connect();
	$username = getUserName($userid);
	$query = "SELECT * FROM usermedia_$username WHERE category = 2 
				AND media_id NOT IN (SELECT media_id FROM blockedmedia WHERE user_id = $userid)";
	$result = mysqli_query($conn, $query);
	if(!$result){
		die ("Query Failed: ".mysqli_error($conn));
	}
	else{
		return $result;
	}
	mysqli_free_result($result);
	mysqli_close($conn);
}

function getGraphics($userid){	
	$conn = connect();
	$username = getUserName($userid);
	$query = "SELECT * FROM usermedia_$username WHERE category = 3
				AND media_id NOT IN (SELECT media_id FROM blockedmedia WHERE user_id = $userid)";
	$result = mysqli_query($conn, $query);
	if(!$result){
		die ("Query Failed: ".mysqli_error($conn));
	}
	else{
		return $result;
	}
	mysqli_free_result($result);
	mysqli_close($conn);
}

function getShows($userid){	
	$conn = connect();
	$username = getUserName($userid);
	$query = "SELECT * FROM usermedia_$username WHERE category = 4	
				AND media_id NOT IN (SELECT media_id FROM blockedmedia WHERE user_id = $userid)";
	$result = mysqli_query($conn, $query);
	if(!$result){
		die ("Query Failed: ".mysqli_error($conn));
	}
	else{
		return $result;
	}
	mysqli_free_result($result);
	mysqli_close($conn);
}

function getMovies($userid){	
	$conn = connect();
	$username = getUserName($userid);
	$query = "SELECT * FROM usermedia_$username WHERE category = 5
				AND media_id NOT IN (SELECT media_id FROM blockedmedia WHERE user_id = $userid)";
	$result = mysqli_query($conn, $query);
	if(!$result){
		die ("Query Failed: ".mysqli_error($conn));
	}
	else{
		return $result;
	}
	mysqli_free_result($result);
	mysqli_close($conn);
}

function getSports($userid){	
	$conn = connect();
	$username = getUserName($userid);
	$query = "SELECT * FROM usermedia_$username WHERE category = 6
				AND media_id NOT IN (SELECT media_id FROM blockedmedia WHERE user_id = $userid)";
	$result = mysqli_query($conn, $query);
	if(!$result){
		die ("Query Failed: ".mysqli_error($conn));
	}
	else{
		return $result;
	}
	mysqli_free_result($result);
	mysqli_close($conn);
}

function getNews($userid){	
	$conn = connect();
	$username = getUserName($userid);
	$query = "SELECT * FROM usermedia_$username WHERE category = 7
				AND media_id NOT IN (SELECT media_id FROM blockedmedia WHERE user_id = $userid)";
	$result = mysqli_query($conn, $query);
	if(!$result){
		die ("Query Failed: ".mysqli_error($conn));
	}
	else{
		return $result;
	}
	mysqli_free_result($result);
	mysqli_close($conn);
}

function getOthers($userid){	
	$conn = connect();
	$username = getUserName($userid);
	$query = "SELECT * FROM usermedia_$username WHERE category = 8
				AND media_id NOT IN (SELECT media_id FROM blockedmedia WHERE user_id = $userid)";
	$result = mysqli_query($conn, $query);
	if(!$result){
		die ("Query Failed: ".mysqli_error($conn));
	}
	else{
		return $result;
	}
	mysqli_free_result($result);
	mysqli_close($conn);
}

function viewCount($mediaid){
	$conn = connect();
	$query = "SELECT viewcount FROM mediaview WHERE media_id = $mediaid";
	$result = mysqli_query($conn, $query);
	$rows = mysqli_num_rows($result);
	if(!$result){
		die ("Query Failed: ".mysqli_error($conn));
	}
	elseif($rows == 0){
		return $rows;
	}
	else{
		$value = mysqli_fetch_object($result);
		$count = $value->viewcount;
		return $count;
	}
}

function addView($mediaid){
	$conn = connect();
	$query = "SELECT view_id FROM mediaview WHERE media_id = $mediaid";
	$result = mysqli_query($conn,$query);
	if(!$result){
		die ("Query Failed: ".mysqli_error($conn));
	}
	elseif (mysqli_num_rows($result) == 0){
		$query2 = "INSERT INTO mediaview VALUES (default, $mediaid, 1)";
		$result2 = mysqli_query($conn, $query2);
		if(!$result){
		die ("Query Failed: ".mysqli_error($conn));
		}
	}
	else {		
		$query3 = "SELECT viewcount FROM mediaview WHERE media_id = $mediaid";
		$result3 = mysqli_query($conn, $query3);
		if(!$result){
			die ("Query Failed: ".mysqli_error($conn));
		}
		else{
			$value = mysqli_fetch_object($result3);
			$viewCount = $value->viewcount;
			$newViewcount = $viewCount + 1;
			$query4 = "UPDATE mediaview SET viewcount = $newViewcount WHERE media_id = $mediaid";
			$result4 = mysqli_query($conn, $query4);
			if(!$result){
			die ("Query Failed: ".mysqli_error($conn));
			}
		}
	}
}

function ratingAccess($userid, $mediaid){
	$conn = connect();
	$username = getUserName($userid);
	$query = "SELECT rating FROM usermedia_$username WHERE media_id = $mediaid";
	$result = mysqli_query($conn, $query);
	if(!$result){
		die ("Query Failed: ".mysqli_error($conn));
	}
	else{
		$value = mysqli_fetch_object($result);
		return $value->rating;
	}
}

function discussionAccess($userid, $mediaid){
	$conn = connect();
	$username = getUserName($userid);
	$query = "SELECT discussion FROM usermedia_$username WHERE media_id = $mediaid";
	$result = mysqli_query($conn, $query);
	if(!$result){
		die ("Query Failed: ".mysqli_error($conn));
	}
	else{
		$value = mysqli_fetch_object($result);
		return $value->discussion;
	}
}

function downloadAccess($userid, $mediaid){
	$conn = connect();
	$username = getUserName($userid);
	$query = "SELECT download FROM usermedia_$username WHERE media_id = $mediaid";
	$result = mysqli_query($conn, $query);
	if(!$result){
		die ("Query Failed: ".mysqli_error($conn));
	}
	else{
		$value = mysqli_fetch_object($result);
		return $value->download;
	}
}

function addRating($mediaid, $userid, $rating){
	$conn = connect();
	$query = "INSERT INTO mediarating VALUES (default, $mediaid, $userid, $rating)";
	$result = mysqli_query($conn, $query);
	if(!$result){
		die ("Query Failed: ".mysqli_error($conn));
	}
	else{
		return true;
	}
}

function addComment($mediaid, $userid, $comment){
	$conn = connect();
	$query = "INSERT INTO mediacomment VALUES (default, $mediaid, $userid, '$comment')";
	$result = mysqli_query($conn, $query);
	if(!$result){
		die ("Query Failed: ".mysqli_error($conn));
	}
	else{
		return true;
	}
}

function getRating($mediaid){
	$conn = connect();
	$query = "SELECT avg(rating) as currentRating FROM mediarating WHERE media_id = $mediaid GROUP BY media_id";
	$result = mysqli_query($conn, $query);
	if(!$result){
		die ("Query Failed: ".mysqli_error($conn));
	}
	else{
		if(mysqli_num_rows($result) == 0){
			return 0;
		}
		else{
			$value = mysqli_fetch_object($result);
			return $value->currentRating;
		}		
	}
}

function getComment($mediaid){
	$conn = connect();
	$query = "SELECT user_id, comment FROM mediacomment WHERE media_id = $mediaid";
	$result = mysqli_query($conn, $query);
	if(!$result){
		die ("Query Failed: ".mysqli_error($conn));
	}
	else{
		return $result;	
	}
}

function sendMessage($message, $userid1, $userid2){
	$conn = connect();
	$query = "INSERT INTO messages VALUES (default, '$message', $userid1, $userid2, CURRENT_TIMESTAMP)";
	$result = mysqli_query($conn, $query);
	if(!$result){
		die ("Query Failed: ".mysqli_error($conn));
	}
	else{
			return true;
	}
	mysqli_free_result($result);
	mysqli_close($conn);
}

function getMessage($userid){
	$conn = connect();
	$query = "SELECT * FROM messages WHERE user_id2 = $userid ORDER BY date desc";
	$result = mysqli_query($conn, $query);
	if(!$result){
		die ("Query Failed: ".mysqli_error($conn));
	}
	else{
			return $result;
	}
	mysqli_free_result($result);
	mysqli_close($conn);
}

function createChannel($name, $description, $userid){
	$conn = connect();
	$query = "INSERT INTO channel VALUES (default, '$name', '$description', $userid, CURRENT_TIMESTAMP)";
	$result = mysqli_query($conn, $query);
	if(!$result){
		die ("Query Failed: ".mysqli_error($conn));
	}
	else{
		return true;
	}
	mysqli_free_result($result);
	mysqli_close($conn);
}

function browseChannel($userid){
	$conn = connect();
	$query = "SELECT * FROM channel";
	$result = mysqli_query($conn, $query);
	if(!$result){
		die ("Query Failed: ".mysqli_error($conn));
	}
	else{
		return $result;
	}
	mysqli_free_result($result);
	mysqli_close($conn);
}

function channelMedia($channelId){
	$conn = connect();
	$query = "SELECT * FROM media WHERE channel_id = $channelId";
	$result = mysqli_query($conn, $query);
	if(!$result){
		die ("Query Failed: ".mysqli_error($conn));
	}
	else{
		return $result;
	}
	mysqli_free_result($result);
	mysqli_close($conn);
}

function getChannelName($channelId){
	$conn = connect();
	$query = "SELECT channel_name FROM channel WHERE channel_id = $channelId";
	$result = mysqli_query($conn, $query);
	if(!$result){
		die ("Query Failed: ".mysqli_error($conn));
	}
	else{
		if(mysqli_num_rows($result)!=0){
			$value = mysqli_fetch_object($result);
			$name = $value->channel_name;
			return $name;
		}
	}
	mysqli_free_result($result);
	mysqli_close($conn);
}

function channelExistCheck($userId){
	$conn = connect();
	$query = "SELECT channel_id FROM channel WHERE user_id = $userId";
	$result = mysqli_query($conn, $query);
	if(!$result){
		die ("Query Failed: ".mysqli_error($conn));
	}
	else{
		if(mysqli_num_rows($result) == 0){
			return false;
		}
		else{
			return true;
		}
	}
	mysqli_free_result($result);
	mysqli_close($conn);
}

function myChannel($userId){
	$conn = connect();
	$query = "SELECT * FROM channel WHERE user_id = $userId";
	$result = mysqli_query($conn, $query);
	if(!$result){
		die ("Query Failed: ".mysqli_error($conn));
	}
	else{
		return $result;
	}
	mysqli_free_result($result);
	mysqli_close($conn);
}

function deleteChannel($channelid){
	$conn = connect();
	$query = "DELETE FROM channel WHERE channel_id = $channelid";
	$result = mysqli_query($conn, $query);
	if(!$result){
		die ("Query Failed: ".mysqli_error($conn));
	}
	else{
		$query2 = "DELETE FROM media WHERE channel_id = $channelid";
		$result2 = mysqli_query($conn, $query2);
		if(!$result){
		die ("Query Failed: ".mysqli_error($conn));
		}
		else{
			return true;
		}
	}
	mysqli_free_result($result);
	mysqli_close($conn);
}

function createSubscription($channelid, $userid){
	$conn = connect();
	$query = "INSERT INTO subscriptions VALUES (default, $channelid, $userid, CURRENT_TIMESTAMP)";
	$result = mysqli_query($conn, $query);
	if(!$result){
		die ("Query Failed: ".mysqli_error($conn));
	}
	else{
		return true;
	}
	mysqli_free_result($result);
	mysqli_close($conn);
}

function mySubscription($userId){
	$conn = connect();
	$query = "SELECT s.channel_id, c.channel_name, c.channel_description, c.user_id, c.created_date, 			s.subscribed_date 
				FROM channel c
				INNER JOIN subscriptions s 
				ON c.channel_id = s.channel_id
				WHERE s.user_id = $userId";
	$result = mysqli_query($conn, $query);
	if(!$result){
		die ("Query Failed: ".mysqli_error($conn));
	}
	else{
		return $result;
	}
	mysqli_free_result($result);
	mysqli_close($conn);
}

function getChannel($channelId){
	$conn = connect();
	$query = "SELECT * FROM channel WHERE channel_id = $channelId";
	$result = mysqli_query($conn, $query);
	if(!$result){
		die ("Query Failed: ".mysqli_error($conn));
	}
	else{
		return $result;
	}
	mysqli_free_result($result);
	mysqli_close($conn);
}

function deleteSubscription($channelid, $userid){
	$conn = connect();
	$query = "DELETE FROM subscriptions WHERE channel_id = $channelid and user_id = $userid";
	$result = mysqli_query($conn, $query);
	if(!$result){
		die ("Query Failed: ".mysqli_error($conn));
	}
	else{
		return true;
	}
	mysqli_free_result($result);
	mysqli_close($conn);
}

function activesubscription($channelid, $userid){
	$conn = connect();
	$query = "SELECT * FROM subscriptions WHERE channel_id = $channelid and user_id = $userid";
	$result = mysqli_query($conn, $query);
	if(!$result){
		die ("Query Failed: ".mysqli_error($conn));
	}
	else{
		if(mysqli_num_rows($result) == 0){
			return true;
		}
		else{
			return false;
		}
	}
	mysqli_free_result($result);
	mysqli_close($conn);
}

function favourites($mediaid, $userid){
	$conn = connect();
	$query = "SELECT * FROM favourites WHERE media_id = $mediaid and user_id = $userid";
	$result = mysqli_query($conn, $query);
	if(!$result){
		die ("Query Failed: ".mysqli_error($conn));
	}
	else{
		if(mysqli_num_rows($result) == 0){
			$query2 = "INSERT INTO favourites VALUES (default, $mediaid, $userid)";
			$result2 = mysqli_query($conn, $query2);
			if(!$result2){
				die ("Query Failed: ".mysqli_error($conn));
			}
			else{
				return true;
			}
		}
		else{
			return false;
		}
	}
	mysqli_free_result($result);
	mysqli_free_result($result2);
	mysqli_close($conn);
}

function blockMedia($mediaid, $userid){
	$conn = connect();
	$query = "SELECT * FROM blockedmedia WHERE media_id = $mediaid and user_id = $userid";
	$result = mysqli_query($conn, $query);
	if(!$result){
		die ("Query Failed: ".mysqli_error($conn));
	}
	else{
		if(mysqli_num_rows($result) == 0){
			$query2 = "INSERT INTO blockedmedia VALUES (default, $mediaid, $userid)";
			$result2 = mysqli_query($conn, $query2);
			if(!$result2){
				die ("Query Failed: ".mysqli_error($conn));
			}
			else{
				return true;
			}
		}
		else{
			return false;
		}
	}
	mysqli_free_result($result);
	mysqli_free_result($result2);
	mysqli_close($conn);
}

function getFavourites($userid){	
	$conn = connect();
	$query = "SELECT f.media_id, m.title, m.user_id, m.file_path, m.upload_date,
				m.description, m.category, m.channel_id 
				FROM favourites f
				INNER JOIN media m 
				ON m.media_id = f.media_id
				WHERE f.user_id = $userid ";
	$result = mysqli_query($conn, $query);
	if(!$result){
		die ("Query Failed: ".mysqli_error($conn));
	}
	else{
		return $result;
	}
	mysqli_free_result($result);
	mysqli_close($conn);
}

function getBlockedMedia($userid){	
	$conn = connect();
	$query = "SELECT f.media_id, m.title, m.user_id, m.file_path, m.upload_date,
				m.description, m.category, m.channel_id 
				FROM blockedmedia f
				INNER JOIN media m 
				ON m.media_id = f.media_id
				WHERE f.user_id = $userid ";
	$result = mysqli_query($conn, $query);
	if(!$result){
		die ("Query Failed: ".mysqli_error($conn));
	}
	else{
		return $result;
	}
	mysqli_free_result($result);
	mysqli_close($conn);
}

function deleteFavourites($mediaid, $userid){
	$conn = connect();
	$query = "DELETE FROM favourites WHERE media_id = $mediaid and user_id = $userid";
	$result = mysqli_query($conn, $query);
	if(!$result){
		die ("Query Failed: ".mysqli_error($conn));
	}
	else{
		return true;
	}
	mysqli_free_result($result);
	mysqli_close($conn);
}

function deleteBlock($mediaid, $userid){
	$conn = connect();
	$query = "DELETE FROM blockedmedia WHERE media_id = $mediaid and user_id = $userid";
	$result = mysqli_query($conn, $query);
	if(!$result){
		die ("Query Failed: ".mysqli_error($conn));
	}
	else{
		return true;
	}
	mysqli_free_result($result);
	mysqli_close($conn);
}

function getMostViewed($userid){	
	$conn = connect();
	$username = getUserName($userid);
	$query = "SELECT v.media_id, m.title, m.user_id, m.file_path, m.upload_date,
				m.description, m.category, m.channel_id 
				FROM mediaview v
				INNER JOIN usermedia_$username m 
				ON m.media_id = v.media_id
				ORDER BY v.viewcount desc";
	$result = mysqli_query($conn, $query);
	if(!$result){
		die ("Query Failed: ".mysqli_error($conn));
	}
	else{
		return $result;
	}
	mysqli_free_result($result);
	mysqli_close($conn);
}

function getRecentlyUploaded($userid){	
	$conn = connect();
	$username = getUserName($userid);
	$query = "SELECT * FROM usermedia_$username ORDER BY upload_date desc";
	$result = mysqli_query($conn, $query);
	if(!$result){
		die ("Query Failed: ".mysqli_error($conn));
	}
	else{
		return $result;
	}
	mysqli_free_result($result);
	mysqli_close($conn);
}

function deleteComment($comment, $userid){
	$conn = connect();
	$query = "DELETE FROM mediacomment WHERE user_id = $userid and comment = '$comment'";
	$result = mysqli_query($conn, $query);
	if(!$result){
		die ("Query Failed: ".mysqli_error($conn));
	}
	else{
		return true;
	}
	mysqli_free_result($result);
	mysqli_close($conn);
}

function search($key, $userid){
	$conn = connect();
	$username = getUserName($userid);
	
	$query1 = "SELECT media_id FROM usermedia_$username WHERE title LIKE '%$key%'";
	$result1 = mysqli_query($conn, $query1);	
	if(!$result1){
		die ("Query1 Failed: ".mysqli_error($conn));
	}
	else{
		if(mysqli_num_rows($result1) != 0){
			while($row = mysqli_fetch_object($result1)){
				$mediaId[] = $row->media_id;			
			}
		}
	}
	
	$query2 = "SELECT media_id FROM usermedia_$username WHERE description LIKE '%$key%'";
	$result2 = mysqli_query($conn, $query2);	
	if(!$result2){
		die ("Query2 Failed: ".mysqli_error($conn));
	}
	else{
		if(mysqli_num_rows($result2) != 0){
			while($row = mysqli_fetch_object($result2)){
				$mediaId[] = $row->media_id;
			}
		}
	}
	
	$query3 = "SELECT media_id FROM usermedia_$username WHERE file_extension LIKE '%$key%'";
	$result3 = mysqli_query($conn, $query3);	
	if(!$result3){
		die ("Query3 Failed: ".mysqli_error($conn));
	}
	else{
		if(mysqli_num_rows($result3) != 0){
			while($row = mysqli_fetch_object($result3)){
				$mediaId[] = $row->media_id;
			}
		}
	}

	$query4 = "SELECT media_id FROM usermedia_$username WHERE channel_id IN 
				(SELECT channel_id FROM channel WHERE channel_name LIKE '%$key%')";
	$result4 = mysqli_query($conn, $query4);	
	if(!$result4){
		die ("Query4 Failed: ".mysqli_error($conn));
	}
	else{
		if(mysqli_num_rows($result4) != 0){
			while($row = mysqli_fetch_object($result4)){
				$mediaId[] = $row->media_id;
			}
		}
	}
	
	$query5 = "SELECT media_id FROM usermedia_$username WHERE user_id IN 
				(SELECT user_id FROM user WHERE user_name LIKE '%$key%')";
	$result5 = mysqli_query($conn, $query5);	
	if(!$result5){
		die ("Query5 Failed: ".mysqli_error($conn));
	}
	else{
		if(mysqli_num_rows($result5) != 0){
			while($row = mysqli_fetch_object($result5)){
				$mediaId[] = $row->media_id;
			}
		}
	}

	$query6 = "SELECT media_id FROM usermedia_$username WHERE upload_date LIKE '%$key%'";
	$result6 = mysqli_query($conn, $query6);	
	if(!$result6){
		die ("Query6 Failed: ".mysqli_error($conn));
	}
	else{
		if(mysqli_num_rows($result6) != 0){
			while($row = mysqli_fetch_object($result6)){
				$mediaId[] = $row->media_id;
			}
		}
	}
	
	$query7 = "SELECT media_id FROM usermedia_$username WHERE keywords LIKE '%$key%'";
	$result7 = mysqli_query($conn, $query7);	
	if(!$result7){
		die ("Query7 Failed: ".mysqli_error($conn));
	}
	else{
		if(mysqli_num_rows($result7) != 0){
			while($row = mysqli_fetch_object($result7)){
				$mediaId[] = $row->media_id;
			}
		}
	}
	
	$uniqueMediaId = array_unique($mediaId);	
	$ids = join(',',$uniqueMediaId);
	
	$query = "SELECT * FROM usermedia_$username WHERE media_id IN ($ids)";
	$result = mysqli_query($conn, $query);	
	if(!$result){
		die ("Query Failed: ".mysqli_error($conn));
	}
	else{
		return $result;
	}
	mysqli_free_result($result);
	mysqli_close($conn);
}

function advanceSearch($title, $description, $file_extension, $channelName, $userName, $date, $keyword, $userid){
	$conn = connect();
	$username = getUserName($userid);
	
	if($title != NULL){
		if($description != NULL){
			if($file_extension != NULL){
				if($channelName != NULL){
					if($userName != NULL){
						if($keyword != NULL){
							if($date != NULL){
								$query = "SELECT * FROM usermedia_$username WHERE title LIKE '%$title%'
											AND description like '%$description%'
											AND file_extension like '%$file_extension%'
											AND channel_id IN (SELECT channel_id FROM channel WHERE channel_name LIKE '%$channelName%')
											AND user_id IN (SELECT user_id FROM user WHERE user_name LIKE '%$userName%')
											AND keywords like '%$keyword%'
											AND upload_date like '%$date%'";
								$result = mysqli_query($conn, $query);
								if(!$result){
									die ("Query Failed: ".mysqli_error($conn));
								}
								else{
									return $result;
								}
							}
							else{
								$query = "SELECT * FROM usermedia_$username WHERE title LIKE '%$title%'
											AND description like '%$description%'
											AND file_extension like '%$file_extension%'
											AND channel_id IN (SELECT channel_id FROM channel WHERE channel_name LIKE '%$channelName%')
											AND user_id IN (SELECT user_id FROM user WHERE user_name LIKE '%$userName%')
											AND keywords like '%$keyword%'";
								$result = mysqli_query($conn, $query);
								if(!$result){
									die ("query Failed: ".mysqli_error($conn));
								}
								else{
									return $result;
								}
							}
						}
						else{
							$query = "SELECT * FROM usermedia_$username WHERE title LIKE '%$title%'
											AND description like '%$description%'
											AND file_extension like '%$file_extension%'
											AND channel_id IN (SELECT channel_id FROM channel WHERE channel_name LIKE '%$channelName%')
											AND user_id IN (SELECT user_id FROM user WHERE user_name LIKE '%$userName%')";
								$result = mysqli_query($conn, $query);
								if(!$result){
									die ("query Failed: ".mysqli_error($conn));
								}
								else{
									return $result;
								}
						}
					}
					else{
						$query = "SELECT * FROM usermedia_$username WHERE title LIKE '%$title%'
											AND description like '%$description%'
											AND file_extension like '%$file_extension%'
											AND channel_id IN (SELECT channel_id FROM channel WHERE channel_name LIKE '%$channelName%')";
								$result = mysqli_query($conn, $query);
								if(!$result){
									die ("query Failed: ".mysqli_error($conn));
								}
								else{
									return $result;
								}
					}
				}
				else{
					$query = "SELECT * FROM usermedia_$username WHERE title LIKE '%$title%'
											AND description like '%$description%'
											AND file_extension like '%$file_extension%'";
								$result = mysqli_query($conn, $query);
								if(!$result){
									die ("query Failed: ".mysqli_error($conn));
								}
								else{
									return $result;
								}
				}
			}
			else{
				$query = "SELECT * FROM usermedia_$username WHERE title LIKE '%$title%'
											AND description like '%$description%'";
								$result = mysqli_query($conn, $query);
								if(!$result){
									die ("query Failed: ".mysqli_error($conn));
								}
								else{
									return $result;
								}
			}
		}
		else{
			$query = "SELECT * FROM usermedia_$username WHERE title LIKE '%$title%'";
								$result = mysqli_query($conn, $query);
								if(!$result){
									die ("query Failed: ".mysqli_error($conn));
								}
								else{
									return $result;
								}
		}
	}
	else{
		if($description != NULL){
			if($file_extension != NULL){
				if($channelName != NULL){
					if($userName != NULL){
						if($keyword != NULL){
							if($date != NULL){
								$query = "SELECT * FROM usermedia_$username WHERE
												description like '%$description%'
											AND file_extension like '%$file_extension%'
											AND channel_id IN (SELECT channel_id FROM channel WHERE channel_name LIKE '%$channelName%')
											AND user_id IN (SELECT user_id FROM user WHERE user_name LIKE '%$userName%')
											AND keywords like '%$keyword%'
											AND upload_date like '%$date%'";
								$result = mysqli_query($conn, $query);
								if(!$result){
									die ("query Failed: ".mysqli_error($conn));
								}
								else{
									return $result;
								}
							}
							else{
								$query = "SELECT * FROM usermedia_$username WHERE
												description like '%$description%'
											AND file_extension like '%$file_extension%'
											AND channel_id IN (SELECT channel_id FROM channel WHERE channel_name LIKE '%$channelName%')
											AND user_id IN (SELECT user_id FROM user WHERE user_name LIKE '%$userName%')
											AND keywords like '%$keyword%'";
								$result = mysqli_query($conn, $query);
								if(!$result){
									die ("query Failed: ".mysqli_error($conn));
								}
								else{
									return $result;
								}
							}
						}
						else{
							$query = "SELECT * FROM usermedia_$username WHERE
												description like '%$description%'
											AND file_extension like '%$file_extension%'
											AND channel_id IN (SELECT channel_id FROM channel WHERE channel_name LIKE '%$channelName%')
											AND user_id IN (SELECT user_id FROM user WHERE user_name LIKE '%$userName%')";
								$result = mysqli_query($conn, $query);
								if(!$result){
									die ("query Failed: ".mysqli_error($conn));
								}
								else{
									return $result;
								}
						}
					}
					else{
						$query = "SELECT * FROM usermedia_$username WHERE
												description like '%$description%'
											AND file_extension like '%$file_extension%'
											AND channel_id IN (SELECT channel_id FROM channel WHERE channel_name LIKE '%$channelName%')";
								$result = mysqli_query($conn, $query);
								if(!$result){
									die ("query Failed: ".mysqli_error($conn));
								}
								else{
									return $result;
								}
					}
				}
				else{
					$query = "SELECT * FROM usermedia_$username WHERE
												description like '%$description%'
											AND file_extension like '%$file_extension%'";
								$result = mysqli_query($conn, $query);
								if(!$result){
									die ("query Failed: ".mysqli_error($conn));
								}
								else{
									return $result;
								}
				}
			}
			else{
				$query = "SELECT * FROM usermedia_$username WHERE 
											 description like '%$description%'";
								$result = mysqli_query($conn, $query);
								if(!$result){
									die ("query Failed: ".mysqli_error($conn));
								}
								else{
									return $result;
								}
			}
		}
		else{
			if($file_extension != NULL){
				if($channelName != NULL){
					if($userName != NULL){
						if($keyword != NULL){
							if($date != NULL){
								$query = "SELECT * FROM usermedia_$username WHERE
												file_extension like '%$file_extension%'
											AND channel_id IN (SELECT channel_id FROM channel WHERE channel_name LIKE '%$channelName%')
											AND user_id IN (SELECT user_id FROM user WHERE user_name LIKE '%$userName%')
											AND keywords like '%$keyword%'
											AND upload_date like '%$date%'";
								$result = mysqli_query($conn, $query);
								if(!$result){
									die ("query Failed: ".mysqli_error($conn));
								}
								else{
									return $result;
								}
							}
							else{
								$query = "SELECT * FROM usermedia_$username WHERE
												file_extension like '%$file_extension%'
											AND channel_id IN (SELECT channel_id FROM channel WHERE channel_name LIKE '%$channelName%')
											AND user_id IN (SELECT user_id FROM user WHERE user_name LIKE '%$userName%')
											AND keywords like '%$keyword%'";
								$result = mysqli_query($conn, $query);
								if(!$result){
									die ("query Failed: ".mysqli_error($conn));
								}
								else{
									return $result;
								}
							}
						}
						else{
							$query = "SELECT * FROM usermedia_$username WHERE
												file_extension like '%$file_extension%'
											AND channel_id IN (SELECT channel_id FROM channel WHERE channel_name LIKE '%$channelName%')
											AND user_id IN (SELECT user_id FROM user WHERE user_name LIKE '%$userName%')";
								$result = mysqli_query($conn, $query);
								if(!$result){
									die ("query Failed: ".mysqli_error($conn));
								}
								else{
									return $result;
								}
						}
					}
					else{
						$query = "SELECT * FROM usermedia_$username WHERE
												file_extension like '%$file_extension%'
											AND channel_id IN (SELECT channel_id FROM channel WHERE channel_name LIKE '%$channelName%')";
								$result = mysqli_query($conn, $query);
								if(!$result){
									die ("query Failed: ".mysqli_error($conn));
								}
								else{
									return $result;
								}
					}
				}
				else{
					$query = "SELECT * FROM usermedia_$username WHERE
											 file_extension like '%$file_extension%'";
								$result = mysqli_query($conn, $query);
								if(!$result){
									die ("query Failed: ".mysqli_error($conn));
								}
								else{
									return $result;
								}
				}
			}
			else{
				if($channelName != NULL){
						if($userName != NULL){
							if($keyword != NULL){
								if($date != NULL){
									$query = "SELECT * FROM usermedia_$username WHERE
													channel_id IN (SELECT channel_id FROM channel WHERE channel_name LIKE '%$channelName%')
												AND user_id IN (SELECT user_id FROM user WHERE user_name LIKE '%$userName%')
												AND keywords like '%$keyword%'
												AND upload_date like '%$date%'";
									$result = mysqli_query($conn, $query);
									if(!$result){
										die ("query Failed: ".mysqli_error($conn));
									}
									else{
										return $result;
									}
								}
								else{
									$query = "SELECT * FROM usermedia_$username WHERE
													channel_id IN (SELECT channel_id FROM channel WHERE channel_name LIKE '%$channelName%')
												AND user_id IN (SELECT user_id FROM user WHERE user_name LIKE '%$userName%')
												AND keywords like '%$keyword%'";
									$result = mysqli_query($conn, $query);
									if(!$result){
										die ("query Failed: ".mysqli_error($conn));
									}
									else{
										return $result;
									}
								}
							}
							else{
								$query = "SELECT * FROM usermedia_$username WHERE
													channel_id IN (SELECT channel_id FROM channel WHERE channel_name LIKE '%$channelName%')
												AND user_id IN (SELECT user_id FROM user WHERE user_name LIKE '%$userName%')";
									$result = mysqli_query($conn, $query);
									if(!$result){
										die ("query Failed: ".mysqli_error($conn));
									}
									else{
										return $result;
									}
							}
						}
						else{
							$query = "SELECT * FROM usermedia_$username WHERE
												 channel_id IN (SELECT channel_id FROM channel WHERE channel_name LIKE '%$channelName%')";
									$result = mysqli_query($conn, $query);
									if(!$result){
										die ("query Failed: ".mysqli_error($conn));
									}
									else{
										return $result;
									}
						}
					}
				else{
					if($userName != NULL){
							if($keyword != NULL){
								if($date != NULL){
									$query = "SELECT * FROM usermedia_$username WHERE
												 user_id IN (SELECT user_id FROM user WHERE user_name LIKE '%$userName%')
												AND keywords like '%$keyword%'
												AND upload_date like '%$date%'";
									$result = mysqli_query($conn, $query);
									if(!$result){
										die ("query Failed: ".mysqli_error($conn));
									}
									else{
										return $result;
									}
								}
								else{
									$query = "SELECT * FROM usermedia_$username WHERE
												 user_id IN (SELECT user_id FROM user WHERE user_name LIKE '%$userName%')
												AND keywords like '%$keyword%'";
									$result = mysqli_query($conn, $query);
									if(!$result){
										die ("query Failed: ".mysqli_error($conn));
									}
									else{
										return $result;
									}
								}
							}
							else{
								$query = "SELECT * FROM usermedia_$username WHERE
												 user_id IN (SELECT user_id FROM user WHERE user_name LIKE '%$userName%')";
									$result = mysqli_query($conn, $query);
									if(!$result){
										die ("query Failed: ".mysqli_error($conn));
									}
									else{
										return $result;
									}
							}
						}
					else{
						if($keyword != NULL){
								if($date != NULL){
									$query = "SELECT * FROM usermedia_$username WHERE
												AND keywords like '%$keyword%'
												AND upload_date like '%$date%'";
									$result = mysqli_query($conn, $query);
									if(!$result){
										die ("query Failed: ".mysqli_error($conn));
									}
									else{
										return $result;
									}
								}
								else{
									$query = "SELECT * FROM usermedia_$username WHERE
												keywords like '%$keyword%'";
									$result = mysqli_query($conn, $query);
									if(!$result){
										die ("query Failed: ".mysqli_error($conn));
									}
									else{
										return $result;
									}
								}
							}
						else{
							if($date != NULL){
									$query = "SELECT * FROM usermedia_$username WHERE
												upload_date like '%$date%'";
									$result = mysqli_query($conn, $query);
									if(!$result){
										die ("query Failed: ".mysqli_error($conn));
									}
									else{
										return $result;
									}
								}
							else{
								return false;
							}
						}
					}
				}
			}
		}
		
	}
	mysqli_free_result($result);
	mysqli_close($conn);
}

function createPlaylist($name, $description, $userid){
	$conn = connect();
	$query = "INSERT INTO playlist VALUES (default, '$name', '$description', $userid, CURRENT_TIMESTAMP)";
	$result = mysqli_query($conn, $query);
	if(!$result){
		die ("Query Failed: ".mysqli_error($conn));
	}
	else{
		return true;
	}
	mysqli_free_result($result);
	mysqli_close($conn);
}

function getPlaylist($userId){
	$conn = connect();
	$query = "SELECT * FROM playlist WHERE user_id = $userId";
	$result = mysqli_query($conn, $query);
	if(!$result){
		die ("Query Failed: ".mysqli_error($conn));
	}
	else{
		return $result;
	}
	mysqli_free_result($result);
	mysqli_close($conn);
}

function addPlaylistMedia($playlistId, $mediaId){
	$conn = connect();
	$query = "INSERT INTO playlistmedia VALUES (default, $playlistId, $mediaId)";
	$result = mysqli_query($conn, $query);
	if(!$result){
		die ("Query Failed: ".mysqli_error($conn));
	}
	else{
		return $result;
	}
	mysqli_free_result($result);
	mysqli_close($conn);
}

function playlistMediaCheck($mediaId, $playlistId){
	$conn = connect();
	$query = "SELECT * FROM playlistmedia WHERE playlist_id = $playlistId and media_id = $mediaId";
	$result = mysqli_query($conn, $query);
	if(!$result){
		die ("Query Failed: ".mysqli_error($conn));
	}
	else{
		if(mysqli_num_rows($result) == 0){
			return true;
		}
		else{
			return false;
		}
	}
	mysqli_free_result($result);
	mysqli_close($conn);
}

function myPlaylist($userId){
	$conn = connect();
	$query = "SELECT * FROM playlist WHERE user_id = $userId";
	$result = mysqli_query($conn, $query);
	if(!$result){
		die ("Query Failed: ".mysqli_error($conn));
	}
	else{
		return $result;
	}
	mysqli_free_result($result);
	mysqli_close($conn);
}

function deletePlaylist($playlistid, $userid){
	$conn = connect();
	$query = "DELETE FROM playlist WHERE playlist_id = $playlistid and user_id = $userid";
	$result = mysqli_query($conn, $query);
	if(!$result){
		die ("Query Failed: ".mysqli_error($conn));
	}
	else{
		return true;
	}
	mysqli_free_result($result);
	mysqli_close($conn);
}

function playlistMedia($playlistId){
	$conn = connect();
	$query = "SELECT * FROM media m
				INNER JOIN playlistmedia p
				on m.media_id = p.media_id
				WHERE playlist_id = $playlistId";
	$result = mysqli_query($conn, $query);
	if(!$result){
		die ("Query Failed: ".mysqli_error($conn));
	}
	else{
		return $result;
	}
	mysqli_free_result($result);
	mysqli_close($conn);
}

function removePlaylistMedia($playlistId, $mediaId){
	$conn = connect();
	$query = "DELETE FROM playlistmedia WHERE playlist_id = $playlistId AND media_id = $mediaId";
	$result = mysqli_query($conn, $query);
	if(!$result){
		die ("Query Failed: ".mysqli_error($conn));
	}
	else{
		return true;
	}
	mysqli_free_result($result);
	mysqli_close($conn);
}

function userHistory($userId, $category){
	$conn = connect();
	$query = "INSERT INTO history VALUES (default, $userId, $category)";
	$result = mysqli_query($conn, $query);
	if(!$result){
		die ("Query Failed: ".mysqli_error($conn));
	}
	else{
		return $result;
	}
	mysqli_free_result($result);
	mysqli_close($conn);
}

function createGroup($name, $description, $userid){
	$conn = connect();
	$query = "INSERT INTO usergroup VALUES (default, '$name', '$description', $userid, CURRENT_TIMESTAMP)";
	$result = mysqli_query($conn, $query);
	if(!$result){
			die ("Query Failed: ".mysqli_error($conn));
		}
	else{
			return true;
		}
	mysqli_free_result($result);
	mysqli_close($conn);
}

function getGroup($userId){
	$conn = connect();
	$groupId[] = 0;
	
	$query1 = "SELECT group_id FROM usergroup WHERE administrator = $userId";
	$result1 = mysqli_query($conn, $query1);
	if(!$result1){
			die ("Query Failed: ".mysqli_error($conn));
		}
	else{
		if(mysqli_num_rows($result1) != 0){
			while ($row = mysqli_fetch_object($result1)){
				$groupId[] = $row->group_id;
			}
		}
	}
	
	$query2 = "SELECT group_id FROM groupmembers WHERE member_id = $userId";
	$result2 = mysqli_query($conn, $query2);
	if(!$result2){
			die ("Query Failed: ".mysqli_error($conn));
		}
	else{
		if(mysqli_num_rows($result2) != 0){
			while ($row = mysqli_fetch_object($result2)){
				$groupId[] = $row->group_id;
			}
		}
	}
	
	if(count($groupId != 0)){
		$uniqueGroupId = array_unique($groupId);	
		$ids = join(',',$uniqueGroupId);
		
		$query = "SELECT * FROM usergroup WHERE group_id IN ($ids)";
		$result = mysqli_query($conn, $query);	
		if(!$result){
			die ("Query Failed: ".mysqli_error($conn));
		}
		else{
			return $result;
		}
	}
	else {
		return false;
	}
	mysqli_free_result($result);
	mysqli_close($conn);
	
}

function getKeywords(){
	$conn = connect();
	$query = "SELECT keywords FROM media";
	$result = mysqli_query($conn, $query);
	if(!$result){
		die ("Query Failed: ".mysqli_error($conn));
	}
	else{
		if(mysqli_num_rows($result) == 0){
			return false;
		}
		else{
			while ($row = mysqli_fetch_object($result)){
				$keywords[] = $row->keywords;
			}
			return $keywords;
		}	
	}
	mysqli_free_result($result);
	mysqli_close($conn);
}

function getContacts($userid){
	$conn = connect();
	$query = "SELECT user_name FROM user WHERE 
				user_id IN (SELECT user_id2 from contacts WHERE user_id1 = $userid) 
				OR user_id IN (SELECT user_id2 from friends WHERE user_id1 = $userid)
				ORDER BY user_id";
	$result = mysqli_query($conn,$query);
	if(!$result){
		die("Query Failed: ".mysqli_error($conn));
	}
	else{
		return $result;
	}
	mysqli_free_result($result);
	mysqli_close($conn);
}

function addGroupMembers($groupId, $userId){
	$conn = connect();
	
	$query = "SELECT * FROM groupmembers WHERE group_id = $groupId AND member_id = $userId";
	$result = mysqli_query($conn, $query);

	if(!$result){
			die ("Query Failed: ".mysqli_error($conn));
	}
	else{
		if(mysqli_num_rows($result) == 0){
			$query1 = "INSERT INTO groupmembers VALUES (default, $groupId, $userId)";
			$result1 = mysqli_query($conn, $query1);
			if(!$result1){
				die ("Query Failed: ".mysqli_error($conn));
			}
			else{
				return true;
			}
		}
		else{
			return false;
		}
	}
	
	mysqli_free_result($result);
	mysqli_close($conn);
}

function getGroupDetails($groupId){
	$conn = connect();
	
	$query = "SELECT * FROM usergroup WHERE group_id = $groupId";
	$result = mysqli_query($conn, $query);
	
	if(!$result){
			die ("Query Failed: ".mysqli_error($conn));
		}
	else{
		return $result;
	}
	
	mysqli_free_result($result);
	mysqli_close($conn);
}

function getGroupMembers($groupId){
	$conn = connect();
	
	$query = "SELECT * FROM groupmembers WHERE group_id = $groupId";
	$result = mysqli_query($conn, $query);
	if(!$result){
			die ("Query Failed: ".mysqli_error($conn));
		}
	else{
		return $result;
	}
	
	mysqli_free_result($result);
	mysqli_close($conn);
}

function removeGroupMember($memberid, $groupid){
	$conn = connect();
	$query = "DELETE FROM groupmembers WHERE group_id = $groupid and member_id = $memberid";
	$result = mysqli_query($conn, $query);
	if(!$result){
			die ("Query Failed: ".mysqli_error($conn));
		}
	else{
			return true;
	}
	mysqli_free_result($result);
	mysqli_close($conn);
}

function createTopic($name, $description, $groupid){
	$conn = connect();
	$query = "INSERT INTO topic VALUES (default, '$name', '$description', $groupid, CURRENT_TIMESTAMP)";
	$result = mysqli_query($conn, $query);
	if(!$result){
			die ("Query Failed: ".mysqli_error($conn));
		}
	else{
			return true;
		}
	mysqli_free_result($result);
	mysqli_close($conn);
}

function getTopic($groupId){
	$conn = connect();
	$query = "SELECT * FROM topic WHERE group_id = $groupId";
	$result = mysqli_query($conn, $query);
	if(!$result){
			die ("Query Failed: ".mysqli_error($conn));
		}
	else{
		return $result;
	}
}

function getTopicDetails($topicId){
	$conn = connect();
	$query = "SELECT * FROM topic WHERE topic_id = $topicId";
	$result = mysqli_query($conn, $query);
	if(!$result){
			die ("Query Failed: ".mysqli_error($conn));
		}
	else{
		return $result;
	}
}

function getGroupName($groupId){
	$conn = connect();
	$query = "SELECT group_name FROM usergroup WHERE group_id = $groupId";
	$result = mysqli_query($conn, $query);
	if(!$result){
			die ("Query Failed: ".mysqli_error($conn));
		}
	else{
		if(mysqli_num_rows($result) == 0){
			return false;
		}
		else{
			$value = mysqli_fetch_object($result);
			return $value->group_name;
		}		
	}
}

function topicComment($topicId){
	$conn = connect();
	$query = "SELECT * FROM topic_comment WHERE topic_id = $topicId ORDER BY comment_date DESC";
	$result = mysqli_query($conn, $query);
	if(!$result){
			die ("Query Failed: ".mysqli_error($conn));
		}
	else{
		return $result;		
	}
}

function addTopicComment($topicId, $comment, $userid){
	$conn = connect();
	$query = "INSERT INTO topic_comment VALUES (default, $topicId, '$comment', $userid, CURRENT_TIMESTAMP)";
	$result = mysqli_query($conn, $query);
	if(!$result){
			die ("Query Failed: ".mysqli_error($conn));
		}
	else{
			return true;
		}
	mysqli_free_result($result);
	mysqli_close($conn);
}

function removeTopicComment($commentid){
	$conn = connect();
	$query = "DELETE FROM topic_comment WHERE comment_id =$commentid";
	$result = mysqli_query($conn, $query);
	if(!$result){
			die ("Query Failed: ".mysqli_error($conn));
		}
	else{
			return true;
		}
	mysqli_free_result($result);
	mysqli_close($conn);
}

function getRecommendation($userid){
	$conn = connect();
	$username = getUserName($userid);
	$query = "SELECT * FROM usermedia_$username WHERE 
				category IN 
					(SELECT max(media_category) FROM history WHERE user_id = $userid)
				OR category IN 
					(SELECT max(media_category) FROM history WHERE user_id = $userid AND 
					media_category NOT IN 
						(SELECT max(media_category) FROM history WHERE user_id = $userid))
				OR media_id IN 
					(SELECT media_id FROM mediarating GROUP BY media_id HAVING avg(rating)>3.0)
				OR media_id IN 
					(SELECT media_id FROM usermedia_$username WHERE channel_id IN 
						(SELECT channel_id FROM usermedia_$username WHERE media_id IN 
							(SELECT media_id FROM favourites WHERE user_id = $userid)))
				OR media_id IN 
					(SELECT media_id FROM usermedia_$username WHERE channel_id IN
						(SELECT channel_id FROM usermedia_$username WHERE category IN 
							(SELECT max(media_category) FROM history WHERE user_id = $userid)))
				OR media_id IN 
					(SELECT media_id FROM usermedia_$username WHERE user_id IN 
						(SELECT user_id FROM usermedia_$username WHERE media_id IN 
							(SELECT media_id FROM favourites WHERE user_id = $userid)))
				OR media_id IN 
					(SELECT media_id FROM usermedia_$username WHERE channel_id IN
						(SELECT user_id FROM usermedia_$username WHERE category IN 
							(SELECT max(media_category) FROM history WHERE user_id = $userid)))";
	$result = mysqli_query($conn, $query);
	if(!$result){
		die ("Query Failed: ".mysqli_error($conn));
	}
	else{
		return $result;
	}
	mysqli_free_result($result);
	mysqli_close($conn);
}

function deleteGroup($groupid){
	$conn = connect();
	$query = "DELETE FROM usergroup WHERE group_id = $groupid";
	$result = mysqli_query($conn, $query);
	if(!$result){
		die ("Query Failed: ".mysqli_error($conn));
	}
	else{
			return true;
	}
	mysqli_free_result($result);
	mysqli_close($conn);
}

?>