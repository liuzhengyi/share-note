<?php 
// this file is compiled by compile.sh 
// if you want to change this page 
// modify the corresponding model file and template file 
// gipsa 2012
?><?php
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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="utf-8" xml:lang="utf-8">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>大学生学习资料分享中心</title>
		<link rel="stylesheet" type="text/css" href="./skin/default/dafen/main.css" />
	</head>
	<body>
		<?php require_once("uiparts/header.php");?>

		<div id="MainContainer">
			<div id="MainLeft">
				<?php require_once("uiparts/links.php");?>
			</div>
			<div id="MainMiddle">
			<?php require_once("uiparts/search.php");?>
				<div id="ResourceShow">
					<h2><?php echo $user_name;?>的个人信息</h2>
					<table border='0'>
						<?php if ($is_self) {?>
						<tr>
							<td>e-mail：</td><td><?php echo $user_email;?></td>
						</tr>
						<tr>
							<td>学校：</td><td><?php echo $user_school;?></td>
						</tr>
						<tr>
							<td>专业：</td><td><?php echo $user_major;?></td>
						</tr>
						<tr>
							<td>入学年份：</td><td><?php echo $user_entrance_year;?></td>
						</tr>
						<tr>
							<td>注册时间：</td><td><?php echo $user_reg_date;?></td>
						</tr>
						<tr>
							<td>上次登录IP：</td><td><?php echo $user_last_ip;?></td>
						</tr>
						<?php } ?>
						<tr>
							<td>下载数量：</td><td><?php echo $user_down_amount;?></td>
						</tr>
						<tr>
							<td>上传数量：</td><td><?php echo $user_up_amount;?></td>
						</tr>
						<tr>
							<td>权威值：</td><td><?php echo $user_auth_score;?></td>
						</tr>
						<tr>
							<td>贡献值：</td><td><?php echo $user_cont_score;?></td>
						</tr>
					</table>
					<?php if ($is_self) {?>
					<p><a href="modules.php?app=modify">修改信息</a></p>
					<?php } ?>
					<hr/>
					<?php
					if ($has_review)
					{
						?>
						<h2><?php echo $user_name; ?>的最近评论</h2>
						<table border='0'>
						<tr>
							<th>最近评论</th>
							<th>赞成</th>
							<th>反对</th>
							<th>评论时间</th>
						</tr>
						<?php
						foreach($recent_reviews as $review)
						{
							echo '<tr>' . "\n";
							foreach($review as $v)
							{
								echo '<td>' . "\n";
								echo $v . "\n";
								echo '</td>' . "\n";
							}
							echo '</tr>' . "\n";
						}
						?>
						</table>
						<?php
					}
					else
					{
						echo '<p>咦，没有评论任何资料丫……</p>';
					}
					?>
					<a href="modules.php?app=rev_list&i=<?php echo $id; ?>">所有评论</a>
					<hr />

					<?php if ($is_self && $has_upload) { ?>
					<div id="MyUpload">
						<h2><?php echo $user_name;?>的最近上传</h2>
						<ol>
						<?php
						foreach($uploads as $u) {
							echo "<li><a href=\"modules.php?app=res_show&res_id={$u['id']}\">{$u['name']}</li>";
						}
						?>
						</ol>
						<p><a href="modules.php?app=res_ulist&id=<?php echo $id; ?>">所有上传</a><p>
					</div><!-- end of DIV MyUpload -->
					<?php } ?>

					<?php if($is_self && $has_download) { ?>
					<div id="MyDownload">
						<h2><?php echo $user_name;?>的最近下载</h2>
						<ol>
						<?php
						foreach($downloads as $d) {
							echo "<li><a href=\"modules.php?app=res_show&res_id={$d['id']}\">{$d['name']}</a></li>";
						}
						?>
						</ol>
						<p><a href="modules.php?app=res_dlist&id=<?php echo $id; ?>">所有下载</a><p>
					</div><!-- end of DIV MyDownload -->
					<?php } ?>

				</div><!-- end of DIV ResourceShow -->
			</div><!-- end of MainMiddle -->
			<div id="MainRight">
				<?php require_once("uiparts/login.php");?>
				<?php require_once("uiparts/hot_res.php");?>
			</div><!-- end of DIV MainRight-->

			<div class="clearfix">
			</div>
		</div><!-- end of DIV MainContainer -->

		<?php require_once("uiparts/footer.php");?>
	</body>
</html>
