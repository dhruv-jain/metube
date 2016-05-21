<?php ob_start(); ?>
<?php session_start(); ?>
<?php include_once 'parts/header.php'; ?>

<div class = 'container'>
	<div class ="row">
		<div class ="col-md-6">
			<h3>&nbsp;&nbsp;Group Details</h3>
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

$result = getGroupDetails($_SESSION['gid']);

$result1 = getGroupMembers($_SESSION['gid']);

while ($row = mysqli_fetch_object($result)){
	$groupName = $row->group_name;
	$desc = $row->description;
	$admin = $row->administrator;	
	$date = $row->created_on;
}

echo "<h4>Group Name: $groupName</h4>";
	echo "<h4>Description: $desc</h4>";
	$details = userDetails($admin);
	echo "<h4>Created By: $details[3] $details[4]";
	echo "<h4>Created On: $date</h4>"; 

if(mysqli_num_rows($result1) != 0){
	while ($row = mysqli_fetch_object($result1)){
		$members[] = $row->member_id;
	}	 
	echo "<form method = 'post'>
						<div class='table-responsive'>          
							<table class='table'>
								<thead>
									<tr>
										<th>#</th>
										<th>Username</th>
										<th>Name</th>
										<th>EMail</th>
									</tr>
								</thead>";
							for ($i=0; $i<count($members); $i++){
								$details = userDetails($members[$i]);
								$j = $i+1;
								echo "<tbody>".
										"<tr>".
											"<td>".$j."</td>".
											"<td>".$details[1]."</td>".
											"<td>".$details[3]." ".$details[4]."</td>".
											"<td>".$details[7]."</td>";
											if($_SESSION['id']==$admin){
												echo"<td><input type='checkbox' name='memberid[]' value='$members[$i]' /></td>";
											}
									echo	"</tr>".
									"</tbody>";
								}
			echo"			</table>
							<div class = 'form-group'>
								<a href = 'create_topic.php' class = 'btn btn-default'>Create Topic</a>";
								echo " ";
								if($_SESSION['id']==$admin){
								echo "<input type = 'submit' value = 'Remove From Group' name = 'remove' class = 'btn btn-default'>";
								}
						echo"	</div>
						</div>
				</form>";	
}

else{
	echo "<h3>There are no members in this group</h3>";
}

echo "<a href='myTopic.php' class = 'btn btn-default'>View Topics</a>";
			
if(isset($_POST['remove'])){
	$memberid = $_POST['memberid'];
	for($i=0; $i<count($memberid); $i++){
		$remove = removeGroupMember($memberid[$i], $_SESSION['gid']);
	}
	if($remove){
		header("Location: group_details.php");
	}
}
	
?>
</div>
	</div>
</div>
<?php include_once('parts/footer.php'); ?>