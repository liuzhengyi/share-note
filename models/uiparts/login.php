<?php
if(get_sess_userid()) {
	$is_login = true;
	$user_name = get_sess_username();
	$user_auth = get_sess_uauth();
	$user_cont = get_sess_ucont();
	$user_id = get_sess_userid();
} else {
	$is_login = false;
}

/*
// before log in
	$is_login;

// after log in
	$user_name; 
	$user_auth;    // authority score
	$user_cont;    // contribution score
 */

?>
<?php
/*	data instructions:
 * $is_login	--> 	是否登录(为true时，后续变量可用)
 * $user_name	-->	登录用户名
 * $user_auth	-->	登录用户权威值
 * $user_cont	-->	登录用户贡献值
 * $user_id	-->	登录用户id
 *
 */
?>
