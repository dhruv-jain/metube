<?php ob_start(); ?>
<?php session_start(); ?>
<?php include_once('parts/header.php'); ?>


<div class = 'container'>
	<div class ="row">
		<div class ="col-md-6">
			<h3>&nbsp;&nbsp;Inbox</h3>
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
	$messages = getMessage($_SESSION['id']);
    echo"<a class = 'btn btn-default btn-success' href = 'send_message.php'>Compose</a>";              
            
	if(mysqli_num_rows($messages) == 0){
		echo "<h3>You have no Messages</h3>";
	}
	else{
		while ($row = mysqli_fetch_object($messages)){
			$sender[] = $row->user_id1;
			$description[] = $row->message;
			$date[] = $row->date;
		}
		echo "<div class='container'>
				<div class='table-responsive'>          
					<table class='table'>
						<thead>
							<tr>
								<th>#</th>
								<th>Date</th>
								<th>Sender</th>
								<th>Message</th>
							</tr>
						</thead>";
						for ($i=0; $i<count($sender); $i++){
							$details = userDetails($sender[$i]);
							$j = $i+1;
							echo "<tbody>".
									"<tr>".
										"<td>".$j."</td>".
										"<td>".$date[$i]."</td>".
										"<td>".$details[3]." ".$details[4]."</td>".
										"<td>".$description[$i]."</td>".
									"</tr>".
								"</tbody>";
						}
		echo"		</table>
				</div>
			</div>";
	}
}

?>
</div>
	</div>
</div>
<?php include_once('parts/footer.php'); ?>
