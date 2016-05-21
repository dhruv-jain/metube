<?php ob_start(); ?>
<?php session_start(); ?>
<?php include_once('parts/header.php'); ?>

<div class = 'container'>
	<div class ="row">
		<div class ="col-md-6">
			<h3>&nbsp;&nbsp;Contact Suggestion</h3>
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

if($_SESSION['id'] == 1){
		echo "<h3>This is Guest Account. You don't have permission to view this page. Please Login or Register!!</h3>";
}

else{
	$contacts = allUsers($_SESSION['id']);

	if(mysqli_num_rows($contacts) == 0){
			echo "<h3>Sorry there are no contacts </h3>";
	}
	else{
		while ($row = mysqli_fetch_array($contacts, MYSQLI_ASSOC)){
				foreach ($row as $column){
					$username[] = $column;
				}
			}

		$count = count($username);

		if($count >= 1){
			echo "<form method = 'post'>
                                        <h3>Suggested Users</h3>

						<div class='table-responsive'>          
							<table class='table'>
								<thead>
									<tr>
										<th>#</th>
										<th>Username</th>
										<th>Name</th>
										<th>DOB</th>
										<th>Sex</th>
										<th>EMail</th>
										<th>Select Contacts</th>
									</tr>
								</thead>";
							for ($i=0; $i<$count; $i++){
								$userid = userId($username[$i]);
								$details = userDetails($userid);
								$j = $i+1;
								echo "<tbody>".
										"<tr>".
											"<td>".$j."</td>".
											"<td>".$details[1]."</td>".
											"<td>".$details[3]." ".$details[4]."</td>".
											"<td>".$details[5]."</td>".
											"<td>".$details[6]."</td>".
											"<td>".$details[7]."</td>".
											"<td><input type='checkbox' name='userid[]' value='$userid' /></td>".
										"</tr>".
									"</tbody>";
								}
			echo"			</table>
							<div class = 'form-group'>
							<input type = 'submit' value = 'Add to my Contact List' name = 'addContacts' class = 'btn btn-default'>
							</div>
						</div>
				</form>";
		}
	}
}
	
if (isset($_POST['addContacts'])){
	$contacts = $_POST['userid'];
	
	for ($i=0; $i<count($contacts); $i++){
		$add = addContacts($_SESSION['id'],$contacts[$i]);
	}
	if($add){
		header ('Location: all_contacts.php');
	}
}
?>
</div>
	</div>
</div>
<?php include_once('parts/footer.php'); ?>