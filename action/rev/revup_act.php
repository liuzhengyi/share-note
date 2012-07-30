<?php
if(get_argp('submitted')) {
	if(!(get_sess_userid())) {
		action_return(1,'请先登录再投票', '-1');
	}
	global $dbServs; // initial in $dbConfFile
	$dbo =  new dbex($dbServs);
	$rid = get_argp('rid');
	$table = "review";
	$is_exist = $dbo->check_exist('rev_id', "$rid", "$table");
	if(empty($is_exist)) {
		action_return(1, '您在为一个不存在的评论投票', '-1');
	}
	$sql = "update review set pro_amount = pro_amount + 1 where rev_id = '$rid' limit 1";
	$res = $dbo->exeUpdate($sql);
	if(1 != $res) {
		action_return(1, '对不起，投票失败', '-1');
	}
	action_return(1, '感谢您的投票', '-1');
}
?>
