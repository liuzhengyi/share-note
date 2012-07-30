<?php
	if(get_argp('submitted')) {
		$rev_content = get_argp('comment');
		if(empty($rev_content)) {
			action_return(1, '您想提交空的评论，但是这没有意义', '-1');
		}
		// 检测comment中的攻击，暂无
		// 修正comment，暂无
		global $dbServs; // initial in $dbConfFile
		$dbo = new dbex($dbServs);
		$user_id = get_sess_userid();
		if(!$user_id) {action_return(1, '您尚未登录，请登录后再发表评论', 'home.php');}
		$res_id = get_argg('res_id');
		if(!$res_id) {action_return(1, '您试图评价一个不存在的资源，这没有意义', 'home.php');}
		$sql = "insert into review values(NULL, $user_id, $res_id, '$rev_content', 0, 0, now())";
		$res = $dbo->exeUpdate($sql);
		if(!$res) {
			action_return(1, '评论写入失败，您的评论对大家很重要，请尝试再次评论或联系网站管理员', '-1');
		} else {
			$sql = "update user_var set contribution_score=contribution_score+10 where user_id = $user_id limit 1";
			$res = $dbo->exeUpdate($sql);
			if(!$res) {
				action_return(1, '增加贡献值失败', '-1');
			} else {
				$sess_ucont = get_sess_ucont();
				set_sess_ucont($sess_ucont+10);
				action_return(1, '评价成功，您的评价将促进社区的发展，这是您为社区做的贡献', '-1');
			}
		}
	}
?>
