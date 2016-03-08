<?php
	session_start();
	require_once( 'sql-login.php' );
	
?> 

<!DOCTYPE html>

<head>
  <title>Events</title>
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
            <li><a href="activities.php">Activities</a></li>
            <li class="active"><a href="campaigns.php">Events</a></li>
          </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
					<div class="row placeholders">
          <?php
				
				$query  = "SELECT student_activity.SA_ID,student_activity.Name,campaign.Camp_Name,campaign_location.location,campaign.Start_Date,campaign.End_Date,student_activity.imgPath FROM `student_activity`,`campaign`,`campaign_location` WHERE `student_activity`.`SA_ID`=`campaign`.`SA_ID` AND `campaign`.`SA_ID`=`campaign_location`.`SA_ID` AND `campaign`.`Camp_Name`=`campaign_location`.`Camp_Name`";// GROUP BY `student_activity`.`SA_ID`";
				$result = mysqli_query($connection, $query);
				
				if ($result) {
					//echo "Success!";
				} else {
					die("Database query failed. " . mysqli_error($connection));
				}	
		while($events = mysqli_fetch_assoc($result)) {
			echo '	
           	  <div class="col-sm-6">
                <div class="panel panel-default">
                    <a href="campaign.php?sa='.$events["SA_ID"].'&camp='.$events['Camp_Name'].'" style="display:block">
                    	<div class="panel-body">
                        	<div class="col-sm-6">
                            <font color="gray"><h1><i>'.$events["Camp_Name"].'</i><h1></font>
                                <font color="gray"><h3><i>'.$events["Name"].'</i><h3></font>
                                <font color="gray"><h3><i>'.$events["location"].'</i><h3></font>
                                <font color="gray"><h3><i>'.$events["Start_Date"].' '.$events["End_Date"].'</i><h3></font>
                            </div>
                            <div class="col-sm-6">
                                <img src="'.$events["imgPath"].'" class="img" alt="activity logo" width="100%" height="236">
                            </div>
                       </div>
                    </a>
                </div>
				</div>
			  ';
			   }
			?>
			  </div>
		    </div>
          </div>	
        </div>
      </div>
</body>
</html>