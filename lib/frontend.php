<?php
defined('DB_HOST') or die;

class Frontend extends Base
{
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
						if ($this->checkUserEmail($email)==0) {
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
}
