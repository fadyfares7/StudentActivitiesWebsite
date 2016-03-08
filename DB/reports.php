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
            <li><a href="admin.php">Admin Panel</a></li>
            <li><a href="AddSA.php">Add Activity</a></li>
            <li><a href="register.php">Register in University</a></li>
            <li class="active"><a href="reports.php">Reports</a></li>
          </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Admin</h1>

          <h2 class="sub-header">Reports</h2>
           <div class="row placeholders">
           
        </div>
		<?php
  // Create a database connection
  $dbhost = "localhost";
  $dbuser = "user";
  $dbpass = "123";
  $dbname = "db_project";
  $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
  // Test if connection occurred.
  if(mysqli_connect_errno()) {
    die("Database connection failed: " . 
         mysqli_connect_error() . 
         " (" . mysqli_connect_errno() . ")"
    );
  }

?> 
<?php
	$query  = "SELECT COUNT(*) as total ";
	$query .= "FROM `student` ";
	$result = mysqli_query($connection, $query);
	
	if ($result) {
		//echo "Success!";
	} else {
		die("Database query failed. " . mysqli_error($connection));
	}	
	$students = mysqli_fetch_assoc($result);
	echo "Total number of students = ";
	echo  $students['total'];
		echo "<br>";
?>

<?php
$query  = "DROP VIEW IF EXISTS `students_in_activities` ";
$result = mysqli_query($connection, $query);
	if ($result) {
		//echo "Success!";
	} else {
		die("Database query failed. " . mysqli_error($connection));
	}		
$query = "CREATE VIEW `students_in_activities` AS ";
$query .= "(SELECT  `S_ID`,`SA_ID` FROM `member`) UNION (SELECT DISTINCT `S_ID`,`SA_ID` FROM `participant` ) ";
	$result = mysqli_query($connection, $query);
	if ($result) {
		//echo "Success!";
	} else {
		die("Database query failed. " . mysqli_error($connection));
	}		
?>

<?php

	$query  = "SELECT COUNT(DISTINCT `S_ID`) as total ";
	$query .= "FROM `students_in_activities` ";
	
	$result = mysqli_query($connection, $query);
	
	if ($result) {
		//echo "Success!";
	} else {
		die("Database query failed. " . mysqli_error($connection));
	}	
	$st_sa = mysqli_fetch_assoc($result);
	echo "Total number of students in activities = ";
	echo  $st_sa['total'];
		echo "<br>"; 
?>

<?php
	$query  = "SELECT COUNT(DISTINCT `S_ID`) as total ";
	$query .= "FROM `member` ";
	$result = mysqli_query($connection, $query);
	
	if ($result) {
		//echo "Success!";
	} else {
		die("Database query failed. " . mysqli_error($connection));
	}	
	$members = mysqli_fetch_assoc($result);
	echo "Total number of members = ";
	echo  $members['total'];
		echo "<br>";
?>

<?php
	$query  = "SELECT COUNT(DISTINCT `S_ID`) as total ";
	$query .= "FROM `participant` ";
	$result = mysqli_query($connection, $query);
	
	if ($result) {
		//echo "Success!";
	} else {
		die("Database query failed. " . mysqli_error($connection));
	}	
	$participants = mysqli_fetch_assoc($result);
	echo "Total number of participants = ";
	echo  $participants['total'];
		echo "<br>";
?>
<?php
 echo "% of members = ";
 $memPer = ($members['total']/$students['total'])*100;
 echo $memPer;
 echo "%";
 echo "<br>";
?>
<?php
 echo "% of participants = ";
 $partPer = ($participants['total']/$students['total'])*100;
 echo $partPer;
 echo "%";
 echo "<br>";
?>
<?php
	$query  = "SELECT COUNT(*) as total ";
	$query .= "FROM `student_activity` ";
	$result = mysqli_query($connection, $query);
	
	if ($result) {
		//echo "Success!";
	} else {
		die("Database query failed. " . mysqli_error($connection));
	}	
	$activities = mysqli_fetch_assoc($result);
	echo "Total number of student activities = ";
	echo  $activities['total'];
		echo "<br>";
?>


<?php

	$query  = "SELECT `SA_ID`, COUNT(*) as total ";
	$query .= "FROM `students_in_activities` ";
	$query .= " GROUP BY `SA_ID` ";
	$result = mysqli_query($connection, $query);
	
	if ($result) {
		//echo "Success!";
	} else {
		die("Database query failed. " . mysqli_error($connection));
	}	
	while($count = mysqli_fetch_assoc($result)) {
		$sa_id=$count['SA_ID'];
		$query  = "SELECT `Name` ";
		$query .= "FROM `student_activity` ";
		$query .= "WHERE `SA_ID` = $sa_id ";
		$res = mysqli_query($connection, $query);
		$sa_name= mysqli_fetch_assoc($res); 
		echo "Total number of students in ";
		echo $sa_name['Name'];
		echo " = ";
		echo $count['total'];
		echo"<br>";
	}
?>
		<div id="pieChart"></div>

<script src="d3.min.js"></script>
<script src="d3pie.min.js"></script>
<script>
var activitesTot = '<?php echo $activities['total'];?>';
var studentsTot = '<?php echo $students['total'];?>';
var studentsInAct = '<?php echo $st_sa['total'];?>';
var members = '<?php echo $members['total'];?>';
var participatns =  '<?php echo $participants['total'];?>';
var pie = new d3pie("pieChart", {
	"header": {
		"title": {
			"text": "Members in Students",
			"fontSize": 24,
			"font": "open sans"
		},
		"subtitle": {
			"color": "#999999",
			"fontSize": 12,
			"font": "open sans"
		},
		"titleSubtitlePadding": 9
	},
	"footer": {
		"color": "#999999",
		"fontSize": 10,
		"font": "open sans",
		"location": "bottom-left"
	},
	"size": {
		"canvasWidth": 390,
		"pieInnerRadius": "71%",
		"pieOuterRadius": "77%"
	},
	"data": {
		"sortOrder": "value-desc",
		"content": [
			{

				"label": "Members In Student Activites",
				"value": parseInt(members),
				"color": "#2484c1"
			},
			{
				"label": "Not Member",
				"value":  parseInt(studentsTot) - parseInt(members),
				"color": "#0c6197"
			},
		]
	},
	"labels": {
		"outer": {
			"pieDistance": 32
		},
		"inner": {
			"hideWhenLessThanPercentage": 3
		},
		"mainLabel": {
			"fontSize": 11
		},
		"percentage": {
			"color": "#ffffff",
			"decimalPlaces": 0
		},
		"value": {
			"color": "#adadad",
			"fontSize": 11
		},
		"lines": {
			"enabled": true
		},
		"truncation": {
			"enabled": true
		}
	},
	"effects": {
		"pullOutSegmentOnClick": {
			"effect": "linear",
			"speed": 400,
			"size": 8
		}
	},
	"misc": {
		"gradient": {
			"enabled": true,
			"percentage": 100
		}
	}
});

var pie2 = new d3pie("pieChart", {
	"header": {
		"title": {
			"text": "Participants in Students",
			"fontSize": 24,
			"font": "open sans"
		},
		"subtitle": {
			"color": "#999999",
			"fontSize": 12,
			"font": "open sans"
		},
		"titleSubtitlePadding": 9
	},
	"footer": {
		"color": "#999999",
		"fontSize": 10,
		"font": "open sans",
		"location": "bottom-left"
	},
	"size": {
		"canvasWidth": 390,
		"pieInnerRadius": "71%",
		"pieOuterRadius": "77%"
	},
	"data": {
		"sortOrder": "value-desc",
		"content": [
			{

				"label": "Members In Student Activites",
				"value": parseInt(participatns),
				"color": "#2484c1"
			},
			{
				"label": "Not Participatn",
				"value":  parseInt(studentsTot) - parseInt(participatns),
				"color": "#0c6197"
			},
		]
	},
	"labels": {
		"outer": {
			"pieDistance": 32
		},
		"inner": {
			"hideWhenLessThanPercentage": 3
		},
		"mainLabel": {
			"fontSize": 11
		},
		"percentage": {
			"color": "#ffffff",
			"decimalPlaces": 0
		},
		"value": {
			"color": "#adadad",
			"fontSize": 11
		},
		"lines": {
			"enabled": true
		},
		"truncation": {
			"enabled": true
		}
	},
	"effects": {
		"pullOutSegmentOnClick": {
			"effect": "linear",
			"speed": 400,
			"size": 8
		}
	},
	"misc": {
		"gradient": {
			"enabled": true,
			"percentage": 100
		}
	}
});

</script>
		
      </div>
    </div>
</body>
</html>