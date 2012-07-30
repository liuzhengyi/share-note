<?php 
// this file is compiled by compile.sh 
// if you want to change this page 
// modify the corresponding model file and template file 
// gipsa 2012
?><?php
$id = get_argg('i');
$user_id = get_sess_userid();
if(empty($id) || $user_id === $id) {
	$id = $user_id;
} else {
	settype($id, 'integer');
}

$cur_page = get_argg('cur_page');
if(empty($cur_page)) {
	$cur_page = 1;
} else {
	settype($cur_page, 'integer');
}

$items = get_argg('items');
if(empty($items)) {
	$items = 4;
} else {
	settype($items, 'integer');
}

$sql_name = "select user_name as name from user_basic where user_id = '$id' limit 1";
$sql_rev = "select res_name as name, res_id as id, rev_content as content, pro_amount as pro, con_amount as con, pub_time as time from review JOIN resource_basic using(res_id) where user_id = '$id'";

global $dbServs; 
$dbo = new dbex($dbServs);
$n = $dbo->getRow($sql_name);
if(!$n) {
	echo "<script language=\"javascript\">alert('唔，您访问的用户不存在丫，也许是注销了吧。。。');history.go(-1);</script>";
	$user_exist = FALSE;
	$not_exist_msg = "唔，您访问的用户不存在丫，也许是注销了吧。。。";
} else {
	$user_exist = TRUE;
	$name = $n['name'];
}
$dbo->setPages($items, $cur_page);
$revs = $dbo->getRs($sql_rev);
if(!$revs) {
	$has_review = FALSE;
	$no_review_msg = "咦，米有任何评论丫。。。";
} else {
	$has_review = TRUE;
}
$total_pages = $dbo->total_page();
$pre_page = $cur_page - 1;
$next_page = $cur_page + 1;

$total_items = $dbo->total_row();
$start_item = ($cur_page-1)*$items+1;
$end_item = ($cur_page == $total_pages)?($total_items):($cur_page*$items);
?>
<?php
/*
 * 数据说明：
 * $id		--> 显示该用户的评论
 * $name 	--> 显示该用户的评论
 * $user_id	--> 当前登录用户的id
 * $cur_page 	--> 当前页码
 * $pre_page	--> 前一页页码
 * $next_page	--> 后一页页码
 * $items 	--> 每页显示评论条数
 * $total_pages	--> 总页数
 * $total_items	--> 总评论数
 * $user_exist	--> 是否显示评论消息，为FALSE时提示$not_exist_msg然后跳转后退
 * $not_exist_msg	--> 不显示评论消息时显示的提示信息
 * $has_review	--> 是否有评论
 * $no_review_msg	--> 没有评论时，提示该信息，不跳转。
 *
 * $revs
 *	0['name']	--> 评论的资源的名称
 *	1['id']		--> 评论的资源的id
 *	2['content']	--> 评论的内容
 *	3['pro']		--> 赞同数
 *	4['con']		--> 反对数
 *	5['time']	--> 发表时间
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="utf-8" xml:lang="utf-8">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>大学生学习资料分享中心</title>
		<link rel="stylesheet" type="text/css" href="./skin/default/dafen/main.css" />
		<style>
div#PageBar {
	color: grey;
	outline: 1px solid grey;
	font-size: .8em;
}
div#PageBar a {
	margin: 5px;
}
		</style>
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
				<?php if(!$user_exist) { ?>
					<h3><?php echo $not_exist_msg; ?></h3>
				<?php } else if(!$has_review) { ?>
					<h3><?php echo $no_review_msg; ?></h3>
				<?php } else { ?>
					<h2><?php echo $name; ?>的所有评论</h2>
					<div id="PageBar" >
					<?php if($cur_page != 1) { ?>
						<a href="<?php echo "modules.php?app=rev_list&i=$id&cur_page=$pre_page&items=$items"?>">previous_page</a>
					<?php } else {?>
						<a>previous_page</a>
					<?php }?>
					<?php
						for($i = 1; $i <= $total_pages; $i++) {
							if($i != $cur_page) {
								echo " <a href=\"modules.php?app=rev_list&i=$id&cur_page=$i&items=$items\">pg_$i</a> ";
							} else {
								echo " pg_$i ";
							}
						}
					?>
					<?php if($cur_page != $total_pages) { ?>
						<a href="<?php echo "modules.php?app=rev_list&i=$id&cur_page=$next_page&items=$items"?>">next_page</a>
					<?php }else {?>
						<a>next_page</a>
					<?php } ?>
					<p>共<?php echo $total_items?>条评论，如下是第<?php echo $start_item; ?>到第<?php echo $end_item; ?>条。</p>
					</div><!-- end of DIV PageBar -->
					<?php
						foreach($revs as $k) {
							echo "<p class=\"rev\">{$k['content']}</p>\n";
							echo "<p class=\"\"> (at) <a href=\"modules.php?app=res_show&res_id={$k['id']}\">{$k['name']}</a><br /> (on) {$k['time']}</p><hr />\n";
						}
					?>
				<?php } ?>
				</div> <!-- end of DIV ResourceShow -->
			</div>
			<div id="MainRight">
				<?php require_once("uiparts/login.php");?>
				<?php require_once("uiparts/hot_res.php");?>
			</div>

			<div class="clearfix">
			</div>
		</div>

		<?php require_once("uiparts/footer.php");?>
	</body>
</html>
