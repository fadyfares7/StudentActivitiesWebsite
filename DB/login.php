<?php
session_start();
	require_once( 'sql-login.php' );
/*$_SESSION['SA_admin']=1;
header("Location: ./index.php");*/
if(isset($_POST['user'],$_POST['pass'])&&$_POST['user']!=''&&$_POST['pass']!=''){
	$user = mysqli_real_escape_string($connection,$_POST['user']);
	$pass = mysqli_real_escape_string($connection,$_POST['pass']);
	if($user=="Admin"&&$pass=="0159"){
		$_SESSION['admin']=1;
		header("Location: ./admin.php");
	}
	$sql="SELECT `SA_ID` FROM `student_activity` WHERE `Name`='$user' AND `password`='$pass'";
	$result = mysqli_query($connection,$sql);
	if($result&&$result=mysqli_fetch_row($result)){
		$_SESSION['SA_admin']=$result[0];
		header("Location: ./activity.php?page=$result[0]");
		die();
	}
	
}
?>
<!DOCTYPE html>

<html lang="ar-eg" dir="rtl">
	<head>
		<title>News feed</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="./css/bootstrap.min.css">
        <link rel="stylesheet" href="./css/css.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="./js/bootstrap.min.js"></script>
        <link rel="shortcut icon" href="./favicon.ico" type="image/x-icon" />
        <style>
		body {
		  padding-top: 40px;
		  padding-bottom: 40px;
		  background-color: #eee;
		}
		.form-signin {
		  max-width: 330px;
		  padding: 15px;
		  margin: 0 auto;
		}
		.form-signin .form-signin-heading,
		.form-signin .checkbox {
		  margin-bottom: 10px;
		}
		.form-signin .form-control {
		  position: relative;
		  height: auto;
		  -webkit-box-sizing: border-box;
			 -moz-box-sizing: border-box;
				  box-sizing: border-box;
		  padding: 10px;
		  font-size: 16px;
		}
		.form-signin .form-control:focus {
		  z-index: 2;
		}
		.form-signin input[type="text"] {
		  margin-bottom: 5px;
		  border-bottom-right-radius: 0;
		  border-bottom-left-radius: 0;
		}
		</style>
</head>


<body>
	<div class="container-fluid">
    	<div class="form-signin">
        <h2 class="form-signin-heading" dir="ltr">Login</h2>
        <form method="post">
        <label for="user" class="sr-only">Activity Name</label>
        <input type="text" id="user" name="user" class="form-control" dir="ltr">
        <label for="pass" class="sr-only">Password</label>
        <input type="password" id="pass" name="pass" class="form-control" dir="ltr">
        <button class="btn btn-lg btn-primary btn-block" type="submit" style="margin-top:15px;">Sign in</button>
        </form>

        </div>
      </div>
<br />
</div>
</body>
</html>