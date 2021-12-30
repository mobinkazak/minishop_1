<?php 
defined('DB_HOST') or die;
class Backend extends Base{

	public function login($email,$pass){
		$email=$this->safeString($email);
		$pass=$this->safeString($pass);
		$q="SELECT * FROM users WHERE email='$email' AND password='$pass' AND status='1' AND is_admin='1' ";
		$res=$this->query($q);
		$row=$this->getRow($res);
		$this->freeResult($res);
		if (isset($row['id'])) {
			$_SESSION['admin_id']=$row['id'];

			return true;
		}else{
			return false;
		}
	}

	public function beforeLogout(){
		$currentDate=date("Y-m-d H:i:s");
		$id=$_SESSION['admin_id'];
		$q="UPDATE users SET last_login='$currentDate' WHERE id='$id' ";
		$this->query($q);
	}

	public function getProfile(){
		$id=$_SESSION['admin_id'];
		$q="SELECT * FROM users WHERE id='$id' ";
		$r=$this->query($q);
		$row=$this->getRow($r);
		$this->freeResult($r);
		return $row;
	}
	public function saveProfile(){
		$id=$_SESSION['admin_id'];
		$currentProfile=$this->getProfile();
		$fn=$this->safeString($this->post('fn'));
		$ln=$this->safeString($this->post('ln'));
		$mobile=$this->toInt($this->post('mobile'));
		$address=$this->safeString($this->post('address'));
		$email=$this->safeString($this->post('email'));
		$pass1=$this->safeString($this->post('password1'));
		$pass2=$this->safeString($this->post('password2'));
		$pass3=$this->safeString($this->post('password3'));
		$q="UPDATE users SET firstname='$fn',lastname='$ln',mobile='$mobile',address='$address' ";

		if ($currentProfile['email']!=$email) {
			if ($this->checkUserEmail($email)) {
				$q .= " ,email='$email' ";
			}else{
				return -1;//email exist
			}
		}

		if ($pass1 != '' && $pass2 != '' && $pass3 != '') {
			if ($currentProfile['password'] == $pass1) {
				if ($pass2 == $pass3) {
					$q.=" , password='$pass3' ";
				}else{
					return -3;//incorrect new password
				}

			}else{
				return -2;//incorrect password
			}
		}

		$uploadRes=$this->uploadImg('img', '../avatars');
		if (!is_int($uploadRes)) {
			$q.=" ,avatar='avatars/$uploadRes'";
		}else{
			if($uploadRes==2)
				return -4;
			elseif($uploadRes==3)
				return -5;
		}
		
		$q.=" WHERE id='$id'";
		return $this->query($q);

	}

	public function delAvatar(){
		$id=$_SESSION['admin_id'];
		$currentProfile=$this->getProfile();
		$path="../$currentProfile[avatar]";
		$path2="avatars/avatar.png";
		if (!empty($currentProfile['avatar']) && file_exists($path)) {
			unlink($path);
		}
		$q="UPDATE users SET avatar='$path2' WHERE id='$id'";
		$this->query($q);
	}
	public function checkCategory($title,$parent_id){
		$title=$this->safeString($title);
		$parent_id=$this->toInt($parent_id);
		$q="SELECT id FROM categories WHERE title='$title' AND parent_id='$parent_id'";
		$r=$this->query($q);
		return $r->num_rows;
	}
	public function addCategory(){
		$parent_id=$this->toInt($this->post('parent_id'));
		$title=$this->safeString($this->post('title'));
		if (!empty($parent_id) || !empty($title)) {
			if ($this->checkCategory($title,$parent_id)==0) {
				$q="INSERT INTO categories VALUES('NULL','$title','$parent_id')";
				return $this->query($q);
			}else{
				return -1;
			}
		}else{
			return -2;
		}
	}

	public function updateCategory($id){
		$id=$this->toInt($id);
		$parent_id=$this->toInt($this->post('parent_id'));
		$title=$this->safeString($this->post('title'));
		$currentCat=$this->getCategoryTitle($id);
		if ($currentCat['parent_id']==0) {

			if ($currentCat['title']!= $title) {
				if ($this->checkCategory($title,0)==0) {
					$q="UPDATE categories SET title='$title' WHERE id='$id'";
					return $this->query($q);
				}else
					return -1;
			}

			return 1;
		}else{
			$q = "UPDATE categories SET ";
			$isChangeParentId=false;
			$isChangeTitle=false;
            
			if ($currentCat['title']!=$title) {
				if ($this->checkCategory($title, $parent_id)==0) {
					$q.=" title='$title' ";
					$isChangeTitle=true;
				}else{
					return -1;
				}
			}

			if ($currentCat['parent_id']!=$parent_id) {
				if ($this->checkCategory($title, $parent_id)==0) {
					if ($isChangeTitle) {
						$q.=" , ";
					}
					$q.=" parent_id='$parent_id' ";
					$isChangeParentId=true;

				}else{
					return -1;
				}
			}

            $q.=" WHERE id='$id' ";
            if ($isChangeParentId || $isChangeTitle)
            	$this->query($q);

            return 1;

		}
	}

	public function getCountChildForCategory($parent_id){
		$parent_id=$this->toInt($parent_id);
		$q="SELECT COUNT(*) AS n FROM categories WHERE parent_id='$parent_id'";
		$r=$this->query($q);
		$row=$this->getRow($r);
		return $row['n'];
	}
	public function deleteCategory($id,$cat_id,$sub_cat_id){
		$id=$this->toInt($id);
		$cat_id=$this->toInt($cat_id);
		$sub_cat_id=$this->toInt($sub_cat_id);

		if ($this->getCountChildForCategory($id)==0 && $this->getCountProd($cat_id, $sub_cat_id)==0) {
			$q="DELETE FROM categories WHERE id='$id' ";
			return $this->query($q);
		}else{
			if ($this->getCountChildForCategory($id)>0 ) {
				return -1;
			}else if($this->getCountProd($cat_id, $sub_cat_id)>0){
				return -2;
			}
		}

	}
	public function checkProdTitle($cat_id,$sub_cat_id,$title_fa){
		$title_fa=$this->safeString($title_fa);
		$cat_id=$this->toInt($cat_id);
		$sub_cat_id=$this->toInt($sub_cat_id);
		$q="SELECT id FROM products WHERE title_fa='$title_fa' AND cat_id='$cat_id' AND sub_cat_id='$sub_cat_id'";
		$r=$this->query($q);
		return $r->num_rows;
	}
	public function addProdStep1(){
		$title_fa=$this->safeString($this->post('title_fa'));
		$title_en=$this->safeString($this->post('title_en'));
		$short_desc=$this->safeString($this->post('short_desc'));
		$long_desc=$this->safeString($this->post('long_desc'));
		$status=$this->toInt($this->post('status'));
		$cat_id=$this->toInt($this->post('cat_id'));
		$sub_cat_id=$this->toInt($this->post('sub_cat_id'));
		$date=date('Y-m-d H:i:s');
		$is_special=isset($_POST['is_special'])?1:0;
		
		if (!empty($title_fa) && !empty($title_en)) {
			if ($this->checkProdTitle($cat_id, $sub_cat_id, $title_fa)==0) {
				$q="INSERT INTO products (title_fa,title_en,short_desc,long_desc,status,cat_id,sub_cat_id,created_date,is_special) VALUES ('$title_fa','$title_en','$short_desc','$long_desc','$status','$cat_id','$sub_cat_id','$date','$is_special')";
				return $this->query($q);
			}else{
				return -2;
			}
		}else{
			return -1;
		}
	}
	public function updateProdStep2($id){
		$model=$this->safeString($this->post('model'));
		$code=$this->safeString($this->post('code'));
		$price=$this->safeString($this->post('price'));
		$discount=$this->safeString($this->post('discount'));
		$quantity=$this->toInt($this->post('quantity'));
		$id=$this->toInt($id);
		$date=date('Y-m-d H:i:s');

		if ($model!='' && $code!='' && $price!='') {
			$q="UPDATE products SET model='$model',code='$code',price='$price',discount='$discount',quantity='$quantity',edited_date='$date' WHERE id='$id'";
			$this->query($q);
		}else{
			return -3;
		}
	}
	
	public function updateProdStep3($id){
		$thumb=$this->safeString($this->post('thumb_img'));
		$id=$this->toInt($id);
		$img=$_POST['img'];
		$i=0;
		$date=date('Y-m-d H:i:s');

		if ($thumb!='') {
			$q="UPDATE products SET thumb_img='$thumb',edited_date='$date' WHERE id='$id'";
			$this->query($q);
			foreach ($img as $image) {
				$alt=$_POST['alt'][$i];
				$image=$this->safeString(trim($image));
				$alt=$this->safeString(trim($alt));
				$q2="INSERT INTO product_image VALUES(NULL,'$id','$image','$alt')";
				$this->query($q2);
				$i++;
			}

		}else{
			return -4;
		}
	}

	public function updateProdStep4($id){
		$id=$this->toInt($id);
		$meta_key=$this->safeString($this->post('meta_key'));
		$meta_desc=$this->safeString($this->post('meta_desc'));
		$date=date('Y-m-d H:i:s');

		if ($meta_key!='' && $meta_desc!='') {
			$q="UPDATE products SET meta_keywords='$meta_key',meta_desc='$meta_desc',edited_date='$date' WHERE id='$id'";
			$this->query($q);
		}else{
			return -5;
		}
	}
	public function getCountProd($cat_id,$sub_cat_id=0){
		$cat_id=$this->toInt($cat_id);
		$sub_cat_id=$this->toInt($sub_cat_id);
		$q="SELECT COUNT(*) as n FROM products WHERE cat_id='$cat_id' ";
		if ($sub_cat_id>0) {
			$q.=" AND sub_cat_id='$sub_cat_id'";
		}
		$res=$this->query($q);
		$row=$this->getRow($res);
		return $row['n'];
	}
	public function changeStatusProd($id,$val){
		$date=date('Y-m-d H:i:s');
		$id=$this->toInt($id);
		$val=$this->toInt($val);
		$q="UPDATE products SET status='$val',edited_date='$date' WHERE id='$id'";
		return $this->query($q);

	}
	public function changeSpecialProd($id,$val){
		$date=date('Y-m-d H:i:s');
		$id=$this->toInt($id);
		$val=$this->toInt($val);
		$q="UPDATE products SET is_special='$val',edited_date='$date' WHERE id='$id'";
		return $this->query($q);

	}
	public function deleteProduct($id){
		$id=$this->toInt($id);
		$q="DELETE FROM products WHERE id='$id'";
		$this->query($q);
		$q="DELETE FROM product_image WHERE product_id='$id'";
		return $this->query($q);
	}
	public function getProductWithId($id){
		$id=$this->toInt($id);
		$q="SELECT * FROM products WHERE id='$id'";
		$res=$this->query($q);
		return $this->getRow($res);
	}
	public function getImageProductList($id){
		$id=$this->toInt($id);
		$q="SELECT * FROM product_image WHERE product_id='$id'";
		return $this->query($q);

	}
	public function updateProdStep1($id){
		$id=$this->toInt($id);
		$title_fa=$this->safeString($this->post('title_fa'));
		$title_en=$this->safeString($this->post('title_en'));
		$short_desc=$this->safeString($this->post('short_desc'));
		$long_desc=$this->safeString($this->post('long_desc'));
		$status=$this->toInt($this->post('status'));
		$cat_id=$this->toInt($this->post('cat_id'));
		$sub_cat_id=$this->toInt($this->post('sub_cat_id'));
		$date=date('Y-m-d H:i:s');
		$is_special=isset($_POST['is_special'])?1:0;
		$currentProd=$this->getProductWithId($id);
		$q="UPDATE products SET 
		title_en='$title_en'
		,short_desc='$short_desc'
		,long_desc='$long_desc'
		,status='$status'
		,edited_date='$date'
		,is_special='$is_special' ";
		if (!empty($title_fa) && !empty($title_en)) {
			if ($currentProd['title_fa'] != $title_fa || $currentProd['cat_id'] != $cat_id || $currentProd['sub_cat_id'] != $sub_cat_id ){
				if ($this->checkProdTitle($cat_id, $sub_cat_id, $title_fa)==0) {
					$q.=" ,title_fa='$title_fa',cat_id='$cat_id',sub_cat_id='$sub_cat_id' ";
				}else{
					return -2;
				}
			}
		}else{
			return -1;
		}
		$q.=" WHERE id='$id' ";
		return $this->query($q);
	}
	public function deleteImageProduct($img_id,$product_id){
		$img_id=$this->toInt($img_id);
		$product_id=$this->toInt($product_id);
		$q="DELETE FROM product_image WHERE id='$img_id' AND product_id='$product_id'";
		return $this->query($q);
	}
	public function updateProdStep3Edited($id){
		$thumb=$this->safeString($this->post('thumb_img'));
		$id=$this->toInt($id);
		$image=$_POST['img'];
		$date=date('Y-m-d H:i:s');

		$i=0;
		if($thumb!=''){
			$q="UPDATE products SET thumb_img='$thumb',edited_date='$date' WHERE id='$id' ";
			$this->query($q);
			foreach ($image as $img) {
				$alt=$this->safeString(trim($_POST['alt'][$i]));
				$imgStatus=$this->safeString(trim($_POST['imgStatus'][$i]));
				$img=$this->safeString(trim($img));
				if ($imgStatus==0) 
					$q2="INSERT INTO product_image VALUES(NULL,'$id','$img','$alt')";
				else
					$q2="UPDATE product_image SET img='$img', alt='$alt' WHERE product_id='$id' AND id='$imgStatus' ";
				$this->query($q2);
				$i++;
			}
		}else{
			return -4;
		}
	}
}