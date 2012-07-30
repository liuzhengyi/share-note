<?php

	function check_useremail_fail($email, $max_len) {
		$format = '/^[a-z0-9][a-z0-9._-]{0,30}@[a-z0-9][a-z0-9]{0,30}\.[a-z0-9.]+[a-z]$/i';
		$email_len = 50;
		$len = strlen($email);
		if(
			0 == $len ||
			$email_len < $len ||
			!preg_match($format, $email)
		) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	function check_username_fail($name) {
		$format = '/^[a-zA-Z0-9]{1,15}$/i';
		if(!preg_match($format, $name)) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	function check_vericode_fail($vericode) {
		
		if(strtolower($_SESSION['verifyCode'])!=strtolower($vericode)){
			return TRUE;
		} else {
			return FALSE;
			UNSET($_SESSION['verifyCod']);
		}
	}
	function check_pass_fail($pass) { return FALSE;}
	function check_school_fail($school) { return FALSE;}
	function check_major_fail($major) { return FALSE;}
	function check_entranceyear_fail($entranceyear) { return FALSE;}

?>
