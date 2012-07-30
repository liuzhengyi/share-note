<?php
require_once("foundation/asession.php");
require_once("config.php");
require_once("includes.php");
define('DEBUG', TRUE);
//define('DEBUG', FALSE);

// check user privelege
$id = get_argg('i');
$user_id = get_sess_userid();
if(empty($user_id)) {
//	header("location:modules.php?app=test");
	echo "<script language=\"javascript\">location.href='main.php'</script>";
} else if (empty($id) || $id === $user_id ) {
	$id = $user_id;
	$is_self = TRUE;
} else {
	settype($id, 'integer');
	$is_self = FALSE;
}

// get data from session assumed $is_self is TRUE
$user_name = get_sess_username();
$user_email = get_sess_email();
$user_cont_score = get_sess_ucont();
$user_auth_score = get_sess_uauth();

// connect the db server
global $dbSvers; // initial in $dbConfFile
$dbo = new dbex($dbServs);

// query statements
$sql_bas = "select user_name, school, major, entrance_year, reg_time from user_basic where user_id = '$id' limit 1";
$sql_var = "select inet_ntoa(login_ip) as last_ip, down_amount, up_amount, authority_score, contribution_score from user_var where user_id = '$id' limit 1";
$sql_rev = "select rev_content, pro_amount, con_amount, pub_time from review where user_id = '$id' order by pub_time desc limit 3";
$sql_ups = "select res_id as id, res_name as name from resource_basic where upl_user_id = '$id' limit 3";
$sql_downs = "select d.res_id as id, r.res_name as name from download as d JOIN resource_basic as r where d.user_id = '$id' group by d.res_id limit 3";

// query from user_basic
if(!$row_bas = $dbo->getRow($sql_bas)) {
	if(DEBUG) {
		echo "<script language=\"javascript\">alert('debug: file:". __FILE__ .", line: ". __LINE__ .": 检索用户结果为空，查询语句:$sql_bas');</script>";
	}
		echo "<script language=\"javascript\">history.go(-1);</script>";
}
$user_school = $row_bas['school'];
$user_major = $row_bas['major'];
$user_entrance_year = $row_bas['entrance_year'];
$user_reg_date = $row_bas['reg_time'];
if(!$is_self) {
	$user_name = $row_bas['user_name'];
}

// query from user_var
if(!$row_var = $dbo->getRow($sql_var)) {
	echo "<script language=\"javascript\">alert('debug". __FILE__ .": 检索用户结果为空，查询语句:$sql_var');</script>";
}
$user_last_ip = $row_var['last_ip'];
$user_down_amount = $row_var['down_amount'];
$user_up_amount = $row_var['up_amount'];
if(!$is_self) {
	$user_auth_score = $row_var['authority_score'];
	$user_cont_score = $row_var['contribution_score'];
}

// query from review
$has_review = TRUE;
if(!$row_rev = $dbo->getAll($sql_rev)) {
//	echo "<script language=\"javascript\">alert('debug". __FILE__ .": 检索用户结果为空，查询语句:$sql_rev');</script>";
	$has_review = FALSE;
} else {
	$recent_reviews = array();
	foreach($row_rev as $row) {
		$rev_content = $row['rev_content'];
		$rev_content_show = (strlen($rev_content) > 30)?substr($rev_content, 0, 12).'...': $rev_content;
		$review = array($rev_content_show, $row['pro_amount'], $row['con_amount'], $row['pub_time']);
		$recent_reviews[] = $review;
	}
}

// query from resouce_basic
$has_upload = TRUE;
if(!$uploads = $dbo->getAll($sql_ups)) {
	echo "<script language=\"javascript\">alert('debug". __FILE__ .": 检索结果为空，查询语句:$sql_ups');</script>";
	$has_upload = FALSE;
}

// query from download and resouce_basic
$has_download = TRUE;
if(!$downloads = $dbo->getAll($sql_downs)) {
	echo "<script language=\"javascript\">alert('debug". __FILE__ .": 检索结果为空，查询语句:$sql_downs');</script>";
	$has_download = FALSE;
}

?>
<?php
/*	data structions:
 * $id	--> 欲查看该用户的home页
 * $user_id	--> 当前登录用户id
 * $is_self	--> $id 是否等读 $user_id
 * $user_name	--> 当前登录用户 用户名
 * $user_email	--> 当前登录用户 email
 * $user_cont_score	--> 当前登录用户 贡献值
 * $user_auth_score	--> 当前登录用户 权威值
 *
 * $row_bas[]
 * $user_school = $row_bas['school'];
 * $user_major = $row_bas['major'];
 * $user_entrance_year = $row_bas['entrance_year'];
 * $user_reg_date = $row_bas['reg_time'];
 *
 * $user_last_ip = $row_var['last_ip'];
 * $user_down_amount = $row_var['down_amount'];
 * $user_up_amount = $row_var['up_amount'];
 *
 * $has_review 		--> 是否有评论
 * $recent_reviews[n][]	--> 最近评论，一个二维数组(n >= 0 && n <= 3)
 * 		rev_content_show	--> 显示的评论内容
 *		pro_amount		--> 评论的支持数
 *		con_amount		--> 评论的反对数
 *		pub_time		--> 评论发表时间
 *
 * $has_upload		--> 是否有上传
 * $uploads[n][]	--> 最近上传，(n >= 0 && n <= 3)
 *		id	--> 资源id
 *		name	--> 资源名
 * 
 * $has_download	--> 是否有下载
 * $downloads[n][]	--> 最近下载，(n >= 0 && n <= 3)
 * 		id	--> 资源id
 *		name	--> 资源名
 *
 */
?>
