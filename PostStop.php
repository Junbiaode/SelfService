<?php
	session_start();
	$cookie = dirname(__FILE__) . '/cookie/'.$_SESSION['id'].'.txt';
	function GetStopCode($cookie)
	{
		$verify_code_url = "http://222.16.96.12:8080/selfservice/common/web/verifycode.jsp"; //验证码地址
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $verify_code_url);
		curl_setopt($curl, CURLOPT_COOKIEJAR, $cookie);  //保存cookie
		curl_setopt($curl, CURLOPT_HEADER, 0);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		$img = curl_exec($curl);  //执行curl
		curl_close($curl);
		$fp = fopen("image/".session_id().'stop'.'.jpg',"w");  //文件名
		fwrite($fp,$img);  //写入文件 
		fclose($fp);
		echo '<img src='."image/".session_id().'stop'.'.jpg'.'>'.'<br>';
	}
	function pull_request($url,$cookie)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); 
		curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie); 
		$result=curl_exec($ch);
		curl_close($ch);
		return $result;
	}
	function stop_post($url,$cookie,$post)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_AUTOREFERER,true);
		curl_setopt($ch, CURLOPT_HEADER,1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); 
		curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie); 
		curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($post));  //post提交数据
		$result=curl_exec($ch);
		curl_close($ch);
		return $result;
	}
	GetStopCode($cookie);
	