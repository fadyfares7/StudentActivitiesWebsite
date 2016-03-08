<?php
	session_start();
	require_once( 'sql-login.php' );
	//TODO remove this
	//$_SESSION['SA_admin'] = 1;
	if(!isset($_SESSION['SA_admin'])) {header("Location: ./index.php"); die();}

if(!isset($_POST['portal'])) {header("Location: ./index.php"); die();}
if($_POST['portal'] == 'add_member')
{
	if(!isset($_POST['student'],$_POST['pos'],$_POST['com'])||!is_numeric($_POST['com'])) {header("Location: ./AddMember.php"); die();}
	$student = mysqli_real_escape_string($connection,$_POST['student']);
	$pos = mysqli_real_escape_string($connection,$_POST['pos']);
	$com = $_POST['com'];
	$sql = "SELECT `Code` FROM `student` WHERE `Name` = '$student'";
	$result = mysqli_query($connection,$sql);
	if($result && $row = mysqli_fetch_row($result)){
		$code = $row[0];
	}
	$sql = "SELECT `Com_ID` FROM `committee` WHERE `Name` = '$com'";
	$result = mysqli_query($connection,$sql);
	if($result && $row = mysqli_fetch_row($result)){
		$com = $row[0];
	}
	if(isset($code,$com)){
		$sql = "INSERT INTO `member`(`S_ID`, `SA_ID`, `Com_ID`, `Pos`) VALUES ('$code','".$_SESSION['SA_admin']."','$com','$pos')";
		$result = mysqli_query($connection,$sql);
		if($result){
			header("Location: ./AddMember.php?result=success");
			die();
		}
	}
	header("Location: ./AddMember.php?result=failed");
	die();
}
//add participant
if($_POST['portal'] == 'add_participant')
{
	if(!isset($_POST['camp'],$_POST['track'],$_POST['student'])||!is_numeric($_POST['track'])) {header("Location: ./AddParticipant.php"); die();}
	$student = mysqli_real_escape_string($connection,$_POST['student']);
	$camp = mysqli_real_escape_string($connection,$_POST['camp']);
	$track = $_POST['track'];
	$sql = "SELECT `Code` FROM `student` WHERE `Name` = '$student'";
	$result = mysqli_query($connection,$sql);
	if($result && $row = mysqli_fetch_row($result)){
		$code = $row[0];
	}
	$sql = "SELECT * FROM `track_campaign` WHERE `SA_ID` = '".$_SESSION['SA_admin']."' AND `Camp_Name` = '$camp' AND `T_ID` = '$track'";
	$result = mysqli_query($connection,$sql);
	if($result && mysqli_num_rows($result)!=0){
		if(isset($code)){
			$sql= "INSERT INTO `participant`(`S_ID`, `SA_ID`, `T_ID`) VALUES ('$code','".$_SESSION['SA_admin']."','$track')";
			$result = mysqli_query($connection,$sql);
			if($result){
				header("Location: ./AddParticipant.php?result=success");
				die();
			}
		}
	}
	header("Location: ./AddParticipant.php?result=failed");
	die();
}

// add track
if($_POST['portal'] == 'add_track')
{
	if(!isset($_POST['tname'],$_POST['description'])) {header("Location: ./AddTrack.php"); die();}
	$tname = mysqli_real_escape_string($connection,$_POST['tname']);
	$description = mysqli_real_escape_string($connection,$_POST['description']);
	$sql = "INSERT INTO `track`(`T_ID`,`Name`,`Description`) VALUES (NULL,'$tname','$description')";
	$result = mysqli_query($connection,$sql);
	if($result){
		header("Location: ./AddTrack.php?result=success");
		die();
	}
	header("Location: ./AddTrack.php?result=failed");
	die();
}
//add committee
if($_POST['portal'] == 'add_committee')
{
	if(!isset($_POST['comname'],$_POST['description'])) {header("Location: ./AddCommittee.php"); die();}
	$comname = mysqli_real_escape_string($connection,$_POST['comname']);
	$description = mysqli_real_escape_string($connection,$_POST['description']); 

	$sql = "SELECT `Com_ID` FROM `committee` WHERE `Name`='$comname'";
	$result = mysqli_query($connection,$sql);
	if($row=mysqli_fetch_row($result)) $id=$row[0];
	else{
		$sql = "INSERT INTO `committee`(`Com_ID`,`Name`,`Description`) VALUES (NULL,'$comname','$description')";
		$result = mysqli_query($connection,$sql);
		if(!$result){
			header("Location: ./AddCommittee.php?result=failed");
			die();
		}
		$id=mysqli_insert_id($connection);
	}
	$sql = "INSERT INTO `sa_committee`(`SA_ID`, `Com_ID`) VALUES ('".$_SESSION['SA_admin']."','$id')";
	$result = mysqli_query($connection,$sql);
	if($result){
		header("Location: ./AddCommittee.php?result=success");
		die();
	}
	header("Location: ./AddCommittee.php?result=failed");
	die();
}

//add campaign
if($_POST['portal'] == 'add_campaign')
{
	if(!isset($_POST['name'],$_POST['location'],$_POST['start'],$_POST['end'],$_POST['tracks'])) {header("Location: ./AddCampaign.php"); die();}
	$name = mysqli_real_escape_string($connection,$_POST['name']);
	$start = mysqli_real_escape_string($connection,$_POST['start']);
	$end = mysqli_real_escape_string($connection,$_POST['end']);

	$loc = preg_split("/\\r\\n|\\r|\\n/", $_POST['location'] );
	foreach($_POST['tracks'] as $value){
		if(!is_numeric($value)) {header("Location: ./AddCampaign.php"); die();}
	}
	$sql = "INSERT INTO `campaign`(`SA_ID`, `Camp_Name`, `Start_Date`, `End_Date`) VALUES ('".$_SESSION['SA_admin']."','$name','$start','$end')";
	$result = mysqli_query($connection,$sql);
	if($result){
		$sql = "INSERT INTO `campaign_location`(`SA_ID`, `Camp_Name`, `location`) VALUES ";
		foreach($loc as $value){
			$svalue = mysqli_real_escape_string($connection,$value);
			$sql .= "('".$_SESSION['SA_admin']."','$name','$svalue'),";	
		}
		$sql = rtrim($sql,",");
		$sql .= ";";
		$result = mysqli_query($connection,$sql);
		
		$sql = "INSERT INTO `track_campaign`(`SA_ID`, `Camp_Name`, `T_ID`) VALUES ";
		foreach($_POST['tracks'] as $value){
			$sql .= "('".$_SESSION['SA_admin']."','$name','$value'),";	
		}
		$sql = rtrim($sql,",");
		$sql .= ";";
		$result = mysqli_query($connection,$sql);
		header("Location: ./AddCampaign.php?result=success");
		die();
	}
	
	header("Location: ./AddCampaign.php?result=failed");
	die();
}

?> 