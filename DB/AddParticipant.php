<?php
	session_start();
	require_once( 'sql-login.php' );
	//TODO remove this
	//$_SESSION['SA_admin'] = 1;
	if(!isset($_SESSION['SA_admin'])) {header("Location: ./index.php"); die();}
?> 


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Add Participant</title>
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
#rcorners2 {
    border-radius: 0px 0px 15px 15px;
}
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
            <li><a id="home" class="btn" href="./activity.php?page=<?php echo $_SESSION['SA_admin']; ?>">Home</a></li>
            <li><a id="logout" class="btn" href="./logout.php">Logout</a></li>
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
            <li><a href="campaigns.php">Events</a></li>
          </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Activity Admin</h1>
		  <h2 class="sub-header">Add Participant</h2>
          	<?php
			//handle input
				if(isset($_GET['result'])&&$_GET['result']=='failed'){
					echo '<div class="alert alert-danger col-sm-12 col-center fade in" dir="ltr">
						  <a href="#" class="close pull-right" data-dismiss="alert" aria-label="close">&times;</a>
						  <strong>Failed!</strong> 
						  </div>';
				} 
			?>
              <div class="panel panel-default col-sm-12" id="rcorners1">

                <div class="panel-body">
                
                <form role="form-horizontal" method="post" action="SA-cmd.php">
                <input type="hidden" name="portal" value="add_participant"/>
                <input type="hidden" name="camp" value="<?php echo $_GET['camp'] ?>"/>
                <div class="form-group">
                  <label for="student">Name</label>
                  <input type="text" class="form-control" id="student" name="student" required>
                </div>
                
               
                <div class="form-group">
                  <label for="com">Track</label>
                  
                
            
            <select class="form-control" id="com" name="com" required>
              <?php
				$camp=mysqli_real_escape_string($connection,$_GET['camp']);
                $query  = "SELECT `Name`,`track`.`T_ID` ";
                $query .= "FROM `track`,`track_campaign` ";
                $query .= "WHERE `track`.`T_ID`=`track_campaign`.`T_ID` AND `SA_ID`='".$_SESSION['SA_admin']."' AND `Camp_Name`='$camp'";
                $result = mysqli_query($connection, $query);
                
                if ($result) {
                    //echo "Success!";
                } else {
                    die("Database query failed. " . mysqli_error($connection));
                }	
                
                while($row = mysqli_fetch_assoc($result)) {
                echo '<option value="'.$row['T_ID'].'">';   
                echo $row['Name']; 
                echo "</option>";
                }
                    ?>
                  </select>
            </div>
             
            
            
                
                <button type="submit" class="btn btn-warning pull-right">Enroll</button>
              </form>
                
                </div>
          </div>
  </div>
</div>
</body>

</html>