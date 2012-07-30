<?php
	global $dbServs; // initial in $dbConfFile
	$dbo = new dbex($dbServs);
	$ip = $_SERVER['REMOTE_ADDR'];
	$id = get_sess_userid();
	$sql = "update user_var set login_ip = inet_aton('$ip') where user_id = $id limit 1";
	$dbo->exeUpdate($sql);
	set_sess_userid('');
	action_return(1, "", '');
?>
