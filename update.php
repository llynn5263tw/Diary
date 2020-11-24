<?php 
	include("islogin.php");
	session_start();

    ini_set("display_errors", "On");
	if (isset($_GET['did'])) {
		$did = $_GET['did'];
	}
	$title = $_POST['title'];
	$content = $_POST['content'];
	$getDate = date("y/m/d");

    require('config.php');
	
    $sql = "UPDATE mydiary SET title = '$title', content = '$content', date = '$getDate' WHERE did = '$did'";
	if(mysqli_query($con, $sql)){
		$_SESSION['did'] = $did;
		echo "<script language='javascript'>alert('修改成功');document.location.href='show.php';</script>";
	}
?>