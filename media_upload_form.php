<?php

$check = channelExistCheck($_SESSION['id']);

if($check == false){
	echo "<h3>You don't have any Channel. Please Create Channel First!!!";
}

else{
	$result = myChannel($_SESSION['id']);
	
	while ($row = mysqli_fetch_object($result)){
		$channelId[] = $row->channel_id;
		$channelName[] = $row->channel_name;
	}?>

    	<form method = 'post' enctype = 'multipart/form-data' id = 'fileupload'>

		<div class='form-group'>
			<label>Title</label>
			<input type='text' name = 'title' class='form-control' id='' placeholder='Title' required>
		</div>
		<div class='form-group'>
			<label>Descrption</label>
			<input type='text' name = 'description' class='form-control' id='' placeholder='Enter Description Here....' required>
		</div>
		
		<div class='form-group'>
					<label>Channel</label>
					<select class = 'form-control' name = 'channel'>
                        <?php
						for($i = 0; $i<count($channelId); $i++){
							echo "<option value = '$channelId[$i]'>$channelName[$i]</option>";
						}
		echo"</select>
				</div>";
		echo "<div class='form-group'>
			<label>Category</label>
			<select class = 'form-control' name = 'category'>
				<option value = '1'>Image</option>
				<option value = '2'>Music</option>
				<option value = '3'>Graphics</option>
				<option value = '4'>TV Shows</option>
				<option value = '5'>Movies</option>
				<option value = '6'>Sports</option>
				<option value = '7'>News</option>
				<option value = '8'>Other</option>
			</select>	
		</div>

		<div class='form-group'>
			<label>Keywords</label>
			<input type='text' name = 'keywords' class='form-control' id='' placeholder='Enter keywords seperated by space' required>
		</div>

		<label>Share Access</label>

		<div class='radio'>
			<label>
			<input type='radio' name='share' id='' value='1'>
				All
			</label>
			<label>
			<input type='radio' name='share' id='' value='2'>
				Friends
			</label>
			<label>
			<input type='radio' name='share' id='' value='3'>
				No One
			</label>
		</div>

		<label>Download Privileges</label>

		<div class='radio'>
			<label>
			<input type='radio' name='download' id='' value='true'>
				Yes
			</label>
			<label>
			<input type='radio' name='download' id='' value='false'>
				No
			</label>
		</div>
			
		<label>Rating Privileges</label>

		<div class='radio'>
			<label>
			<input type='radio' name='rating' id='' value='true'>
				Yes
			</label>
			<label>
			<input type='radio' name='rating' id='' value='false'>
				No
			</label>
		</div>

		<label>Discussion Privileges</label>

		<div class='radio'>
			<label>
			<input type='radio' name='discussion' id='' value='true'>
				Yes
			</label>
			<label>
			<input type='radio' name='discussion' id='' value='false'>
				No
			</label>
		</div>

		<div class='form-group'>
			<label>Upload File</label>
			<input type = 'file' name = 'uploadfile' id = ''>
		</div>

		<input type = 'submit' value = 'Upload' name = 'submit' class = 'btn btn-default'>
		</form>";
}

?>

