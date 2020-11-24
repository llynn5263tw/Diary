<?php
	require("config.php");
	session_start();
	$name = $_POST['name'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	$con = @mysqli_connect($db_server,$db_user,$db_passwd,$db_name);
	mysqli_query($con, 'SET NAMES utf8');
	//mysql_select_db($db_name,$con);
	if($name!=NULL && $username!=NULL && $password!=NULL){
		$sql = "SELECT * FROM user WHERE username = '$username'";
		$result = mysqli_query($con, $sql);
		if(mysqli_num_rows($result)){
			echo '<script language="javascript">alert("此帳號已被使用，請重新輸入。");history.back();</script>';
		}else{
			$insert_sql = "INSERT INTO user(name,username,password) VALUES ('$name','$username','$password')";
			if(mysqli_query($con, $insert_sql)){
				$result2 = mysqli_query($con, $sql);
				$row = mysqli_fetch_assoc($result2);
				$_SESSION['id'] = $row['id'];
				$_SESSION['name'] = $row['name'];
				$_SESSION['username'] = $row['username'];
				$_SESSION['passwd'] = $row['password'];
				setcookie("session_id",$row['id'],time()+3600);
				echo '<script language="javascript">alert("註冊成功");top.location="main.php";</script>';
			}
		}
	}else{
		if($name==NULL){
			echo '<script language="javascript">alert("名字不得為空白");history.back();</script>';
		}else if($username==NULL){
			echo '<script language="javascript">alert("帳號不得為空白");history.back();</script>';
		}else if($password==NULL){
			echo '<script language="javascript">alert("密碼不得為空白");history.back();</script>';
		}
	}
?>