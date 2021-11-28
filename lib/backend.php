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
		if ($this->checkCategory($title,$parent_id)==0) {
			$q="INSERT INTO categories VALUES('NULL','$title','$parent_id')";
			return $this->query($q);
		}else{
			return -1;
		}
	}
	public function getParentCategoryList($parent_id=0){
		$parent_id=$this->toInt($parent_id);
		$q="SELECT * FROM categories WHERE parent_id='$parent_id'";
		return $this->query($q);

	}
}