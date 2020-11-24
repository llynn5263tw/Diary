<?php
	include("islogin.php");
	session_start();
	require('config.php');
    ini_set("display_errors", "Off");
	
	$title = $_POST['title'];
	$content = $_POST['content'];
	$getDate = date("y/m/d");
	$id = $_SESSION['id'];

	$i = count($_FILES['photo']['name']);
	$arr = array("","","","","","","","");

	for($j=0;$j<$i;$j++){
		$fileName = $_FILES['photo']['tmp_name'][$j];   
		if(!empty($fileName)){
			if(isset($_FILES['fileName']['error'][$j])==0){
			$client_id = "daac0415e48ddd9";
			$handle = fopen($fileName,"r");
			$data = fread($handle,filesize($fileName));
			$pvars  = array('image' => base64_encode($data));
			$timeout = 30;
			$curl = curl_init();
			curl_setopt($curl,CURLOPT_URL,'https://api.imgur.com/3/image.json');
			curl_setopt($curl,CURLOPT_TIMEOUT,$timeout);//讀取時間30秒為上限
			curl_setopt($curl,CURLOPT_HTTPHEADER,array('Authorization: Client-ID ' . $client_id));
			curl_setopt($curl,CURLOPT_POST,1);
			curl_setopt($curl,CURLOPT_SSL_VERIFYPEER, false);//關閉SSL安全
			curl_setopt($curl,CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($curl,CURLOPT_POSTFIELDS, $pvars);
			$out = curl_exec($curl);
			curl_close ($curl);
			$pms = json_decode($out,true);
			$filelink=$pms['data']['link'];
			$arr[$j] = $filelink;
			}else {
				echo"fileErrorCode:".$_FILES["photo"]["error"][$j];
			}
		}
	}
	
    $sql = "INSERT INTO mydiary(title,content,date,id) VALUES ('$title','$content','$getDate','$id')";
	if(mysqli_query($con, $sql)){
		$did = mysqli_insert_id($con);
		$_SESSION['did'] = $did;
		$sql = "INSERT INTO pictures(pic1,pic2,pic3,pic4,pic5,pic6,pic7,pic8,did) VALUES ('$arr[0]','$arr[1]','$arr[2]','$arr[3]','$arr[4]','$arr[5]','$arr[6]','$arr[7]','$did')";
		if(mysqli_query($con, $sql)){
			echo "<script language='javascript'>alert('新增成功');document.location.href='show.php';</script>";
		}
	}
?>