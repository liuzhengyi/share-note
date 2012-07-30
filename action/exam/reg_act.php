<?php

require_once($webRoot."foundation/check.php");
	// create database connection
	global $dbServs; // initial in $dbConfFile
	$dbo = new dbex($dbServs);
	// deal with form submition
	if(isset($_POST['submitted'])) {
		$comit = true; // 判断是否向数据库写入记录
		// 获取用户提交的信息
		$email = trim($_POST['email']);
		$name = trim($_POST['name']);
		$pass = trim($_POST['pass']);
		$sch = trim($_POST['school']);
		$maj = trim($_POST['major']);
		$ent = trim($_POST['entrance-year']);
		// 验证用户提交的信息，有待完善
		if(empty($email) || empty($name) || empty($pass) || empty($sch) || empty($maj) || empty($ent)) {
			$msg = "form not complete.";
			action_return(1, $msg, -1);
			$comit = false;
		} else if (check_username_fail($name)){
			
			$msg = "user name has wrong format.";
			action_return(1, $msg, -1);
			$comit = false;
		} else if(check_useremail_fail($email, $max_len_user_email)) {
			
			$msg = "email has wrong format.";
			action_return(1, $msg, -1);
			$comit = false;
		} else if($dbo->check_exist("user_email", $email, "user_basic")) {
			$msg = "email has been used.";
			action_return(1, $msg, -1);
			$comit = false;
		} else { }
		// 判断完毕
		if($comit) {
			// 向数据库写入注册信息
			$sql = "insert into user_basic values (
				NULL, '$email', '$name', sha1('$pass'), NOW(), '$sch', '$maj', '$ent')";
			if($res = $dbo->exeUpdate($sql)) {
				$msg = "register successed.";
				action_return('1', $msg, '');
			} else {
				$msg = "register failed.";
				action_return('1', $msg, -1);
			}
		}
	}
