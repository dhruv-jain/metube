<?php ob_start(); ?>
<?php session_start(); ?>
<?php include_once 'parts/header.php'; ?>


<div class = 'container'>
	<div class ="row">
		<div class ="col-md-6">
			<h3>&nbsp;&nbsp;My Topics</h3>
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
	$result = getTopic($_SESSION['gid']);

	if(mysqli_num_rows($result) == 0){
		if($_SESSION['id'] == 1){
			echo "<h3>This is Guest Account. You don't have permission to view this page. Please Login or Register!!</h3>";
		}
		else{
			echo "<h3>You have not created any Topic!!</h3>";
		}
	}
	else{
		while($row = mysqli_fetch_object($result)){
			$topicId[] = $row->topic_id;
			$topicName[] = $row->topic_name;
			$description[] = $row->topic_descriptiopn;
			$createdDate[] = $row->created_date; 
		}
		echo "<div class='table-responsive'>          
					<table class='table'>
						<thead>
							<tr>
								<th>#</th>
								<th>Name</th>
								<th>Description</th>
								<th>Date</th>
							</tr>
						</thead>";
						for ($i=0; $i<count($topicId); $i++){
							$j = $i+1;
						echo "<tbody>
								<tr>
									<td>$j</td>
									<td>$topicName[$i]</td>
									<td>$description[$i]</td>
									<td>$createdDate[$i]</td>
									<td><a href = 'session_set_topic.php?tid=$topicId[$i]' class = 'btn btn-default'>View</a></td>
								</tr>
							</tbody>";
						}
			echo"	</table>
				</div>";	
	}
}
?>
</div>
	</div>
</div>
<?php include_once('parts/footer.php'); ?>