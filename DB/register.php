<?php

  session_start();
	require_once( 'sql-login.php' );
	//TODO remove this
	//$_SESSION['SA_admin'] = 1;
	if(!isset($_SESSION['admin'])) {header("Location: ./index.php"); die();}
  
?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Link Student Activity to University</title>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="./css/bootstrap.min.css" >
  <link rel="stylesheet" href="./css/css.css" >
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="./js/bootstrap.min.js" ></script>
  <link rel="shortcut icon" href="./favicon.ico" type="image/x-icon" />
<style> 
#rcorners1 {
    border-radius: 15px;
    border: 1px solid #cccccc;
}
</style>
</head>

<body>


    <nav class="navbar navbar-fixed-top navbar-default">
      <div class="container-fluid">
        <div class="navbar-header">
          <button id="nav-toggle" type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a href="index.php">
          <img src="logo.png">
          </a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
          	<li><a id="logout" class="btn" href="logout.php">Logout</a></li>
          </ul>
          <form class="navbar-form navbar-right">
            <input type="text" class="form-control" placeholder="Search...">
          </form>
        </div>
      </div>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li><a href="admin.php">Admin Panel</a></li>
            <li><a href="AddSA.php">Add Activity</a></li>
            <li class="active"><a href="register.php">Register in University</a></li>
            <li><a href="reports.php">Reports</a></li>
          </ul>
    </div>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
<h1 class="page-header">Admin Panel</h1>
<h2 class="sub-header">Register Activity</h2>
<?php
//handle input
	if(isset($_GET['result'],$_GET['error'])&&$_GET['result']=='failed'){
		echo '<div class="alert alert-danger col-sm-12 col-center fade in" dir="ltr">
			  <a href="#" class="close pull-right" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Failed!</strong> '.$_GET['error'].'
			  </div>';
	} 
?>
   <div class="panel panel-default" id="rcorners1">
   
    <div class="panel-body">
	

 <form action="Admin-cmd.php" method="post">
 <input type="hidden" name="portal" value="register"/>
	<label for="st_act">Student Activity</label>
 <select class="form-control" id="st_act" name="st_act" required>
              <?php
                $query  = "SELECT `Name`, `SA_ID` ";
                $query .= "FROM `student_activity` ";
                $result = mysqli_query($connection, $query);
                
                if ($result) {
                    //echo "Success!";
                } else {
                    die("Database query failed. " . mysqli_error($connection));
                }	
                //echo '<option selected="selected" hidden>Select Student Activity</option>';
                while($row = mysqli_fetch_assoc($result)) {
                echo '<option value="'.$row['SA_ID'].'">';   
                echo $row['Name']; 
                echo "</option>";
                }
            ?>
</select>

<label for="univ" style = "padding-top: 10px">University</label>

<select class="form-control" id="univ" name="univ" required>
              <?php
                $query  = "SELECT `name`, `U_ID` ";
                $query .= "FROM `university` ";
                $result = mysqli_query($connection, $query);
                
                if ($result) {
                    //echo "Success!";
                } else {
                    die("Database query failed. " . mysqli_error($connection));
                }	
                //echo '<option selected="selected" hidden>Select University</option>';
                while($row = mysqli_fetch_assoc($result)) {
                echo '<option value="'.$row['U_ID'].'">';   
                echo $row['name']; 
                echo "</option>";
                }
            ?>
</select>  

<input type="submit" name="submit" value="Link" class="btn btn-warning pull-right" style="margin-top:15px;"></input>


</form>
</div>
</div>
</div>
</div>
</div>
</body>
</html>
