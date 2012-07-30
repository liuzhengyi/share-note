<?php
	global $session_prefix;
	if(get_sess_userid()) {
		$title = "user log out";
		$action = "exam_log";
	} else {
		$title = "user log in";
		$action = "exam_log";
		$email = getCookie('user_email');
	}
?>
