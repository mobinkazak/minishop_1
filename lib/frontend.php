<?php
defined('DB_HOST') or die;

class Frontend extends Base
{
	public function getSpecialProd($n = 4)
	{
		$n = $this->toInt($n);
		$q = "SELECT * FROM products WHERE is_special=1 AND status=1 ORDER BY id DESC LIMIT 0,$n ";
		return $this->query($q);
	}

	public function getProduct($id)
	{
		$id = $this->toInt($id);
		$q = "SELECT * FROM products WHERE id = '$id' AND status=1 ";
		$res = $this->query($q);
		return $this->getRow($res);
	}
	public function getReleatedProd($cat_id, $n = 4)
	{
		$cat_id = $this->toInt($cat_id);
		$n = $this->toInt($n);
		$q = "SELECT * FROM products WHERE cat_id='$cat_id' AND status=1 ORDER BY id DESC LIMIT 0,$n";
		return $this->query($q);
	}
	public function register()
	{
		$firstname = $this->safeString($this->post('firstname'));
		$lastname = $this->safeString($this->post('lastname'));
		$email = $this->safeString($this->post('email'));
		$pass = $this->safeString($this->post('pass'));
		$pass2 = $this->safeString($this->post('pass2'));
		$date = date("Y-m-d H:i:s");

		if (!empty($firstname) && !empty($lastname) && !empty($email) && !empty($pass) && !empty($pass2)) {
			if ($pass == $pass2) {
				if ($pass >= 7 && $pass2 >= 7) {
					if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
						if ($this->checkUserEmail($email) == 0) {
							$q = "INSERT INTO users (firstname,lastname,email,password,reg_date_time,is_admin,status) VALUES ('$firstname','$lastname','$email','$pass2','$date','0','1')";
							return $this->query($q);
						} else {
							return -3;
						}
					} else {
						return -5;
					}
				} else {
					return -4;
				}
			} else {
				return -2;
			}
		} else {
			return -1;
		}
	}
	public function login()
	{
		$email = $this->safeString($this->post('email'));
		$pass = $this->safeString($this->post('pass'));
		$q = "SELECT * FROM users WHERE email='$email' AND password='$pass' AND status='1' AND is_admin='0' ";
		$res = $this->query($q);
		$row = $this->getRow($res);
		$this->freeResult($res);
		if ($email != '' && $pass != '') {
			if (isset($row['id'])) {
				$_SESSION['user_id'] = $row['id'];
				return 1;
			} else
				return -2;
		} else {
			return -1;
		}
	}
	public function getProfile()
	{
		$id = $_SESSION['user_id'];
		$q = "SELECT * FROM users WHERE id='$id'";
		$res = $this->query($q);
		$row = $this->getRow($res);
		$this->freeResult($res);
		return $row;
	}

	public function updateProfile()
	{
		$id = $_SESSION['user_id'];
		$currentProfile = $this->getProfile();
		$fn = $this->safeString($this->post('firstname'));
		$ln = $this->safeString($this->post('lastname'));
		$mobile = $this->toInt($this->post('mobile'));
		$address = $this->safeString($this->post('address'));
		$email = $this->safeString($this->post('email'));
		$q = "UPDATE users SET firstname='$fn',lastname='$ln',mobile='$mobile',address='$address' ";
		if ($email != '' && $fn != '' && $ln != '' && $mobile != '') {
			if ($currentProfile['email'] != $email) {
				if ($this->checkUserEmail($email) == 0) {
					$q .= " ,email='$email' ";
				} else {
					return -2; //email exist
				}
			}
		} else {
			return -1;
		}

		$uploadRes=$this->uploadImg('avatar', 'avatars');
		if (!is_int($uploadRes)) {
			$q.=" ,avatar='avatars/$uploadRes' ";
		}else{
			if($uploadRes==2)
				return -6;
			elseif($uploadRes==3)
				return -7;
		}

		$q .= " WHERE id='$id'";
		$this->query($q);
		return 1;
	}
	public function updateProfilePassword()
	{
		$id = $_SESSION['user_id'];
		$currentProfile = $this->getProfile();
		$pass1 = $this->safeString($this->post('pass1'));
		$pass2 = $this->safeString($this->post('pass2'));
		$pass3 = $this->safeString($this->post('pass3'));
		if ($pass1 != '' && $pass2 != '' && $pass3 != '') {
			if ($currentProfile['password'] == $pass1) {
				if ($pass2 == $pass3) {
					$q = "UPDATE users SET password='$pass3' WHERE id='$id'";
					$this->query($q);
					return 1;
				} else
					return -4;//incorrect new password
			} else
				return -3;//incorrect pass
		}else{
			return -5;
		}
	}
	public function deleteAvatar(){
		$id = $_SESSION['user_id'];
		$currentProfile = $this->getProfile();
		if(!empty($currentProfile['avatar']) && file_exists($currentProfile['avatar']))
			unlink($currentProfile['avatar']);
		$q="UPDATE users SET avatar='' WHERE id='$id'";
		$this->query($q);
		return 1;
		
	}
	public function accountRecovery(){
		$email=$this->safeString($this->post('email'));
		$q="SELECT * FROM users WHERE email='$email' AND status='1' ";
		$res=$this->query($q);
		$row=$this->getRow($res);
		$this->freeResult($res);
		if(isset($row['id'])){
			return true;
		}else{
			return false;
		}
	}
}
