<?php
	include("islogin.php");
	require("config.php");
	session_start();
	$id = $_SESSION['id'];

	if(isset($_GET['did'])) {
		$did = $_GET['did'];
	}else{
		$did = $_SESSION['did'];
	}
	$sql = "call mydiary('$did');";
	$result = mysqli_query($con, $sql);
	$row = mysqli_fetch_array($result);
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" href="css/slick.css">
		<link rel="stylesheet" href="css/slick-theme.css">
	</head>
	<style>
		*{
			box-sizing:border-box;
		}
		body{
			margin:0;
		}
		a{
			text-decoration:none;
			color:#000000;
		}
		a:hover{
			color: #8E8E8E;
		}
		#header{
			height:20%;
		}
		.middle{
			margin:0px auto;
		}
		#diary{
			border-style:solid;
			border-width:2px;
			border-color:black;
			width:65%;
			min-height:300px;
			height:auto;
			font-size:20px;
			text-align:center;
			margin:0px auto;
		}
		#edit{
			display:none;
			border-style:solid;
			border-width:2px;
			border-color:black;
			width:65%;
			height:auto;
			font-size:20px;
			margin:0px auto;
		}
		.dupdate{
			width:90%;
			height:auto;
			font-size:20px;
			
			margin:0px auto;
		}
		.all{
			margin:0px auto;
			min-height:50%;
			height:auto;
			padding-top:15px;
		}
		#content{
			padding-left:10px;
			width:70%;
			min-height:30%;
			height:auto;
			text-align:left;
			word-break:break-all;
			margin:8% auto;
		}
		#date{
			margin:0px auto;
			font-size:16px;
			text-align:right;
			width:65%;
		}
		#footer{
			text-align:center;
			height:50px;
		}

		.link a{
			text-decoration: none;
			color: #000000;
		}
		.link a:hover{
			color: #8E8E8E;
		}
		.topnav {
			overflow: hidden;
			background-color: #333;
		}
		.topnav a {
			float: right;
			display: block;
			color: #f2f2f2;
			text-align: center;
			padding: 14px 16px;
			text-decoration: none;
		}
		.topnav a:hover {
			background-color: #ddd;
			color: black;
		}
		#footer{
			height:5%;
		}
		.row:after{
			content:"";
			display:table;
			clear:both;
		}
		@media screen and (max-width:600px) {
			.column.side, .column.middle, #mydiary, #sidebar, #upload {
				width: 100%;
				height: 100%
			}
		}
		.container{
			width:70%;
			height:60%;
			border-style:solid;
			border-width:2px;
			border-radius:10px;
			border-color:black;
			margin: 3% auto;
			background-color:#FCFCFC;
		}
		.container img{
			width:100%;
			height:100%;
			margin: 0 auto;
			object-fit:contain;
		}
		.slick-prev:before, .slick-next:before {
			color: #000000;
		}
		textarea{
			resize:none;
			width:100%;
			height:40%;
		}
		input{
			font-size: 18px;
		}
	</style>
	<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
	<script src="js/slick.js"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
	<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
	<script language="JavaScript">
		function logout(){
			var l = confirm("確定要登出嗎？");
			if(l==true){
				return true;
			}else{
				return false;
			}
		}
		function del(){
			var r = confirm("確定要刪除嗎？");
			if(r==true){
				return true;
			}else{
				return false;
			}
		}
		$(document).ready(function(){
			$(".container").slick({
					dots:true,
			});
			$(".fancybox").fancybox();
			$(".edit").click(function(){
				$("#diary").hide();
				$("#edit").slideDown();
				$("#title").val("<?php echo $row['title']; ?>");
				$("#textarea").val("<?php echo $row['content']; ?>");
			});
			$("#cancel").click(function(){
				$("#diary").slideDown();
				$("#edit").hide();
			});
		});
	</script>
	<body>
		<div id="header">
			<div style="float:left;padding:0 0 0.2% 1%"><a href="main.php"><img src="image/diary.png" /></a></div>
			<div style="float:right;padding:5.6% .5% 0 0"><p style="text-align:center;width:150px;font-size:18px">Hi~<?php echo $_SESSION["name"]?><a href=logout.php onclick="javascript:return logout()" style="font-size:18px">登出</a></p></div>
		</div>
		<div style="clear:both"></div>
		<div style="height:3px;background:black"></div>
		</br>
		</br>
		<div class="row">
		<div class="middle">
				<div id="diary">
					<div class="topnav">
						<a href="main.php" style="float:left">回上頁</a>
						<a href="delete.php?did=<?php echo $did; ?>" onclick="javascript:return del()">刪除</a>
						<a class="edit" href="#">編輯</a>
					</div>
					<div class="all">
						<?php if(!empty($row['pic1'])){ ?>
						<div class="container">
							<?php for($i=3;$i<=10;$i++){
								if(!empty($row[$i])){ ?>			
								<div>
									<a class="fancybox" href="<?php echo $row[$i]; ?>">
										<img src="<?php echo $row[$i]; ?>" alt="" />
									</a>
								</div>
							<?php }} ?>
						</div>
						<?php } ?>
						<div id="content"><p><?php echo $row['content']; ?></p></div>
						<div id="date"><p>編輯於 <?php echo $row['date']; ?></p></div>
					</div>
				</div>
				<div id="edit">
					<div class="topnav">
						<a id="cancel" href="#">取消編輯</a>
					</div>
					<div class="dupdate">
						<?php if(!empty($row['pic1'])){ ?>
							<div class="container">
								<?php for($i=3;$i<=10;$i++){
									if(!empty($row[$i])){ ?>			
									<div>
										<a class="fancybox" href="<?php echo $row[$i]; ?>">
											<img src="<?php echo $row[$i]; ?>" alt="" />
										</a>
									</div>
								<?php }} ?>
							</div>
						<?php } ?>
						<div style="margin:0px auto;width:70%;padding-top:45px">
							<form enctype="multipart/form-data" action="update.php?did=<?php echo $did; ?>" method="post">
								標題：<input type="text" name="title" id="title" style="font-size:18px" value="<?php echo $row['title']; ?>" />
								</br></br>
								日記撰寫：
								</br>
								<textarea name="content" id="textarea" style="font-size:18px"><?php echo $row['content']; ?></textarea>
								</br></br>
								<div style="text-align:center">
									<input type="submit" name="update" value="修改" />
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<div style="clear:both"></div>
			<div id="footer"></div>
		</div>
	</body>
</html>