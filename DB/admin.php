<?php
	session_start();
	require_once( 'sql-login.php' );
	if(!isset($_SESSION['admin'])) {header("Location: ./index.php"); die();}
?>
<!DOCTYPE html>

<html>
	<head>
		<title>Admin</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="./css/bootstrap.min.css">
        <link rel="stylesheet" href="./css/css.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="./js/bootstrap.min.js"></script>
        <link rel="shortcut icon" href="./favicon.ico" type="image/x-icon" />
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
            <li class="active"><a href="admin.php">Admin Panel</a></li>
            <li><a href="AddSA.php">Add Activity</a></li>
            <li><a href="register.php">Register in University</a></li>
            <li><a href="reports.php">Reports</a></li>
          </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Admin</h1>

          <h2 class="sub-header">Navigation</h2>
           <div class="row placeholders">
           
        </div>
      </div>
    </div>
</body>
</html>