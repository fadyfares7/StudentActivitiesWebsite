<?php
	session_start();
	require_once( 'sql-login.php' );
	//TODO remove this
	//$_SESSION['SA_admin'] = 1;
	if(!isset($_GET['sa'],$_GET['camp'])||!is_numeric($_GET['sa'])) {header("Location: ./campaigns.php"); die();}
	$SA_ID = $_GET['sa'];
	$Camp_Name = mysqli_real_escape_string($connection,$_GET['camp']);
	
	$sql = "SELECT * FROM `campaign` WHERE `SA_ID`='$SA_ID' AND Camp_Name='$Camp_Name';";;
	$result= mysqli_query($connection,$sql);
	if(!$result||mysqli_num_rows($result)==0) {header("Location: ./campaigns.php"); die();}
	$campaign = mysqli_fetch_assoc($result);
	
	$sql = "SELECT * FROM `student_activity` WHERE `SA_ID`='$SA_ID';";;
	$result= mysqli_query($connection,$sql);
	$activity = mysqli_fetch_assoc($result);
	
	if(isset($_SESSION['SA_admin'])&&$_SESSION['SA_admin']==$SA_ID) $admin=1;
	else $admin=0;
	
?> 

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title><?php echo $Camp_Name;?></title>
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
          <?php if(isset($_SESSION['SA_admin'])){
			  echo '<li><a id="home" class="btn" href="./activity.php?page='.$_SESSION['SA_admin'].'">Home</a></li><li><a id="logout" class="btn" href="./logout.php">Logout</a></li>';
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
		<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        	<div class="col-sm-3 col-md-2 sidebar">
              <ul class="nav nav-sidebar">
                <li><a href="index.php">DashBoard</a></li>
                <li><a href="activities.php">Activities</a></li>
                <li><a href="campaigns.php">Events</a></li>
              </ul>
       		</div>
   			<div class="panel panel-default" id="rcorners1">
    			<div class="panel-body">
                    <img class="img-responsive pull-right" src="<?php echo $activity['imgPath'];?>" class="img-rounded" alt="Cinque Terre" width="100" height="100">
                    <h2><?php echo $campaign['Camp_Name'] ?> </h2>
					<h4><?php echo $activity['Name'] ?> </h4>
                    <h4> <?php echo $campaign['Start_Date']; echo "  -  ".$campaign['End_Date'] ?></h4>

				</div>
  			</div>


<div class="row" style="margin-top:20px">
  <h1>Locations</h1>
  
 
  <div class="table-responsive" id="rcorners1">
  <table class="table table-striped ">
  
    <thead class="bg-primary">
      <tr>
        <th>Location</th>
        <?php if($admin==1){
		echo'<th></th>';
		}?>
      </tr>
    </thead>
    <tbody class="text-muted">
    <?php
	
	$query  = "SELECT `location` ";
	$query .= "FROM `campaign_location`";
	$query .= "WHERE `Camp_Name`='$Camp_Name'  AND `SA_ID`=$SA_ID ";
	$result = mysqli_query($connection, $query);
	
	
	while($temp = mysqli_fetch_assoc($result)) {
		echo "<tr>";
			//echo  "<td>".$temp['Camp_Name']."</td>";
			echo "<td>".$temp['location']. "</td>";
				if($admin==1){
		echo' <td>  <a href="#"> ';
       echo'   <span class="glyphicon glyphicon-remove"></span>';
      echo'  </a></td> ';
    echo'  </tr>';
				}
	}
	?>
	</table>
	</div>
	<h1>Tracks</h1>
 
  <div class="table-responsive" id="rcorners1">
  <table class="table table-striped ">
  
    <thead class="bg-primary">
      <tr>
        <th>Track</th>
        <th>Description</th>
        <?php if($admin==1){
		echo'<th></th>';
		}?>
      </tr>
    </thead>
    <tbody class="text-muted">
    
    <?php
	
	$query  = "SELECT `track`.`Name`,`Description`";
	$query .= "FROM `track`,`track_campaign`";
	$query .= "WHERE `track_campaign`.`Camp_Name`='$Camp_Name' AND `track_campaign`.`SA_ID` = '$SA_ID'  AND `track`.`T_ID`= `track_campaign`.`T_ID` ";
	$result2 = mysqli_query($connection, $query);
	if ($result2) {
		//echo "Success!";
	} else {
		die("Database query failed. " . mysqli_error($connection));
	}	
	
	
	while($events_tracks = mysqli_fetch_assoc($result2)) {
		echo "<tr>";
			
			echo "<td>".$events_tracks['Name']. "</td>";
			echo "<td>".$events_tracks['Description']. "</td>";
				if($admin==1){
		echo' <td>  <a href="#"> ';
       echo'   <span class="glyphicon glyphicon-remove"></span>';
      echo'  </a></td> ';
    echo'  </tr>';
				}
	}
?>
		 
     
    </tbody>
  </table>
  
   </div>
</div>
</div>
</div>
</div>
</body>
</html>
