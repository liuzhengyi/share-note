<?php

if(get_argp('submitted')) {
	$pass_check = FALSE;
	$user_check = FALSE;

	$e = trim(get_argp('useremail'));
	$p = trim(get_argp('password'));
	
	if(strlen($p) > 5 && strlen($p) < 30) {
		$pass_check = TRUE;
	}

	if(check_useremail_fail($e, $max_len_user_email) || !$pass_check) {
		action_return(1, "email or password format incorrect", "-1");
	} else {
		global $dbServs;
		$dbo = new dbex($dbServs);
		$user_check = $dbo->check_pass($e, $p);
		if(!$user_check) {
			action_return(1, "email and password not match.", "-1");
		} else {
			$sql = "select user_basic.user_id, user_name, authority_score, contribution_score from user_basic JOIN user_var using(user_id) where user_email = '$e'";
			$res = $dbo->getRow($sql);
			if(!$res) {
				if(DEBUG) {
					action_return(1, "登录失败，数据库查询结果为空，请检查数据库及查询语句", '-1');
				} else {
					action_return(1, 'sorry, you are not log in, please contact the site administrator for any question.', '-1');
				}
			}
			set_sess_userid($res['user_id']);
			set_sess_email($e);
			set_sess_username($res['user_name']);
			set_sess_uauth($res['authority_score']);
			set_sess_ucont($res['contribution_score']);
			$dbo->close();
			action_return(1, "", "-1");
		}
	}
}
?>
