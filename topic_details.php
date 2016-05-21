<?php ob_start(); ?>
<?php session_start(); ?>
<?php include_once 'parts/header.php'; ?>

<div class = 'container'>
	<div class ="row">
		<div class ="col-md-6">
			<h3>&nbsp;&nbsp;Topic Details</h3>
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

$result = getTopicDetails($_SESSION['tid']);

while($row = mysqli_fetch_object($result)){
	$topicId = $row->topic_id;
	$name = $row->topic_name;
	$desc = $row->topic_descriptiopn;
	$groupId = $row->group_id;
	$date = $row->created_date;
}

$groupName = getGroupName($groupId);

echo "<h4>
		Topic: $name<br><br>
		Decription: $desc<br><br>
		Group: $groupName<br><br>
		Created Date: $date<h4><hr>";
		
$result1 = topicComment($_SESSION['tid']);

echo "<form method = 'post'>";

if(mysqli_num_rows($result1)==0){
	echo "<h4>No Comments Yet!!!</h4>";
}
else{
	while($row = mysqli_fetch_object($result1)){
		$commentId[] = $row->comment_id;
		$userid[] = $row->user_id;
		$comment[] = $row->comment;
		$comment_date[] = $row->comment_date;
	}
	echo "<div class='table-responsive'>          
			<table class='table'>
				<thead>
					<tr>
						<th>#</th>
						<th>User</th>
						<th>Says</th>
						<th>Date</th>
					</tr>
				</thead>";
				for ($i=0; $i<count($comment); $i++){
					$j = $i+1;
					$details = userDetails($userid[$i]);
					echo "<tbody>".
							"<tr>".
								"<td>".$j."</td>".
								"<td>".$details[3]." ".$details[4]."</td>".
								"<td>".$comment[$i]."</td>".
								"<td>".$comment_date[$i]."</td>";
								if($userid[$i] == $_SESSION['id']){
									echo"<td><input type = 'submit' value = 'Remove Comment' name = 'delete' class = 'btn btn-default'/></td>";
									$removeComment = $commentId[$i];
								}
								
					echo"		</tr>".
						"</tbody>";
							}	
	echo "	</table>
		</div>";			
}		
echo "<div class='form-group'>
		<label>Comment</label>
		<textarea class='form-control' rows='5' name='comment' placeholder='Enter Comment Here!!!'></textarea>
	</div>
	<div class = 'form-group'>
		<input type = 'submit' value = 'Comment' name = 'submit' class = 'btn btn-default'/>
	<div>
</form>";

if(isset($_POST['submit'])){
	$text = nl2br(htmlentities($_POST['comment'], ENT_QUOTES, 'UTF-8'));
	$add = addTopicComment($_SESSION['tid'],$text, $_SESSION['id']);
	if($add){
		header("Location: topic_details.php");
	}
}
elseif(isset($_POST['delete'])){
	$remove = removeTopicComment($removeComment);
	if($remove){
		header("Location: topic_details.php");
	}
}	

?>
</div>
	</div>
</div>
<?php include_once('parts/footer.php'); ?>