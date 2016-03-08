<?php
	session_start();
	require_once( 'sql-login.php' );
	//TODO remove this
	//$_SESSION['admin'] = 1;
	if(!isset($_SESSION['admin'])) {header("Location: ./index.php"); 
	die();
	}
?> 


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Add Activity</title>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="./css/bootstrap.min.css" >
  <link rel="stylesheet" href="./css/css.css" >
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
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
<script>
function generatePass() {
var generator = Math.random().toString(36).slice(2);
document.getElementById("password").value=generator;
}

</script>

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
            <li class="active"><a href="AddSA.php">Add Activity</a></li>
            <li><a href="register.php">Register in University</a></li>
            <li><a href="reports.php">Reports</a></li>
          </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Admin Panel</h1>
		  <h2 class="sub-header">Add Activity</h2>
          	<?php
			//handle input
				if(isset($_GET['result'],$_GET['error'])&&$_GET['result']=='failed'){
					echo '<div class="alert alert-danger col-sm-12 col-center fade in" dir="ltr">
						  <a href="#" class="close pull-right" data-dismiss="alert" aria-label="close">&times;</a>
						  <strong>Failed!</strong> '.$_GET['error'].'
						  </div>';
				} 
			?>
              <div class="panel panel-default col-sm-12" id="rcorners1">

                <div class="panel-body">
                
                <form role="form-horizontal" method="post" action="Admin-cmd.php" enctype="multipart/form-data">
                	<input type="hidden" name="portal" value="add_SA"/>
                    <div class="form-group">
                      <label for="user">Name</label>
                      <input type="text" class="form-control" id="user" name="user" required>
                    </div>
	
                    <div class="form-group">
                      <label for="password">Password:</label>
                      <input type="text" class="form-control" id="password" name="password" autocomplete="off" required>
                       <button type="button" class="btn btn-warning pull-right" onclick="generatePass();" style="margin:10px">Generate Password</button>
                    </div>

                    <!-- File Button --> 
                    <div class="form-group">
                      <label class="col-md-2 control-label" for="logo">Logo</label>
                        <input id="logo" name="logo" class="input-file" type="file" accept="image/*">
                    </div>



                    <div class="form-group">
                      <label for="prof">Professor</label>
                      <select class="form-control" id="prof" name="prof" required>
                              <?php
                                $query  = "SELECT `code`,`name` ";
                                $query .= "FROM `professor` ";
                                $result = mysqli_query($connection, $query);
                                
                                if ($result) {
                                    //echo "Success!";
                                } else {
                                    die("Database query failed. " . mysqli_error($connection));
                                }	
                                
                                while($row = mysqli_fetch_assoc($result)) {
                                echo '<option value="'.$row['code'].'">';   
                                echo $row['name']; 
                                echo "</option>";
                                }
                                    ?>
                       </select>
                	</div>

                    <div class="form-group">
                     	<label for="pos">University</label>
                          <select class="form-control" id="uni" name="uni" required>
                                  <?php
                                    $query  = "SELECT * ";
                                    $query .= "FROM `university`";
                                    $result = mysqli_query($connection, $query);
                                    
                                    if ($result) {
                                        //echo "Success!";
                                    } else {
                                        die("Database query failed. " . mysqli_error($connection));
                                    }	
                                    
                                    while($row = mysqli_fetch_assoc($result)) {
                                    echo '<option value="'.$row['U_ID'].'">';   
                                    echo $row['Name']; 
                                    echo "</option>";
                                    }
                                        ?>
                          </select>
                    
                    </div>
                    <div class="form-group">
                      <label for="web">Website</label>
                      <input type="text" class="form-control" id="web" name="web">
                    </div>
 
  
	  				<button type="submit" class="btn btn-warning pull-right">Create</button>
	 			</form>
                
                
                </div>
          </div>
  </div>
</div>
</body>

</html>