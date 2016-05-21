<?php ob_start(); ?>
<?php session_start(); ?>
<?php include_once 'parts/header.php'; ?>

<div class = 'container'>
	<div class ="row">
		<div class ="col-md-6">
			<h3>&nbsp;&nbsp;Create Topic</h3>
		</div>
	</div>    
    <div class ="row">
        <div class ="col-md-3"> 
            <?php include_once('parts/sidebar.php'); ?>
        </div>
        <div class ="col-md-1"> 
        </div>
        <div class ="col-md-8">


<form method = "post" id = "topic">

<div class='form-group'>
	<label>Topic Name</label>
	<input type='text' name = 'name' class='form-control' id='' placeholder='Topic Name' required>
</div>

<div class='form-group'>
	<label>Description</label>
	<textarea class='form-control' rows='5' name='description' placeholder='Enter Description Here!!!'></textarea>
</div>

<div class='form-group'>
	<input type = 'submit' value = 'Create Topic' name = 'submit' class = 'btn btn-default'>
</div>

<?php

if(isset($_POST['submit'])){
	$description = nl2br(htmlentities($_POST['description'], ENT_QUOTES, 'UTF-8'));
	$check = createTopic($_POST['name'], $description, $_SESSION['gid']);
	if($check){
		header ("Location: myTopic.php");
	}
}

?>

</div>
	</div>
</div>
<?php include_once('parts/footer.php'); ?>