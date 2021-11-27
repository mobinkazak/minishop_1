<?php
defined('DB_HOST') or die;
abstract class Base{

	private $dbLink=null;

	public function __construct(){
		$this->dbLink=mysqli_connect(DB_HOST,DB_USER,DB_PASS) or die(mysqli_connect_error());
		mysqli_select_db($this->dbLink,DB_NAME) or die($this->getMysqliError());
		$this->query("SET NAMES 'UTF8'");
	}
	public function __destruct(){
		if (is_resource($this->dbLink)) {
			mysqli_close($this->dbLink);
		}
	}
	public function getMysqliError(){
		return mysqli_error($this->dbLink);
	}
	public function query($q){
		$res=mysqli_query($this->dbLink,$q);
		if (stristr($q,'insert')) {
			return mysqli_insert_id($this->dbLink);
		}
		elseif(stristr($q,'delete') || stristr($q,'update')){
			return mysqli_affected_rows($this->dbLink);
		}else{
			return $res;
		}
	}
	public function getRow($res){
		return mysqli_fetch_assoc($res);
	}
	public function freeResult($res){
		return mysqli_free_result($res);
	}
	public function redirect($url){
		header("Location:$url");
		die;
	}

	public function post($key){
		return isset($_POST[$key])?trim($_POST[$key]):'';
	}
	public function get($key){
		return isset($_GET[$key])?trim($_GET[$key]):'';
	}

	public function setAlert($cmd,$val,$alert,$msg){
		$html="<div class=\"alert alert-$alert\">$msg</div>";
		if ($this->get($cmd)==$val) {
			print $html;
		}
	}

	public function safeString($str){
		return htmlentities($str,ENT_QUOTES,'UTF-8');
	}

	public function isLogin($key){
		if (isset($_SESSION[$key])) {
			return true;

		}else{
			return false;
		}
	}
	public function toInt($str){
		return (int)$str;
	}
	public function persianDate($date){
		$dateArray=explode(' ',$date);
        $dateArr=explode('-',$dateArray[0]);
        $date=gregorian_to_jalali($dateArr[0],$dateArr[1],$dateArr[2]);
        $date=implode('/',$date).' '.$dateArray[1];
        return $date;

	}
	public function checkUserEmail($email){
		$email=$this->safeString($email);
		$q="SELECT COUNT(*) AS n FROM users WHERE email='$email'";
		$res=$this->query($q);
		$row=$this->getRow($res);
		$this->freeResult($res);
		if ($row['n']>0) {
			return false;
		}else{
			return true;
		}
	}

	public function uploadImg($fieldName,$uploadFolderName){
		$allowType=array('jpg','png','jpeg','gif');
		$file=$_FILES[$fieldName];
		$err=$file['error'];
		if (isset($file)&&$err==0) {
			$name=strtolower($file['name']);
			$tmp=$file['tmp_name'];
			$ext=pathinfo($name, PATHINFO_EXTENSION);
			$indexType=array_search($ext,$allowType);
			if (in_array($ext,$allowType)) {
				$newExt=$allowType[$indexType];
				$newName=md5('avatar').date('YmdHis').'.'.mt_rand(1111111,9999999).'.'.$newExt;
				$res=move_uploaded_file($tmp, "$uploadFolderName/$newName");
				if($res)
					return $newName;//uploaded
				else
					return 3;//Upload file err

			}else{
				return 2;//File type err
			}

		}else{
			return 1;//File error
		}
	}

}
