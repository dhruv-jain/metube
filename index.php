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


<br><br><br>

    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
      <div class="container">
        <h1>Welcome to Metube!!</h1>
        <p>An online multimedia database system</p>
      </div>
    </div>
    <div class="container">
      <!-- Example row of columns -->
      <div class="row">
        <div class="col-md-4">
          <h2>Sign In</h2>             
            <form method = "post" >
                <div class="form-group">
                <label for="">Username/EMail/Phone</label>
                <input type="text" name = "credential" class="form-control" id="" placeholder="Enter Username or Email or Phone" required>
                </div>
                <div class="form-group">
                <label for="">Password</label>
                <input type="password" name = "password" class="form-control" id="" placeholder="Enter Password">
                </div>
                <input type="submit" class="btn btn-default" name = 'login' value = 'Log In'>
            </form> 
        </div>
        <div class="col-md-4">
          <h2>Sign Up</h2>
          <p><a class="btn btn-default" href="register.php" role="button">Sign Up</a></p>
       </div>
        <div class="col-md-4">
          <h2>Continue as Guest</h2>
		  <form method = "post">
			<input type="submit" class="btn btn-default" name = 'guest' value = 'Continue as Guest'>
		  </form>
        </div>
      </div>
      <hr>    
  <?php
                include_once "function.php";
                if(isset($_POST['login'])) {
					$check = userValidation ($_POST['credential'], $_POST['password']);
					if(!$_POST['password']){
						echo "<h3>Please enter password or click on Forgot Password</h3>";
					}
					elseif($check){
						header ('Location: browse.php');                      
					}
					else{
						echo "<h3>Username or password is incorrect. Please login again!!</h3>";
					}						
				}
				elseif (isset($_POST['guest'])){
					$user = guest();
					header ('Location: browse.php');					
				}
				elseif (isset($_POST['forgotPassword'])){
					header ('Location: forgotPassword.php');					
				}
    ?>
        
        
        
        <?php include_once('parts/footer.php'); ?>

        