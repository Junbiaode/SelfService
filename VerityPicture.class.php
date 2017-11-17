<?php
session_start();
class valite
{
	public $image_path;
	public $data;
	public $size;
	public $word_location;
	public $model;
	public $word_arr;
	public $valite_result;
	public function __construct()
	{
		
		$this->image_path='valite_image/'.session_id().'.jpg';
	}

	public function PictureToData()
	{
		$image=imageCreateFromJpeg($this->image_path);
		$size=getimagesize($this->image_path);
		$this->size=$size;
		for($i=0;$i<$size[0];$i++)
		{
			for($j=0;$j<$size[1];$j++)
			{
				$index=imagecolorat($image,$i,$j);
				$rgb=imagecolorsforindex($image,$index);
				if($rgb['green']<125||$rgb['red']<125||$rgb['blue']<125)
				{
					$this->data[$i][$j]=1;
				}
				else $this->data[$i][$j]=0;
			}
		}
		
	}
	public function DisplayDataArray($arr)
	{
		for($i=0;$i<20;$i++)
		{
			for($j=0;$j<60;$j++)
			{
				echo $this->data[$j][$i];
			}
			echo "\n";
		}
	}
	public function ShowMessage($message)
	{
		echo "<script>alert('$message')</script>";
	}
	public function Exec()
	{
       $flag=array();
	   $location=array();
       foreach($this->data as $key=>$value)
	   {
		    $flag[$key]=0;
			foreach($value as $k=>$v)
			{
				$flag[$key]+=$v;
			}
			
			if($flag[$key]>0)
			{
		 		$location[$key]=$flag[$key];
			}
       }
	   foreach($location as $k=>$value)
	   {
		   if($location[$k]<2&&!isset($location[$k-1])&&!isset($location[$k+1]))
		   {
				unset($location[$k]);
		   }
	   }
	   $this->CutEveryWord($location);
	}
	public function CutEveryWord($location)
	{
		$cut=array();
		foreach($location as $key=>$value)
		{
			if(!isset($location[$key-1]))array_push($cut,$key);
			else if(!isset($location[$key+1]))array_push($cut,$key);
			else continue;
		}
		$this->word_location=$cut;
	}
	public function CreateWordModel()
	{
		$location=$this->word_location;
		$data=$this->data;
		$first="";
		foreach($data as $key=>$value)
		{
			if($key>=$location[0]&&$key<=$location[1])
			{
			   foreach($value as $k=>$v)
			   {
				   $first.=$v;
			   }
			}
		}
		$second="";
		foreach($data as $key=>$value)
		{
			if($key>=$location[2]&&$key<=$location[3])
			{
			   foreach($value as $k=>$v)
			   {
				   $second.=$v;
			   }
			}
		}
		$third="";
		foreach($data as $key=>$value)
		{
			if($key>=$location[4]&&$key<=$location[5])
			{
			   foreach($value as $k=>$v)
			   {
				   $third.=$v;
			   }
			}
		}
		$fourth="";
		foreach($data as $key=>$value)
		{
			if($key>=$location[6]&&$key<=$location[7])
			{
			   foreach($value as $k=>$v)
			   {
				   $fourth.=$v;
			   }
			}
		}
		$word_arr=array(
		0=>$first,
		1=>$second,
		2=>$third,
		3=>$fourth,
		);
		$this->word_arr=$word_arr;
	}
	public function WordModel()
	{
		return $wordmodel=array(
		0=>"00000001111110000000000001111111111000000000110000000011000000001000000000010000000011000000001100000000011111111110000000000001111110000000",
		1=>"000001000000000100000000010000000001000000001111111111110000000011111111111100000000000000000001000000000000000000010000",
		2=>"0000001000000001000000000100000000110000000010000000011100000000100000001011000000001100001100110000000011111110001100000000011110000011000000000000000001100000",
		3=>"00000110000000110000000001000000001100000000100000000001000000001000010000010000000011001110001100000000111111111110000000000111001111000000",
		4=>"0000000000011000000000000000001010000000000000001100100000000000000100001000000000000010000010000000000011111111111100000000111111111111000000000000000010000000",
		5=>"000000001000001100000000001110000001000000001101100000010000000011011100000100000000110011100010000000001100011111000000",
		6=>"0000000001111100000000000001111111100000000000110100001100000000011010000001000000000100100000010000000011001100001100000000100001111110000000001000001111000000",
		7=>"0000001000000000000000001100000000000000000011000000000100000000110000001110000000001100001100000000000011011100000000000000111000000000000000001000000000000000",
		8=>"0000001100001100000000000111100111100000000011001110001100000000100001100001000000001000011000010000000010001011000100000000011110011110000000000011000011000000",
		9=>"0000001111000001000000000111111000010000000011000011000100000000100000010010000000001000000100100000000011000001110000000000011111111000000000000011111000000000",
		);
	}
	public function ArrMaxKey($arr)
	{
		$temp=$arr[0];
		$max_key=0;
		foreach($arr as $k=>$v)
		{
			if($v>=$temp)
			{
				$temp=$v;
				$max_key=$k;
			}
		}
		return $max_key;
	}
	public function ReturnResult()
	{
		$result="";
		$model=$this->WordModel();
		for($i=0;$i<4;$i++)
		{
			$arr=array();
			$percent=0;
			foreach($model as $k=>$v)
			{
				similar_text($this->word_arr[$i],$v,$percent);
				$arr[$k]=$percent;
			}
			$result.=$this->ArrMaxKey($arr);

		}
		//echo utf8_to_gbk("识别结果为：").$result;
		$this->valite_result=$result;
		return $result;
		
	}		
}