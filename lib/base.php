<?php
defined('DB_HOST') or die;
abstract class Base{

	private $dbLink=null;
	public $page=null;
	public $limit=null;

	public function __construct(){
		$this->dbLink=mysqli_connect(DB_HOST,DB_USER,DB_PASS) or die(mysqli_connect_error());
		mysqli_select_db($this->dbLink,DB_NAME) or die($this->getMysqliError());
		$this->query("SET NAMES 'UTF8'");
		$this->page=($this->get('p')!='')? $this->toInt($this->get('p')) :1;
		if ($this->page<=0) {
			$this->page=1;
		}

        $this->limit = $this->toInt($this->get('limit'));

		if (!isset($this->limit)) {
			$_SESSION['limit']=10;
		}

		if ($this->limit>0) {
			if ($this->limit <= 0) {
				$this->limit=10;
			}
			$_SESSION['limit']=$this->limit;
		}

		if (!isset($_SESSION['sort'])) {
			$_SESSION['sort']='asc';
		}

		$sort=$this->safeString($this->get('sort'));
		if (!empty($sort)) {
			if ($sort == 'desc') {
				$sort='desc';				
			}else{
				$sort='asc';
			}
			$_SESSION['sort']=$sort;
		}



		if (!isset($_SESSION['field'])) {
			$_SESSION['field']='id';
		}
		$field=$this->safeString($this->get('fd'));
		if (!empty($field)) {
			$_SESSION['field']=$field;
		}


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
	public function toFloat($str){
		return (float)$str;
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
	public function pagination($table_name,$m=4,$where=''){
		if ($where=='') {
			$where='';
		}else{
			$where= ' WHERE 1=1 '.$where;
		}
		$ret=array();
		$qCount="SELECT COUNT(*) AS c FROM $table_name $where";
		$rCount=$this->query($qCount);
		$rowCount=$this->getRow($rCount);
		$this->freeResult($rCount);
		$totalRows=$rowCount['c'];
		$totalPage=ceil($totalRows / $m);
		$n=($m*$this->page)-$m;
		$order=" ORDER BY {$_SESSION['field']} {$_SESSION['sort']} ";
		$q = "SELECT * FROM $table_name $where $order LIMIT $n,$m";
		$r=$this->query($q);
		$ret['totalRows']=$totalRows;
		$ret['totalPage']=$totalPage;
		$ret['result']=$r;
		return $ret;
	}
	public function renderPagination($url,$totalPage){
		//Fast backward
		if ($this->page==$totalPage) {
			$lastPageHref='javascript:void(0);';
			$lastPageClass='disabled';
		}else{
			$lastPageHref=$url.'&p='.$totalPage;
			$lastPageClass='';

		}
		//Fast Forward
		if ($this->page==1) {
			$firstPageHref='javascript:void(0);';
			$firstPageClass='disabled';
		}else{
			$firstPageHref=$url.'&p=1';
			$firstPageClass='';

		}
		// Next page
		if ($this->page >= $totalPage) {
			$nextPageHref='javascript:void(0);';
			$nextPageClass='disabled';
		}else{
			
			$nextPageHref=$url.'&p='.($this->page+1);
			$nextPageClass='';
		}
		// Prev page
		if ($this->page <=1) {
			$prevPageHref='javascript:void(0);';
			$prevPageClass='disabled';

		}else{
			$prevPageHref=$url.'&p='.($this->page-1);
			$prevPageClass='';
		}
		?>
		<nav class="text-center mx-auto" dir="ltr" aria-label="Page navigation example">
	        <ul class="pagination">
	          <li class="page-item <?php print $firstPageClass; ?> "><a class="page-link" title="صفحه اول" data-toggle="tooltip" href="<?php print $firstPageHref; ?>"><i class="mdi mdi-arrow-collapse-left"></i></a></li>

	          <li class="page-item <?php print $prevPageClass; ?>"><a class="page-link" data-toggle="tooltip" title="صفحه  قبل" href="<?php print $prevPageHref; ?>"><i class="mdi mdi-arrow-left"></i></a></li>

	          <li class="page-item"><div class="page-link">
	            <input data-total-page="<?php print $totalPage; ?>" data-url="<?php print $url; ?>" id="page" type="text" class="form-control text-center col-md-12 mr-2 d-inline" style="width:100px;" data-container="body" data-toggle="popover" data-placement="top" data-content="صفحه مورد نظر وجود ندارد" value="<?php print $this->page ?>" >
	            <span>-----</span>
	            <span class="ml-1"><?php print $totalPage; ?></span>
	          </div></li>

	          <li class="page-item <?php print $nextPageClass; ?>"><a class="page-link" href="<?php print $nextPageHref; ?>" data-toggle="tooltip" title="صفحه بعد"><i class="mdi mdi-arrow-right"></i></a></li>

	          <li class="page-item <?php print $lastPageClass; ?>"><a class="page-link" title="صفحه آخر" data-toggle="tooltip" href="<?php print $lastPageHref; ?>"><i class="mdi mdi-arrow-collapse-right"></i></a></li>
	        </ul>
		</nav>
		<?php
	}
	public function showLimitTable($url){
		?>
		<div class="input-group" style="font-size:14px;">
		<select class="px-1" name="limit" id="limit" data-url="<?php print $url; ?>" style="border:1px solid #ddd;color:#666" class="form-select" aria-label="Default select example">
			<option  disabled selected>برای فیلتر کردن جدول انتخاب کنید</option>
		<?php 
		for ($i=10; $i <= 100 ; $i+=10) { 
				$sel=($_SESSION['limit']==$i)?'selected':'';
			?>
			<option <?php print $sel; ?> value="<?php print $i; ?>"><?php print $i; ?></option>
			<?php

		}
		?>
		</select>
		<div class="input-group-prepend">
			<a style="font-size:14px;" href="<?php print $url ?>&f=0" class="btn btn-info">پاک کن <i style="font-size:16px;" class="mdi mdi-auto-fix"></i></a>
		</div>
		</div>

		<?php
	}

	public function tableFieldSort($url,$title,$field){
		$title=$this->safeString($title);
		$field=$this->safeString($field);

		if ($_SESSION['sort'] =='asc') {
			$url2="$url&fd=$field&sort=desc";
			$span='<span style="font-size:16px;" class="mdi mdi-chevron-double-up"></span>';
		}elseif($_SESSION['sort']=='desc'){
			$url2="$url&fd=$field&sort=asc";
			$span='<span style="font-size:16px;" class="mdi mdi-chevron-double-down"></span>';
		}

		if ($_SESSION['field']==$field) {
			?>
			<a href="<?php print $url2 ?>">
				<?php
				print $title; 
				print $span;
				?>
			</a>
			<?php
		}else{
			?>
			<a href="<?php print $url2 ?>">
				<?php
				print $title; 
				?>
			</a>
			<?php

		}


	}

}
