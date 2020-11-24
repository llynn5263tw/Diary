<?php
	session_start();
	
	unset($_SESSION["id"]);
	unset($_SESSION["name"]);
	unset($_SESSION["username"]);
	unset($_SESSION["passwd"]);
	unset($_SESSION['did']);
	setcookie("session_id","",time()-3600);
	
	header("Location: index.html");
?>