<?php
	require_once 'GetCode.php';
	header("Content-type: text/html; charset=gbk");
	$var=new valite();
	$var->PictureToData();
	$var->Exec();
	$var->CreateWordModel();
	$var->ReturnResult();
   
	function gbk_to_utf8($str)
	{
		return mb_convert_encoding($str, 'utf-8', 'gbk');
	}
	function utf8_to_gbk($str)
	{
		return mb_convert_encoding($str, 'gbk', 'utf-8');
	}
	function login_post($url,$cookie,$post)
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
	$url="http://222.16.96.12:8080/selfservice/module/scgroup/web/login_judge.jsf";
	$cookie = dirname(__FILE__) . '/cookie/cookie.txt';
	$code=$var->valite_result;
	$post=array(
		 'act'=>'add',
		 'name'=>$_POST['username'],
		 'password'=>$_POST['password'],
		 'verify'=>$code
		);
	login_post($url,$cookie,$post);
	$index_data=pull_request("http://222.16.96.12:8080/selfservice/module/webcontent/web/index_self.jsf?",$cookie);
	$content_data=pull_request("http://222.16.96.12:8080/selfservice/module/webcontent/web/content_self.jsf?",$cookie);
	//echo $content_data;
	$match=array();
	preg_match('%\b[0-9]{11,11}\b%',$content_data,$match);
	$id=$match[0];
	preg_match('%<span id="offileForm:userstate">.*;</span>%',$content_data,$match);
	if(strlen($match[0])>130)
	{
		$status=$match[0];
		preg_match('%<span id="offileForm:currentAccountFeeValue">.*</span>%',$content_data,$match);
		preg_match('%[0-9]{1,3}[.]{1}[0-9]{0,2}%',$match[0],$match);
		$remain=$match[0];
		preg_match('%<span id="offileForm:currentPrepareFee">.*</span>%',$content_data,$match);
		preg_match('%[0-9]{1,3}[.]{1}[0-9]{0,2}%',$match[0],$match);
		$payment=$match[0];
		preg_match('%span id="offileForm:policydesc">.*</span></td>%',$content_data,$match);
		preg_match('%&.*;%',$match[0],$match);
		$stragy=$match[0];
		preg_match('%<span id="offileForm:noUsedPeriodDesc">.*</span>%',$content_data,$match);
		preg_match('%&.*;%',$match[0],$match);
		$time=$match[0];
		$info=
		[
		  'id'=>$id,
		  'status'=>$status,
		  'ip'=>utf8_to_gbk('因为没有缴费所以没有ip:('),
		  'stragy'=>$stragy,
		  'time'=>$time,
		  'remain'=>$remain.utf8_to_gbk('元'),
		  'payment'=>$payment.utf8_to_gbk('元'),
		];
	}
	else
	{
		$status=$match[0];
		preg_match('%\d+\.\d+\.\d+\.\d+%',$content_data,$match);
		$ip=$match[0];
		preg_match_all('%(\d{2}|\d{4})(?:\-)?([0]{1}\d{1}|[1]{1}[0-2]{1})(?:\-)?([0-2]{1}\d{1}|[3]{1}[0-1]{1})(?:\s)?([0-1]{1}\d{1}|[2]{1}[0-3]{1})(?::)?([0-5]{1}\d{1})(?::)?([0-5]{1}\d{1})%',$content_data,$match);
		$match=$match[0];
		$online_time=$match[0];
		$start_time=$match[1];
		$end_time=$match[2];
		preg_match('%span id="offileForm:policydesc">.*</span></td>%',$content_data,$match);
		preg_match('%&.*;%',$match[0],$match);
		$stragy=$match[0];
		preg_match('%<span id="offileForm:currentAccountFeeValue">.*</span>%',$content_data,$match);
		preg_match('%[0-9]{1,3}[.]{1}[0-9]{0,2}%',$match[0],$match);
		$remain=$match[0];
		preg_match('%<span id="offileForm:currentPrepareFee">.*</span>%',$content_data,$match);
		preg_match('%[0-9]{1,3}[.]{1}[0-9]{0,2}%',$match[0],$match);
		$payment=$match[0];
		$info=[
		'ip'=>$ip,
		'id'=>$id,
		'stragy'=>$stragy,
		'online_time'=>$online_time,
		'start_time'=>$start_time,
		'end_time'=>$end_time,
		'status'=>$status,
		 'remain'=>$remain,
		 'payment'=>$payment,
		];
	}
	echo '<pre>';
	print_r($info);	
?>




