<?php
	include("islogin.php");
	session_start();
	$id = $_SESSION['id'];
	require("config.php");

	$sql = "SELECT mydiary.did, mydiary.title, pictures.pic1 FROM mydiary, pictures WHERE mydiary.id = '$id' AND mydiary.did = pictures.did ORDER BY did DESC";
	$result = mysqli_query($con, $sql);
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	</head>
	<style type="text/css">
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
		.column{
			float:left;
			padding:10px;
		}
		.column.side{
			width:18.5%;
			text-align:center;
		}
		.column.middle{
			width:75%;
			height:auto;
		}
		#sidebar{
			width:68%;
			min-height:33%;
			height:auto;
			border-style:solid;
			border-width:2px;
			border-color:black;
			margin-left:30%;
		}
		#mydiary{
			border-style:solid;
			border-width:2px;
			border-color:black;
			width:80%;
			min-height:65%;
			height:auto;
			font-size:20px;
			padding:50px;
			text-align:center;
			margin:0px auto;
		}
		.image{
			display: inline-block;
			text-align:center;
			width:220px;
			height:250px;
			object-fit:cover;
			border-style:solid;
			border-width:2px;
			border-color:black;
		}
		#upload{
			display:none;
			border-style:solid;
			border-width:2px;
			border-color:black;
			width:80%;
			height:auto;
			font-size:20px;
			padding:50px;
			margin:0px auto;
		}
		#mymember{
			display:none;
			border-style:solid;
			border-width:2px;
			border-color:black;
			width:80%;
			height:auto;
			font-size:20px;
			padding:50px;
			margin:0 auto;
		}
		.footer{
			height:5%;
		}
		.container:hover .image{
			transform: scale(1.1);
		}
		.row:after {
			content:"";
			display:table;
			clear:both;
		}
		@media screen and (max-width:600px) {
			.column.side, .column.middle, #mydiary, #sidebar, #upload, #mymember {
				width: 100%;
				margin:0px auto;
			}
		}
		.container {
			position: relative;
			float:left;
			margin:21px;
		}
		.overlay {
			position: absolute;
			top: 0;
			bottom: 0;
			left: 0;
			right: 0;
			height: 100%;
			width: 100%;
			opacity: 0;
			transition: .5s ease;
			background-color:#272727;
			border-style:solid;
			border-width:2px;
			border-color:black;
		}

		.container:hover .overlay {
			opacity:0.8;
			transform: scale(1.1);
		}

		.text {
			color: white;
			font-size: 18px;
			position: absolute;
			top: 50%;
			left: 50%;
			transform: translate(-50%, -50%);
			-ms-transform: translate(-50%, -50%);
		}
		textarea{
			resize:none;
			width:85%;
			height:40%;
		}
		#editpw{
			display:none;
			padding:15px;
			margin:0px auto;
			text-align:center;
		}
		input{
			font-size: 18px;
		}
	</style>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script language="JavaScript">
		function logout(){
			var r = confirm("確定要登出嗎？");
			if(r==true){
				return true;
			}else{
				return false;
			}
		}
		$(document).ready(function(){
			$("#dload").click(function(){
				$("#upload").slideDown();
				$("#mydiary").hide();
				$("#mymember").hide();
			});
			$("#mdiary").click(function(){
				$("#mydiary").slideDown();
				$("#upload").hide();
				$("#mymember").hide();
			});
			$("#member").click(function(){
				$("#mymember").slideDown();
				$("#mydiary").hide();
				$("#upload").hide();
			});
			$("button").click(function(){
				$("#editpw").toggle(250);
				if($(this).text()=="修改密碼"){
					$(this).text("取消修改");
					$("#oldpassword").attr('disabled',false);
					$("#password").attr('disabled',false);
					$("#repassword").attr('disabled',false);
				}else{
					$(this).text("修改密碼");
					$("#oldpassword").attr('disabled',true);
					$("#password").attr('disabled',true);
					$("#repassword").attr('disabled',true);
					$("#oldpassword").val("");
					$("#password").val("");
					$("#repassword").val("");
				}
			});
		});
		
		function checkoldpas(){
			var pas = document.getElementById("oldpassword");
			var paswd = "<?php echo $_SESSION['passwd']; ?>";
			if(pas.value!=paswd){
				pas.setCustomValidity("密碼錯誤");
				pas.reportValidity();
			}else{
				pas.setCustomValidity('');
			}
		}
		function checkpas(){
			var pas1 = document.getElementById("password");
			var pas2 = document.getElementById("repassword");
			if(pas1.value!=pas2.value && pas2.value!=""){
				pas2.setCustomValidity("密碼不一致");
				pas2.reportValidity();
			}
			else{
				pas2.setCustomValidity('');
			}
		}
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
			<div class="column side">
				<div id="sidebar">
					<strong><p style="font-size:30px">功能選單</p></strong>
					<div style="width:92.5%;height:3px;background:black;margin:0px auto;"></div>
					<strong><p style="font-size:25px" id="mdiary" class="link"><a href="#">我的日記</a></p></strong>
					<strong><p style="font-size:25px" id="dload" class="link"><a href="#">上傳日記</a></p></strong>
					<strong><p style="font-size:25px" id="member" class="link"><a href="#">個人資料</a></p></strong>
				</div>
			</div>
			<div class="column middle">
				<div id="mydiary">
					<?php while($row = mysqli_fetch_assoc($result)){ ?>
					<a href="show.php?did=<?php echo $row['did']; ?>">
						<div class="container">
						<?php if(!empty($row['pic1'])){ ?>
							<img src="<?php echo $row['pic1']; ?>" class="image" />
						<?php }else{ ?>
							<img src="image/default.jpg" class="image" />
						<?php } ?>	
							<div class="overlay">
								<div class="text"><?php echo $row['title']; ?></div>
							</div>
						</div>
					</a>
					<?php } ?>
					<div style="clear:both;"></div>
				</div>
				
				<div id="upload">
					<div style="margin:0px auto;padding-left:70px">
						<form enctype="multipart/form-data" action="upload.php" method="post">
							標題：<input type="text" name="title" style="font-size:18px" />
							</br></br>
							上傳照片：(最多可選8張，限JPG、JPEG、GIF、PNG圖檔，每張限制2MB以下)
							<br/>
							<input type="file" name="photo[]" accept="image/jpeg,image/jpg,image/gif,image/png" multiple />
							<input type="hidden" name="MAX_FILE_SIZE" value="2097152">
							</br></br>
							日記撰寫：
							</br>
							<textarea name="content" style="font-size:18px"></textarea>
							</br></br>
							<div style="text-align:center">
								<input type="submit" name="upload" value="上傳" />
								<input type="reset" name="reset" value="清除" />
							</div>
						</form>
					</div>
				</div>
				
				<div id="mymember">
					<form enctype="multipart/form-data" action="user_update.php" method="post">
					<div style="margin:0px auto;width:50%;">
						姓名：<input type="text" name="name" value="<?php echo $_SESSION['name']; ?>" required />
						</br></br>
						帳號：<input type="text" name="username" value="<?php echo $_SESSION['username']; ?>" pattern="[A-za-z0-9]{4,20}" title="帳號格式為4~20英數字" required />
						</br></br>
						密碼：<button type="button">修改密碼</button>
						<div id="editpw">
							舊密碼：<input type="password" name="oldpassword" id="oldpassword" placeholder="目前的密碼" onkeyup="checkoldpas()" required disabled />
							</br></br>
							新密碼：<input type="password" name="password" id="password"  placeholder="新密碼" pattern=".{8,}" title="密碼必須至少包含8字符。" required disabled />
							</br></br>
							確認新密碼：<input type="password" name="repassword" id="repassword" placeholder="再次輸入新密碼" onkeyup="checkpas()" required disabled />
						</div>
						</br></br>
						<div style="text-align:center">
							<input type="submit" name="edit" value="修改完成" onclick="checkpas2()" />	
						</div>
					</div>
					</form>
				</div>
			</div>
			<div style="clear:both"></div>
			<div class="footer"></div>
		</div>
	</body>
</html>