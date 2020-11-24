<?php
	require("config.php");
	
	if(!isset($_COOKIE["session_id"])){
		header('Location: index.html');
		exit;
	}
	$id = $_COOKIE["session_id"];
	$con = @mysqli_connect($db_server,$db_user,$db_passwd,$db_name);
	//mysqli_query($con, 'SET NAMES utf8');
	
	$sql = "SELECT username FROM user WHERE id = '$id'";
	$result = mysqli_query($con,$sql);
	
	if(!mysqli_num_rows($result)){
		header("Location: index.html");
		exit;
	}
	
?>