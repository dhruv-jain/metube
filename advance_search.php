<?php ob_start(); ?>
<?php session_start(); ?>
<?php include_once('parts/header.php'); ?>

<div class = 'container'>
	<div class ="row">
		<div class ="col-md-6">
			<h3>&nbsp;&nbsp;Advance Search</h3>
		</div>
	</div>    
    <div class ="row">
        <div class ="col-md-3"> 
            <?php include_once('parts/sidebar.php'); ?>
        </div>
        <div class ="col-md-1"> 
        </div>
        <div class ="col-md-8">

	<form method = "post" action = "advance_search_result.php">
		<div class='form-group'>
			<label>Title</label>
			<input type='text' name = 'title' class='form-control' placeholder='Title'>
		</div>
		<div class='form-group'>
			<label>Description</label>
			<input type='text' name = 'description' class='form-control' placeholder='Description'>
		</div>
		<div class='form-group'>
			<label>File Extension</label>
			<input type='text' name = 'extension' class='form-control' placeholder='File Extension'>
		</div>
		<div class='form-group'>
			<label>Channel Name</label>
			<input type='text' name = 'channel' class='form-control' placeholder='Channel Name'>
		</div>
		<div class='form-group'>
			<label>Uploaded By</label>
			<input type='text' name = 'uploadedBy' class='form-control' placeholder='Username/EMail of Uploader'>
		</div>
		<div class='form-group'>
			<label>Keywords</label>
			<input type='text' name = 'keyword' class='form-control' placeholder = 'keywords'>
		</div>
		<div class='form-group'>
			<label>Uploaded Date</label>
			<input type='text' name = 'date' class='form-control' placeholder = 'YYYY-mm-dd'>
		</div>
		<div class='form-group'>
			<input type='submit' name = 'search' class='btn btn-default' value = 'Search'>
		</div>
	</form>
</div>
	</div>
</div>
<?php include_once('parts/footer.php'); ?>