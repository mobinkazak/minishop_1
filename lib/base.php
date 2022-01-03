<?php
defined('DB_HOST') or die;
use PHPMailer\PHPMailer\PHPMailer;

abstract class Base{

	private $dbLink=null;
	public $page=null;
	public $limit=null;
	private $sortCol=array();

	public function __construct(){
		$this->dbLink=mysqli_connect(DB_HOST,DB_USER,DB_PASS) or die(mysqli_connect_error());
		mysqli_select_db($this->dbLink,DB_NAME) or die($this->getMysqliError());
		$this->query("SET NAMES 'UTF8'");
		//Pagination
		$this->page=($this->get('p')!='')? $this->toInt($this->get('p')) :1;
		if ($this->page<=0) {
			$this->page=1;
		}

		//Show limit table
        $this->limit = $this->toInt($this->get('limit'));
		if (!isset($this->limit)) {
			$_SESSION['limit']=5;
		}
		if (!isset($_SESSION['limit'])) {
			$_SESSION['limit']=5;
		}

		if ($this->limit>0) {
			if ($this->limit <= 0) {
				$this->limit=5;
			}
			$_SESSION['limit']=$this->limit;
		}

		//table sorting
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
		//table sorting
		if (!isset($_SESSION['field'])) {
			$_SESSION['field']='id';
		}
		$field=$this->safeString($this->get('fd'));
		if (!empty($field)) {
			$_SESSION['field']=$field;
		}


	}
	public function setSortCol($column){
		$this->sortCol=$column;
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
        $date=implode('-',$date).'<br>'.$dateArray[1];
        return $date;

	}
	public function checkUserEmail($email){
		$email=$this->safeString($email);
		$q="SELECT id FROM users WHERE email='$email'";
		$r=$this->query($q);
		return $r->num_rows;
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

	public function pagination($table_name,$where=''){
		if ($where=='') {
			$where='';
		}else{
			$where= ' WHERE 1=1 '.$where;
		}
		$m=$_SESSION['limit'];
		$ret=array();
		$qCount="SELECT COUNT(*) AS c FROM $table_name $where";
		$rCount=$this->query($qCount);
		$rowCount=$this->getRow($rCount);
		$this->freeResult($rCount);
		$totalRows=$rowCount['c'];
		$totalPage=ceil($totalRows / $m);
		$n=($m*$this->page)-$m;
		if (!in_array($_SESSION['field'],$this->sortCol)) {
			$_SESSION['field']=$this->sortCol[0];
		}
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
			<option <?php ($_SESSION['limit']==5)?print 'selected': print ''; ?> value="5">5</option>
		<?php 
		for ($i=10; $i <= 100 ; $i+=10) { 
				$sel=($_SESSION['limit']==$i)?'selected':'';
			?>
			<option <?php print $sel; ?> value="<?php print $i; ?>"><?php print $i; ?></option>
			<?php

		}
		?>
		</select>
		
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
				print $span;
				print $title; 
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
	public function renderId($totalRows){
		$idList=1;
		if ($_SESSION['sort']=='asc') {
			// $idList=1*($this->page*$_SESSION['limit'])-$_SESSION['limit']+1;
			$idList=(($this->page*$_SESSION['limit'])-$_SESSION['limit'])+1;
			return $idList;
		}else{
			if ($this->page<=1) {
				$idList=$totalRows-($this->page*$_SESSION['limit'])+$_SESSION['limit'];
				return $idList;
			}

		}
	}
	public function getParentCategoryList($parent_id=0,$order=''){
		if (!empty($order)) {
			$order=" ORDER BY $order ASC";
		}else{
			$order='';
		}
		$parent_id=$this->toInt($parent_id);
		$q="SELECT * FROM categories WHERE parent_id='$parent_id' $order ";
		return $this->query($q);
	}

	public function getCategoryTitle($id){
		$id=$this->toInt($id);
		$q="SELECT * FROM categories WHERE id='$id'";
		$res=$this->query($q);
		$row=$this->getRow($res);
		$this->freeResult($res);
		return $row;

	}
	public function dashReplacer($str){
		$str=mb_strtolower($str);
		return str_replace(' ','-',$str);
	}
	public function sendEmail($to,$subject,$body){
		$mail = new PHPMailer(true);
		$mail->CharSet = 'UTF-8';
		$mail->isSMTP();
		$mail->Host       = MAIL_HOST;
		$mail->SMTPAuth   = true;
		$mail->Username   = MAIL_USERNAME;
		$mail->Password   = MAIL_PASSWORD;
		$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
		$mail->Port       = 465;
	
		$mail->setFrom(MAIL_FROM, MAIL_FROM_NAME);
		$mail->addAddress($to, '');
	
		$mail->isHTML(true);
		$mail->Subject = $subject;
		$mail->Body    = $body;
	
		return $mail->send();
	}

}
