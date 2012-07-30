<?php
	$e = get_argp('email');
	$p = get_argp('pass');
	global $dbServs; // initial in $dbConfFile
	$dbo = new dbex($dbServs);
	$check = $dbo->check_pass("$e", "$p");
	if(1 == $check) {
		$sql = "select user_id from user_basic where user_email = '$e';";
		$res = $dbo->getRow($sql);
		set_sess_userid($res['user_id']);
		action_return(1, "you are logged in.", '-1');
	} else {
		action_return(1, "email and pass not match!", '-1');
	}
	$dbo->close();
?>
