<?php
	session_start();
	require_once( 'sql-login.php' );
	//TODO remove this
	//$_SESSION['SA_admin'] = 1;
	if(!isset($_GET['page'])||!is_numeric($_GET['page'])) {header("Location: ./activities.php"); die();}
	$SA_ID = $_GET['page'];
	$sql = "SELECT * FROM `student_activity` WHERE `SA_ID`=".$SA_ID;
	$result= mysqli_query($connection,$sql);
	if(!$result||mysqli_num_rows($result)==0) {header("Location: ./activities.php"); die();}
	$activity = mysqli_fetch_assoc($result);
	if(isset($_SESSION['SA_admin'])&&$_SESSION['SA_admin']==$SA_ID) $admin=1;
	else $admin=0;
?> 

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title><?php echo $activity['Name'];?></title>
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
		<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        	<div class="col-sm-3 col-md-2 sidebar">
              <ul class="nav nav-sidebar">
                <li><a href="index.php">DashBoard</a></li>
                <li><a href="activities.php">Activities</a></li>
                <li><a href="campaigns.php">Events</a></li>
              </ul>
       		</div>
 			<h1><?php echo $activity['Name'] ?></h1>
   			<div class="panel panel-default" id="rcorners1">
    			<div class="panel-body">
                    <img class="img-responsive pull-right" src="<?php echo $activity['imgPath'];?>" class="img-rounded" alt="Cinque Terre" width="100" height="100">
                    <h5><?php echo $activity['Name'] ?> </h5>
                    <p> <?php echo $activity['Desc'] ?></p>
                    
				</div>
    			 <?php
				$query  = "SELECT COUNT(*) AS total ";
				$query .= "FROM `campaign`";
				$query .= "WHERE `SA_ID`=$SA_ID ";
				$result = mysqli_query($connection, $query);
				$no_events = mysqli_fetch_assoc($result);
				
				$query  = "SELECT COUNT(*) AS total ";
				$query .= "FROM `member`";
				$query .= "WHERE `SA_ID`=$SA_ID ";
				$result = mysqli_query($connection, $query);
				$no_mem = mysqli_fetch_assoc($result);
				?>
                
    			<div class="panel-footer " id="rcorners2">
                    <span class="glyphicon glyphicon-calendar" ><?php echo $no_events['total'] ?></span>
                    <span class="glyphicon glyphicon-user"><?php echo $no_mem['total'] ?></span>
	
				</div>
  			</div>

<?php
if($admin==1){
echo '<div class="row">
<div class="col-sm-3 col-xs-12"><h1>Functions</h1></div>
<div class="col-sm-3 col-xs-12 pull-right"><a type="button" class="btn btn-warning btn-block pull-right" style="margin-top:30px; width=100%;" href="AddTrack.php">+New Track</a></div>
<div class="col-sm-3 col-xs-12 pull-right"><a type="button" class="btn btn-warning btn-block pull-right" style="margin-top:30px; width=100%;" href="AddCommittee.php">+New Committee</a></div>
</div>
<div class="row">
<a type="button" class="btn btn-warning pull-right" style="margin-top:30px;" href="AddMember.php">+New Member</a>
  <h1>Members</h1>

  <div class="table-responsive" id="rcorners1">
  <table class="table table-striped">
  
    <thead class="bg-primary">
      <tr>
	   <th>Code</th>
        <th>Member Name</th>  
        <th>Position</th>
        <th>Committee</th>
        <th>Email</th>
        <th>Phone</th>
		 <th></th>
		  <th></th>
      </tr>
    </thead>
    <tbody class="text-muted">';

	$query  = "SELECT `student`.`Name` as SName,`Code`,`E-mail`,`Phone_No`,`committee`.`Name` as CName,`Pos` ";
	$query .= "FROM `student`,`committee`,`member` ";
	$query .= "WHERE `committee`.`Com_ID`=`member`.`Com_ID` AND `student`.`Code`=`member`.`S_ID` AND `member`.`SA_ID`=$SA_ID ";
	$result = mysqli_query($connection, $query);
	
	if ($result) {
		//echo "Success!";
	} else {
		die("Database query failed. " . mysqli_error($connection));
	}	
	while($students = mysqli_fetch_assoc($result)) {
		echo "<tr>";
			echo  "<td>".$students['Code']."</td>";
			echo "<td>".$students['SName']. "</td>";
			echo "<td>".$students['Pos']. "</td>";
			echo "<td>".$students['CName']. "</td>";
		    echo "<td>".$students['E-mail']."</td>";
			echo "<td>".$students['Phone_No']."</td>";
			
			echo '<td>  <a href="#">';
    echo'   <span class="glyphicon glyphicon-edit"></span>';
      echo'  </a></td> ';
		echo' <td>  <a href="#"> ';
       echo'   <span class="glyphicon glyphicon-remove"></span>';
      echo'  </a></td> ';
			
		 echo "</tr>";
	}
echo "</tbody></table></div></div>";
}
?>


<div class="row" style="margin-top:20px">

<?php if($admin==1){
echo'<a href="./AddCampaign.php" class="btn btn-warning pull-right" style="margin-top:30px;">+New Event</a>';

}?>
  <h1>Events</h1>
  
 
  <div class="table-responsive" id="rcorners1">
  <table class="table table-striped">
  
    <thead class="bg-primary">
      <tr>
        <th>Campagin Name</th>
        <th>Start Date</th>
        <th>End Date</th>
        <th>Location</th>
        <?php if($admin==1){
		echo'<th>Add Participants</th><th></th>';
		}?>
      </tr>
    </thead>
    <tbody class="text-muted">
    
    <?php
	$query  = "SELECT `campaign`.`Camp_Name`,`Start_Date`,`End_Date`,`location` ";
	$query .= "FROM `campaign`,`campaign_location`";
	$query .= "WHERE `campaign`.`Camp_Name`=`campaign_location`.`Camp_Name`  AND `campaign`.`SA_ID`=$SA_ID ";
	$result = mysqli_query($connection, $query);
	
	if ($result) {
		//echo "Success!";
	} else {
		die("Database query failed. " . mysqli_error($connection));
	}	
	
	while($events = mysqli_fetch_assoc($result)) {
		echo "<tr>";
			echo  "<td>".$events['Camp_Name']."</td>";
			echo "<td>".$events['Start_Date']. "</td>";
			echo "<td>".$events['End_Date']. "</td>";
			echo "<td>".$events['location']. "</td>";
				if($admin==1){
	echo '<td>  <a href="AddParticipant.php?camp='.$events['Camp_Name'].'">';
    echo'   <span class="glyphicon glyphicon-edit"></span>';
      echo'  </a></td> ';
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
