<?php ob_start(); ?>
<?php session_start(); ?>
<?php include_once('parts/header.php'); ?>

<div class = 'container'>
	<div class ="row">
		<div class ="col-md-6">
			<h3>&nbsp;&nbsp;Upload Media</h3>
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
		include_once "media_upload_form.php";

		if(isset($_POST['submit'])){
			$category = $_POST['category'];
			
			if($category == 1){
				$target_dir = "images/";
				$target_file = $target_dir.basename($_FILES['uploadfile']['name']);
				$filename = $_FILES['uploadfile']['name'];
				$extension = pathinfo($target_file,PATHINFO_EXTENSION);
				if(move_uploaded_file($_FILES['uploadfile']['tmp_name'],$target_file)){
					$upload = mediaUpload($_SESSION['id'], $_POST['title'], $_POST['description'], $category, $_POST['keywords'],$filename, $extension, $_POST['share'], $_POST['download'], $_POST['rating'], $_POST['discussion'], $target_file, $_POST['channel']);
					if($upload){
						echo"<h3>File Uploaded</h3>";
					}
					else{
						echo "<h3>Upload Error</h3>";
					}
				}
				else{
					echo "<h3>Upload Error</h3>";
				}
			}
			elseif($category == 2){
				$target_dir = "audios/";
				$target_file = $target_dir.basename($_FILES['uploadfile']['name']);
				$filename = $_FILES['uploadfile']['name'];
				$extension = pathinfo($target_file,PATHINFO_EXTENSION);
				if(move_uploaded_file($_FILES['uploadfile']['tmp_name'],$target_file)){
					$upload = mediaUpload($_SESSION['id'], $_POST['title'], $_POST['description'], $category, $_POST['keywords'],$filename, $extension, $_POST['share'], $_POST['download'], $_POST['rating'], $_POST['discussion'], $target_file, $_POST['channel']);
					if($upload){
						echo"<h3>File Uploaded</h3>";
					}
					else{
						echo "<h3>Upload Error</h3>";
					}
				}
				else{
					echo "<h3>Upload Error</h3>";
				}
			}
			elseif($category == 3){
				$target_dir = "graphics/";
				$target_file = $target_dir.basename($_FILES['uploadfile']['name']);
				$filename = $_FILES['uploadfile']['name'];
				$extension = pathinfo($target_file,PATHINFO_EXTENSION);
				if(move_uploaded_file($_FILES['uploadfile']['tmp_name'],$target_file)){
					$upload = mediaUpload($_SESSION['id'], $_POST['title'], $_POST['description'], $category, $_POST['keywords'],$filename, $extension, $_POST['share'], $_POST['download'], $_POST['rating'], $_POST['discussion'], $target_file, $_POST['channel']);
					if($upload){
						echo"<h3>File Uploaded</h3>";
					}
					else{
						echo "<h3>Upload Error</h3>";
					}
				}
				else{
					echo "<h3>Upload Error</h3>";
				}
			}
			elseif($category == 4) {
				$target_dir = "videos/shows/";
				$target_file = $target_dir.basename($_FILES['uploadfile']['name']);
				$filename = $_FILES['uploadfile']['name'];
				$extension = pathinfo($target_file,PATHINFO_EXTENSION);
				if(move_uploaded_file($_FILES['uploadfile']['tmp_name'],$target_file)){
					$upload = mediaUpload($_SESSION['id'], $_POST['title'], $_POST['description'], $category, $_POST['keywords'],$filename, $extension, $_POST['share'], $_POST['download'], $_POST['rating'], $_POST['discussion'], $target_file, $_POST['channel']);
					if($upload){
						echo"<h3>File Uploaded</h3>";
					}
					else{
						echo "<h3>Upload Error</h3>";
					}
				}
				else{
					echo "<h3>Upload Error</h3>";
				}
			}
			elseif($category == 5){
				$target_dir = "videos/movies/";
				$target_file = $target_dir.basename($_FILES['uploadfile']['name']);
				$filename = $_FILES['uploadfile']['name'];
				$extension = pathinfo($target_file,PATHINFO_EXTENSION);
				if(move_uploaded_file($_FILES['uploadfile']['tmp_name'],$target_file)){
					$upload = mediaUpload($_SESSION['id'], $_POST['title'], $_POST['description'], $category, $_POST['keywords'],$filename, $extension, $_POST['share'], $_POST['download'], $_POST['rating'], $_POST['discussion'], $target_file, $_POST['channel']);
				if($upload){
						echo"<h3>File Uploaded</h3>";
					}
					else{
						echo "<h3>Upload Error</h3>";
					}
				}
				else{
					echo "<h3>Upload Error</h3>";
				}
			}
			elseif($category == 6){
				$target_dir = "videos/sports/";
				$target_file = $target_dir.basename($_FILES['uploadfile']['name']);
				$filename = $_FILES['uploadfile']['name'];
				$extension = pathinfo($target_file,PATHINFO_EXTENSION);
				if(move_uploaded_file($_FILES['uploadfile']['tmp_name'],$target_file)){
					$upload = mediaUpload($_SESSION['id'], $_POST['title'], $_POST['description'], $category, $_POST['keywords'],$filename, $extension, $_POST['share'], $_POST['download'], $_POST['rating'], $_POST['discussion'], $target_file, $_POST['channel']);
				if($upload){
						echo"<h3>File Uploaded</h3>";
					}
					else{
						echo "<h3>Upload Error</h3>";
					}
				}
				else{
					echo "<h3>Upload Error</h3>";
				}
			}
			elseif($category == 7){
				$target_dir = "videos/news/";
				$target_file = $target_dir.basename($_FILES['uploadfile']['name']);
				$filename = $_FILES['uploadfile']['name'];
				$extension = pathinfo($target_file,PATHINFO_EXTENSION);
				if(move_uploaded_file($_FILES['uploadfile']['tmp_name'],$target_file)){
					$upload = mediaUpload($_SESSION['id'], $_POST['title'], $_POST['description'], $category, $_POST['keywords'],$filename, $extension, $_POST['share'], $_POST['download'], $_POST['rating'], $_POST['discussion'], $target_file, $_POST['channel']);
				if($upload){
						echo"<h3>File Uploaded</h3>";
					}
					else{
						echo "<h3>Upload Error</h3>";
					}
				}
				else{
					echo "<h3>Upload Error</h3>";
				}
			}
			elseif($category == 8){
				$target_dir = "videos/others/";
				$target_file = $target_dir.basename($_FILES['uploadfile']['name']);
				$filename = $_FILES['uploadfile']['name'];
				$extension = pathinfo($target_file,PATHINFO_EXTENSION);
				if(move_uploaded_file($_FILES['uploadfile']['tmp_name'],$target_file)){
					$upload = mediaUpload($_SESSION['id'], $_POST['title'], $_POST['description'], $category, $_POST['keywords'],$filename, $extension, $_POST['share'], $_POST['download'], $_POST['rating'], $_POST['discussion'], $target_file, $_POST['channel']);
				if($upload){
						echo"<h3>File Uploaded</h3>";
					}
					else{
						echo "<h3>Upload Error</h3>";
					}
				}
				else{
					echo "<h3>Upload Error</h3>";
				}
			}
		}
	}

?>
</div>
	</div>
</div>
<?php include_once('parts/footer.php'); ?>


