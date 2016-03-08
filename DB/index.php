	<!--
<?php
	session_start();
	require_once( 'sql-login.php' );
?>
-->

<!DOCTYPE html>

<html>
	<head>
		<title>DashBoard</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="./css/bootstrap.min.css">
        <link rel="stylesheet" href="./css/css.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="./js/bootstrap.min.js"></script>
        <link rel="shortcut icon" href="./favicon.ico" type="image/x-icon" />
</head>


  <body style = "background-color:#EAEAEA;">

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
            <li class="active"><a href="index.php">DashBoard</a></li>
            <li><a href="activities.php">Activities</a></li>
            <li><a href="campaigns.php">Events</a></li>
          </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Dashboard</h1>
		  <h2 class="sub-header">Activities</h2>
              <div class="row placeholders">
				<?php 
				$sql = "SELECT `SA_ID`, `Name`, `imgPath` FROM `student_activity` ORDER BY RAND() LIMIT 3";
				$result = mysqli_query($connection,$sql);
				while($row = mysqli_fetch_assoc($result)){
                echo '<div class="col-sm-3">
                    <div class="panel panel-default no-padding" style="background-color:#F9F9F9; border-radius:15px;" >
                        <a href="activity.php?page='.$row['SA_ID'].'" class="ui-btn ui-btn-inline ui-corner-all ui-shadow">
                        <img src="'.$row['imgPath'].'" class="img" alt="logo" width="100%" height="192px" style="margin-top:12px;">
                        <div class="panel-footer" style="background-color:gray; border-radius:0px 0px 15px 15px">'.$row['Name'].'</div></a>
                    </div>
                </div>';
				}
				?>
                <div class="col-sm-3">
                    <div class="panel panel-default no-padding" style="background-color:#8A8A8A; border-radius:15px; height:233px;"  >  
                    <a href="activities.php" class="ui-btn ui-btn-inline ui-corner-all ui-shadow">
                    <div class="carousel-caption"><h1 class="text-align" style="margin-top:-150px">more..</h1></div></a>
                    </div>
               </div>
			<div class="col-sm-12" style="text-align: left;">
          <h2 class="sub-header">Events</h2>
		  </div>
           <div class="row placeholders">
           <?php
		   		$query  = "SELECT student_activity.SA_ID,student_activity.Name,campaign.Camp_Name,campaign_location.location,campaign.Start_Date,campaign.End_Date,student_activity.imgPath FROM `student_activity`,`campaign`,`campaign_location` WHERE `student_activity`.`SA_ID`=`campaign`.`SA_ID` AND `campaign`.`SA_ID`=`campaign_location`.`SA_ID` AND `campaign`.`Camp_Name`=`campaign_location`.`Camp_Name` ORDER BY RAND() LIMIT 3";
				$result = mysqli_query($connection,$query);
				while($row = mysqli_fetch_assoc($result)){
           echo'<div class="col-sm-6">
                <div class="panel panel-default" style="background-color:#F7F7F7; border-radius:15px;">
                    <a href="campaign.php?sa='.$row["SA_ID"].'&camp='.$row['Camp_Name'].'" style="display:block">
                    	<div class="panel-body">
                        	<div class="col-sm-6">
                            <font color="gray"><h2><i>'.$row["Camp_Name"].'</i><h1></font>
                                <font color="gray"><h4><i>'.$row["Name"].'</i><h3></font>
                                <font color="gray"><h4><i>'.$row["location"].'</i><h3></font>
                                <font color="gray"><h4><i>'.$row["Start_Date"].' : '.$row["End_Date"].'</i><h3></font>
                            </div>
                            <div class="col-sm-6">
                                <img src="'.$row["imgPath"].'" class="img" alt="meca logo" width="100%" height="100%" style="margin-top:15px;" >
                            </div>
                       </div>
                    </a>
                </div>
              </div>';
				}
			  ?>
           <div class="col-sm-6">
                <div class="panel panel-default no-padding" style="background-color:#999;height:232px; border-radius:15px;s">
                    <a href="campaigns.php" style="display:block">
                    	<div class="panel-body no-padding">
                            	<h1 style="margin-top:97px; margin-bottom:120px;"> More ...</h1>
                       </div>
                    </a>
                </div>
              </div>
           </div>
        </div>
      </div>
    </div>
</body>
</html>