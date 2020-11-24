<?php
	header("content-type=text/html;charset=utf-8");

	$db_server = "localhost";
	$db_name = "diary";
	$db_user = "root";
	$db_passwd = "";
	
	$con = @mysqli_connect($db_server, $db_user, $db_passwd, $db_name);
	if(!$con)
        die("無法對資料庫連線");
	
	
	mysqli_query($con, 'SET NAMES utf8');

?> 