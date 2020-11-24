<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
	require("config.php");
	session_start();
	
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	$con = @mysqli_connect($db_server,$db_user,$db_passwd,$db_name);
	mysqli_query($con, 'SET NAMES utf8');

	$sql = "SELECT * FROM user WHERE username = '$username'";
	$result = mysqli_query($con,$sql);
	if(mysqli_num_rows($result)){
		$row = mysqli_fetch_row($result);
		if($row[3]==$password){
			$_SESSION['id'] = $row[0];
			$_SESSION['name'] = $row[1];
			$_SESSION['username'] = $row[2];
			$_SESSION['passwd'] = $row[3];
			setcookie("session_id",$row[0],time()+3600);
			echo "登入成功！";
			header("Location: main.php");
		}else{
			echo ('<script language="JavaScript">alert("密碼錯誤，請再次輸入。");history.back();</script>');
			
		}
	}else{
		echo "<script language='JavaScript'>alert('使用者名稱不存在，請再次輸入。');</script>";
	}
?>