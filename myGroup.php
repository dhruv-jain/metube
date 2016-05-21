<?php ob_start(); ?>
<?php session_start(); ?>
<?php include_once 'parts/header.php'; ?>



<div class = 'container'>
	<div class ="row">
		<div class ="col-md-6">
			<h3>&nbsp;&nbsp;My Group</h3>
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
	
$result = getGroup($_SESSION['id']);

if(mysqli_num_rows($result) == 0){
	if($_SESSION['id'] == 1){
		echo "<h3>This is Guest Account. You don't have permission to view this page. Please Login or Register!!</h3>";
	}
	else{
		echo "<h3>You are not associated with any Group!!</h3>";
	}
}
else{
	if($result != false){
		while($row = mysqli_fetch_object($result)){
			$groupId[] = $row->group_id;
			$groupName[] = $row->group_name;
			$description[] = $row->description;
			$createdBy = $row->administrator;
			$createdDate[] = $row->created_on; 
		}
		for ($i=0; $i<count($groupId); $i++){
			
			echo "<form method = 'post'>
					<div class = 'row'>
						<div class = 'col-md-3'>
						</div>
						<div class = 'col-md-2'>
							<a href = 'session_set_group.php?gid=$groupId[$i]'><img src = 'thumbnails/channel.png' class = 'img-responsive'></a>
						</div>
						<div class = 'col-md-2'>
							<a href = 'session_set_group.php?gid=$groupId[$i]'>$groupName[$i]</a><br>
							Created On: $createdDate[$i]<br>
							Description: $description[$i]<br>
						</div>";
						if($_SESSION['id'] == $createdBy){
							echo"<div class = 'col-md-2'>
									<input type='checkbox' name='groupId[]' value='$groupId[$i]'/>
								</div>
								<div class = 'col-md-2'>
									<a href = 'add_groupmember.php?gid=$groupId[$i]' class = 'btn btn-default'>Add Members</a>
								</div>";
						}
					echo"</div><hr>";
		}
	}
		if($_SESSION['id'] == $createdBy){
			echo "<div class = 'row'>
						<div class = 'col-md-3'>
					</div>
					<div class = 'col-md-2'>
							<input type = 'submit' value = 'Remove Group' name = 'delete' class = 'btn btn-default'>
					</div>
				</div>";
		}
	echo "</form>";
		
}

echo "</div>";

if(isset($_POST['delete'])){
	$removeGroup = $_POST['groupId'];
	for ($i=0; $i<count($removeGroup); $i++){
		$check = deleteGroup($removeGroup[$i]);
	}
	if($check){
		header ('Location: myGroup.php');
	}
}

            ?>
</div>
	</div>
</div>
<?php include_once('parts/footer.php'); ?>