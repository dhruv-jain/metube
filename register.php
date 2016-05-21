<?php ob_start(); ?>
<?php session_start(); ?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Metube</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/styles.css">
       
        <link rel="stylesheet" href="css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="css/main.css">

        <script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
    </head>
    <body>
                <div id = "wrap">

        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        
        
        <nav style = "background-color:#522D80;" class="navbar navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">	  
	   <a href="#" class="pull-left"><img class = "img-responsive" src="paw.png"></a>
            <a class="navbar-brand" style = "color:#fff; font-size:40px;" href="index.php">Metube</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          
        </div><!--/.navbar-collapse -->
      </div>
    </nav>
                    <br>
                    <br><br><br>
        
<?php
include_once "function.php";

if(isset($_POST['submit'])) {
	if( $_POST['password1'] != $_POST['password2']) {
		echo "Passwords don't match. Try again";
	}
	else {
		$check = registrationValidation($_POST['username'], $_POST['password1'],$_POST['first_name'], $_POST['last_name'], $_POST['dob'], $_POST['sex'], $_POST['email'], $_POST['phone']);
        echo $check;
		if($check){
			$id = userId($_POST['username']);
			$_SESSION['id']= $id;
			header ('Location: browse.php');
		}
	}
}
?>
        
        
<div class  ="container">
<h2>User Registration</h2>

<form method="post">
     
    <div class="form-group">
    <label >Username</label>
    <input type="text" name = "username" class="form-control" id="" placeholder="Username" required>
    </div>
        
    <div class="form-group">
    <label for="exampleInputPassword1">Create Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password1" required>
    </div>
    
    
     <div class="form-group">
    <label for="exampleInputPassword2">Repeat Password</label>
    <input type="password" class="form-control" name="password2" id="exampleInputPassword2" placeholder=" Repeat Password" required>
    </div>
    
    
    <div class="form-group">
    <label >First Name</label>
    <input type="text" name = "first_name" class="form-control" id="" placeholder="First Name">
    </div>
    
     <div class="form-group">
    <label >Last Name</label>
    <input type="text" name = "last_name" class="form-control" id="" placeholder="Last Name">
    </div>
    
    <div class="form-group">
    <label >Date of Birth</label>
    <input type="date" name = "dob" class="form-control" id="" placeholder="YYYY-mm-dd">
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
    <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Email" required>
    </div>
    
    <div class="form-group">
    <label for="">Phone</label>
    <input type="text" name="phone" class="form-control" id="" placeholder="Phone" required>
    </div>

    
    
    <input name="submit" type="submit" value="Register" class = "btn btn-default">
	<input name="reset" type="reset" value="Reset" class = "btn btn-default">
</form>
<?php include_once('parts/footer.php'); ?>

