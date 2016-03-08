<?php
	session_start();
	require_once( 'sql-login.php' );
	//TODO remove this
	//$_SESSION['admin'] = 1;
	if(!isset($_SESSION['admin'])) {header("Location: ./index.php"); die();}
	if(!isset($_POST['portal'])) {header("Location: ./index.php"); die();}
if($_POST['portal'] == 'add_SA')
{
	if(!isset($_POST['user'],$_POST['password'],$_POST['prof'],$_POST['uni'])||!is_numeric($_POST['prof'])||!is_numeric($_POST['uni'])||$_POST['user']=="admin"||$_POST['user']=="Admin") {header("Location: ./AddSA.php?result=failed&error=Missing or invalid request."); die();}
	
	$name = mysqli_real_escape_string($connection,$_POST['user']);
	$password = mysqli_real_escape_string($connection,$_POST['password']);
	$desc = mysqli_real_escape_string($connection,$_POST['desc']);
	$prof_code = $_POST['prof'];
	$uni = $_POST['uni'];
	$web = mysqli_real_escape_string($connection,$_POST['web']);
	$sql="INSERT INTO `student_activity`(`SA_ID`, `Name`, `Desc`, `imgPath`, `password`, `website`, `prof_code`) VALUES (NULL,'$name','$desc',NULL,'$password','$web','$prof_code')";
	$result = mysqli_query($connection,$sql);
	if(!$result){header("Location: ./AddSA.php?result=failed&error=Failed to insert SA.");die();}
	$index = mysqli_insert_id($connection);
	$uploadResult = imageUpload('logo',$index);
	if($uploadResult['result']=='successful'){
		$sql="UPDATE `student_activity` SET `imgPath`='".$uploadResult['value']."' WHERE `SA_ID`=$index";
		mysqli_query($connection,$sql);
	}
	$sql = "INSERT INTO `registered_in`(`SA_ID`, `U_ID`) VALUES ('$index','$uni')";
	$result = mysqli_query($connection,$sql);
	if(!$result){header("Location: ./AddSA.php?result=failed&error=Failed to register in University.");die();}
	header("Location: ./AddSA.php?result=success");die();
}
if($_POST['portal'] == 'register')
{
	if(!is_numeric($_POST['st_act'])||!is_numeric($_POST['univ'])) {header("Location: ./register.php?result=failed&error=Missing or invalid request."); die();}
	$query = "INSERT INTO `db_project`.`registered_in`(`SA_ID`, `U_ID`) VALUES ('".$_POST['st_act']."', '".$_POST['univ']."');";
	$result = mysqli_query($connection, $query);
	
	if(!$result){header("Location: ./register.php?result=failed&error=Already registered.");die();}
	header("Location: ./register.php?result=success");die();
}

function imageUpload($uploadedimage,$imagename)
{
	$result = array();
	if (!empty($_FILES["$uploadedimage"]["name"])) {
		$file_name=$_FILES["$uploadedimage"]["name"];
		$temp_name=$_FILES["$uploadedimage"]["tmp_name"];
		$allowedExts = array("gif", "jpeg", "jpg", "png", "bmp","GIF", "JPEG", "JPG", "PNG", "BMP");
		$temp = explode(".", $_FILES["$uploadedimage"]["name"]);
		$ext = end($temp);
		$imgtype=$_FILES["$uploadedimage"]["type"];
		if ((($imgtype == "image/gif")
		|| ($imgtype == "image/bmp")
		|| ($imgtype == "image/jpeg")
		|| ($imgtype == "image/jpg")
		|| ($$imgtype == "image/pjpeg")
		|| ($imgtype == "image/x-png")
		|| ($imgtype == "image/png"))
		&& ($_FILES["$uploadedimage"]["size"] < 1000000)
		&& in_array($ext, $allowedExts)) {
			$imagename=$imagename.".".$ext;
			$target_path = "./img/".$imagename;
			/*if (file_exists("upload/" . $_FILES["file"]["name"])) {
				echo $_FILES["file"]["name"] . " already exists. ";
			  }*/
			if(move_uploaded_file($temp_name, $target_path)) {
				//$query_upload="INSERT into 'images_tbl' ('images_path','submission_date') VALUES ('".$target_path."','".date("Y-m-d")."')";
				//mysql_query($query_upload) or die("error in $query_upload == ====> ".mysql_error()); 
				$result['result'] = 'successful';
				$result['value'] = $target_path;
				return $result;
			}else{
				$result['result'] = 'failed';
				$result['error'] = 'Uploading';
				return $result;
			}
		} else {
				$result['result'] = 'failed';
				$result['error'] = 'File';
				return $result;
			}
	} else {
				$result['result'] = 'successful';
				$result['value'] = '';
				return $result;
			}
}
?> 