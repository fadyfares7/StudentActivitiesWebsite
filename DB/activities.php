<?php
	session_start();
	require_once( 'sql-login.php' );


?> 

<!DOCTYPE html>

<head>
  <title>Activities</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="./css/bootstrap.min.css" >
  <link rel="stylesheet" href="./css/css.css" >
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="./js/bootstrap.min.js" ></script>
  <link rel="shortcut icon" href="./favicon.ico" type="image/x-icon" />
</head>
<body>


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
          <?php if(isset($_SESSION['SA_admin'])){
			  echo '<li><a id="home" class="btn" href="activity.php?page='.$_SESSION['SA_admin'].'">Home</a></li><li><a id="logout" class="btn" href="logout.php">Logout</a></li>';
		  }
		  else echo'<li><a id="login" class="btn" href="login.php">I\'m a Student Activity</a></li>';?>
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
            <li><a href="index.php">DashBoard</a></li>
            <li class="active"><a href="activities.php">Activities</a></li>
            <li><a href="campaigns.php">Events</a></li>
          </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
			<div class="row placeholders">
          <?php
				$query  = "SELECT *";
				$query .= "FROM `student_activity` ";
				$result = mysqli_query($connection, $query);
				
				if ($result) {
					//echo "Success!";
				} else {
					die("Database query failed. " . mysqli_error($connection));
				}	
			while($activity = mysqli_fetch_assoc($result)) {
			  echo '
			  <div class="col-sm-3">
                    <div class="panel panel-default no-padding" style="background-color:white;" >
                        <a href="activity.php?page='.$activity["SA_ID"].'" class="ui-btn ui-btn-inline ui-corner-all ui-shadow">
                        <img src="'.$activity["imgPath"].'" class="img" alt=" logo" width="100%" height="236">
                        <div class="panel-footer" style="background-color:gray;">'.$activity["Name"].'</div></a>
                    </div>
               </div>
			   	';
			   }
			?>
            </div>	
        </div>
      </div>
    </div>
</body>
</html>