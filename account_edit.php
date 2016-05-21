<?php ob_start(); ?>
<?php session_start(); ?>
<?php include_once('parts/header.php'); ?>

<div class = 'container'>
	<div class ="row">
		<div class ="col-md-6">
			<h3>&nbsp;&nbsp;Edit Account</h3>
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


if(isset($_POST['save'])){
	if($_SESSION['id'] == NULL and $_POST['username'] == NULL and $_POST['password'] == NULL and
	$_POST['first_name'] == NULL and $_POST['last_name'] == NULL and $_POST['dob'] == NULL
	and $_POST['sex'] == NULL and $_POST['email'] == NULL and $_POST['phone'] == NULL){
		echo "<h3>Please enter atlease one field to update</h3>";
	}
	else{
		$edit = accountEdit($_SESSION['id'], $_POST['username'], $_POST['password'],$_POST['first_name'], $_POST['last_name'], $_POST['dob'], $_POST['sex'], $_POST['email'], $_POST['phone']);
		if ($edit){
			header ('Location: profile.php');
		}
	}
	
}
elseif (isset($_POST['cancel'])){
	header ('Location: profile.php');
}
?>
<form method="post">
    <div class="form-group">
    <label for="">Username</label>
    <input type="text" name="username" class="form-control" id="" placeholder="Enter new Username">
    </div>
    <div class="form-group">
    <label for="">Password</label>
    <input type="password" name="password" class="form-control" id="" placeholder="Enter new Password">
    </div>
    <div class="form-group">
    <label for="">First Name</label>
    <input type="text" name="first_name" class="form-control" id="" placeholder="Enter new First Name">
    </div>
    <div class="form-group">
    <label for="">Last Name</label>
    <input type="text" name="last_name" class="form-control" id="" placeholder="Enter new Last Name">
    </div>
    <div class="form-group">
    <label for="">Date of Birth</label>
    <input type="date" name="dob" class="form-control" id="" placeholder="Enter new Date of Birth">
    </div>
    <div class="form-group">
    <label for="">Last Name</label>
    <input type="text" name="last_name" class="form-control" id="" placeholder="Enter new Last Name">
    </div>
        <p>Gender</p>

    <div class="radio">
    <label>
    <input type="radio" name="sex" id="" value="F">
        Female
    </label>
    </div>
     <div class="radio">
    <label>
    <input type="radio" name="sex" id="" value="M">
        Male
    </label>
    </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter new Email" >
    </div>
    
    <div class="form-group">
    <label for="">Phone</label>
    <input type="text" name="phone" class="form-control" id="" placeholder="Phone" >
    </div>
  
    <input name="save" type="submit" value="Save" class = "btn btn-default">
        <input name="reset" type="reset" value="Reset" class = "btn btn-default">

        <input name="cancel" type="submit" value="Cancel" class = "btn btn-default">

</form>

		</div>
	</div>
</div>
<?php include_once('parts/footer.php'); ?>
