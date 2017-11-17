<?php
	header("Content-type: text/html; charset=utf-8"); 
	require_once 'VerityPicture.class.php';
	require_once 'HtmlDownLoader.class.php';
	require_once 'HtmlParser.class.php';
	if(!isset($_SESSION))session_start();
	class RequestMain
	{
		public $valite_url;
		public $cookie;
		public $verify_code;
		public $curl_login_url;
		public function __construct($valite_url,$cookie)
		{
			$this->valite_url=$valite_url;
			$this->cookie=$cookie;
			$this->Craw();
		}
		public function Craw()
		{
			$this->GetValiteImg();
			$this->verifyPicure();
			$this->curl_login();
			$index_data=DownLoader::get_contents("http://222.16.96.12:8080/selfservice/module/webcontent/web/index_self.jsf?",$this->cookie);
			$content_data=DownLoader::get_contents("http://222.16.96.12:8080/selfservice/module/webcontent/web/content_self.jsf?",$this->cookie);
			Parser::parse($content_data);
			
		}
		public function GetValiteImg()
		{
			$curl=curl_init();
			curl_setopt($curl,CURLOPT_URL,$this->valite_url);
			curl_setopt($curl, CURLOPT_COOKIEJAR, $this->cookie);  //保存cookie
			curl_setopt($curl, CURLOPT_HEADER, 0);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
			$img = curl_exec($curl);  //执行curl
			curl_close($curl);
			file_put_contents("valite_image/".session_id().'.jpg',$img);
		}
		public function DisplayValiteImg()
		{
			echo '<img src='."valite_image/".session_id().'.jpg'.'>'.'<br>';
		}
		public function verifyPicure()
		{
			$verify=new valite();
			$verify->PictureToData();
			$verify->Exec();
			$verify->CreateWordModel();
			$this->verify_code=$verify->ReturnResult();
			
		}
		public function curl_login()
		{
			$url="http://222.16.96.12:8080/selfservice/module/scgroup/web/login_judge.jsf";	
			$post_data=array(
				'act'=>'add',
				'name'=>$_POST['username'],
				'password'=>$_POST['password'],
				'verify'=>$this->verify_code,
			   );
			$result=DownLoader::login_post($url,$this->cookie,$post_data);
			return $result;
		}

	}
	$valite_img_url="http://222.16.96.12:8080/selfservice/common/web/verifycode.jsp";
	$cookie='cookie/'.session_id().'cookie.txt';
	$request=new RequestMain($valite_img_url,$cookie);
	

