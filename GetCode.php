<?php
	session_start();
	//$id=session_id();
	//$_SESSION['id']=$id;
	$cookie = dirname(__FILE__) . '/cookie/cookie.txt'; //cookie路径  
	$verify_code_url = "http://222.16.96.12:8080/selfservice/common/web/verifycode.jsp"; //验证码地址
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $verify_code_url);
	curl_setopt($curl, CURLOPT_COOKIEJAR, $cookie);  //保存cookie
	curl_setopt($curl, CURLOPT_HEADER, 0);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	$img = curl_exec($curl);  //执行curl
	curl_close($curl);
	file_put_contents("image/valite.jpg",$img);
	echo '<img src='."image/".'valite.jpg'.'>'.'<br>';
	require_once 'VerityPicture.php';
?>