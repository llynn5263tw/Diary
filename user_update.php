<?php
	include("islogin.php");
	session_start();
	
	$name = $_POST['name'];
	$_SESSION['name'] = $name;
	$username = $_POST['username'];
	$_SESSION['username'] = $username;
	$id = $_SESSION['id'];
	
	if(isset($_POST['password'])){
		$passwd = $_POST['password'];
		$sql = "UPDATE user SET name = '$name', username = '$username', password = '$passwd' WHERE id = '$id'";
		$_SESSION['passwd'] = $passwd;
	}else{
		$sql = "UPDATE user SET name = '$name', username = '$username' WHERE id = '$id'";
	}
	
	require("config.php");
	
	if(mysqli_query($con, $sql)){
		echo "<script language='javascript'>alert('修改成功');document.location.href='main.php';</script>";
	}else{
		die(mysqli_error());
	}
?>