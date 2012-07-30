<?php
require_once("/var/www/a/dbdu/foundation/asession.php");
require_once("/var/www/a/dbdu/config.php");
require_once($webRoot."includes.php");
	if(!get_sess_userid()) {	// 尚未登录，不能投票
		echo 'a';
		exit() ;
	}
	$rid = $_GET['rid'];
	$uid = get_sess_userid();
	global $dbServs; // initial in $dbConfFile
	$dbo = new dbex($dbServs);
	$sql = "select 1 from vote where user_id = '$uid' and rev_id = '$rid' limit 1";
	$res = $dbo -> getRow($sql);
	if($res) {			// 不能重复投票
		echo 'b';
		exit() ;
	}
	// 投票
	$sql = "update review set pro_amount = pro_amount+1 where rev_id = '$rid' limit 1";
	$res = $dbo->exeUpdate($sql);
	$sql = "insert into vote values(NULL, '$uid', '$rid', 'p');";
	$res = $dbo->exeUpdate($sql);
	$sql = "select pro_amount as qa from review where rev_id = '$rid' limit 1";
	$res = $dbo->getRow($sql);
	echo $res['qa'];
	$dbo->close();

?>
