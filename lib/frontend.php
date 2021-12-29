<?php 
defined('DB_HOST') or die;

class Frontend extends Base
{
	public function getSpecialProd($n=4){
		$n=$this->toInt($n);
		$q="SELECT * FROM products WHERE is_special=1 AND status=1 ORDER BY id DESC LIMIT 0,$n ";
		return $this->query($q);		

	}

	public function getProduct($id){
		$id=$this->toInt($id);
		$q="SELECT * FROM products WHERE id = '$id' AND status=1 ";
		$res=$this->query($q);
		return $this->getRow($res);
	}
	public function getReleatedProd($cat_id,$n=4){
		$cat_id=$this->toInt($cat_id);
		$n=$this->toInt($n);
		$q="SELECT * FROM products WHERE cat_id='$cat_id' AND status=1 ORDER BY id DESC LIMIT 0,$n";
		return $this->query($q);

	}
}