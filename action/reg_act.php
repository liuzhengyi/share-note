<?php
if((get_argp('submitted'))){
/*
	foreach($_POST as $k => $v) {
		echo "<script language=\"javascript\">alert('$k -- $v');</script>";
	}
*/
	$e = trim(get_argp('email'));
	$n = trim(get_argp('username'));
	$p = trim(get_argp('password'));
	$s = trim(get_argp('school'));
	$m = trim(get_argp('major'));
	$y = trim(get_argp('entrance_year'));
	$v = trim(get_argp('veriCode'));

	global $max_len_user_email; //initial in config.php
	if(empty($e) || empty($n) || empty($p) || empty($s) || empty($m) || empty($y) || empty($v)) {
		action_return(1, "form not complete, please fullfill it.", "-1");
	} else if (check_username_fail($n)){
		action_return(1, "username format wrong, please retry.", '-1');
	} else if (check_pass_fail($p)) {
		action_return(1, "password format wrong, please retry.", '-1');
	} else if (check_school_fail($s)) {
		action_return(1, "school format wrong, please retry.", '-1');
	} else if (check_major_fail($m)) {
		action_return(1, "major format wrong, please retry.", '-1');
	} else if (check_entranceyear_fail($y)) {
		action_return(1, "entrance year format wrong, please retry.", '-1');
	} else if (check_useremail_fail($e, $max_len_user_email)) {
		action_return(1, "email format wrong, please retry.", '-1');
	} else if (check_vericode_fail($v)) {
		action_return(1, "vericode input error, please retry.", '-1');
	} else {
		global $dbServs; // initial in $dbConfFile
		$user_ip = $_SERVER['REMOTE_ADDR'];
		$dbo = new dbex($dbServs);
		if($dbo->check_exist('user_email', $e)) {
			action_return(1, "the email has been used, please choose another one.", '-1');
		}
		$sql_bas = "insert into user_basic values(NULL, '$e', '$n', sha1('$p'), now(), '$s', '$m', '$y')";
		$row_bas = $dbo->exeUpdate($sql_bas);
		$last_id = $dbo->insert_id();
		$sql_var = "insert into user_var values($last_id, inet_aton('$user_ip'), 0, 0, 0, 10)";
		$row_var = $dbo->exeUpdate($sql_var);
		//	echo "<script language=\"javascript\">alert($row_bas);</script>";
		//	action_return(1, $sql_var, '-1');
		if(1 != $row_bas || 1 != $row_var) {
			if(DEBUG) {
				action_return(1, '插入数据失败，可能是相关sql语句有误', '-1');
			} else {
				action_return(1, 'register failed, please contact the administrator if u have any question.', '-1');
			}
		} else {
			action_return(1, 'register successed. you can login to confirm it.', '');
		}
	}
}
?>
