<?php
	session_start();
	if(isset($_GET['did'])){
		$did = $_GET['did'];
	}
	require("config.php");
	//$con = @mysqli_connect($db_server,$db_user,$db_passwd,$db_name);
	//mysqli_query($con, 'SET NAMES utf8');
	//mysql_select_db($db_name,$con);
	$sql = "DELETE FROM pictures WHERE did = '$did'";
	if(mysqli_query($con, $sql)){
		$sql = "DELETE FROM mydiary WHERE did = '$did'";
		if(mysqli_query($con, $sql)){
			header("Location:main.php");
		}
	}
?>