<?php 
// this file is compiled by compile.sh 
// if you want to change this page 
// modify the corresponding model file and template file 
// gipsa 2012
?>

<?php
	// 引入包含文件
//require_once($webRoot."lib/cdbex.class.php");  // 数据库操作类
//require_once($dbConfFile);		// 数据库连接信息，存放于web根目录之外
//require_once($webRoot."foundation/check.php");	// 一些用于验证用户输入的函数

// 获取变量
$show_user = true;

if($show_user) {
	global $dbServs; // initial in $dbConfFile
	$dbo = new dbex($dbServs);
	// variavles of pagebar
	$set_pages = true;
	if($set_pages) {
		$cur_page = (is_numeric($_GET['cur_page'])) ? $_GET['cur_page'] : 1;
		$page_items = (is_numeric($_GET['page_items'])) ? $_GET['page_items'] : 10;
		$total_page = 1; // default, modified below
		$dbo->setPages($page_items, $cur_page);
	}
	// 先进行数据库操作getRs()，才能得到$totalPage和$rowCount
	$sql = "select user_id, user_name, school, user_email from user_basic";
	$res = $dbo->getRs($sql);
	if(!$res) {
		echo "<script type=\"javascript\">getRs failed.</script>";
	}
	// 根据$totalPage和$rowCount确定$start_item，$end_item
	if($set_pages) {
		$total_page = $dbo->total_page();
		$total_item = $dbo->total_row();
		$start_item = $page_items * ($cur_page-1) + 1;
		if($cur_page != $total_page) {
			$end_item = $start_item+$page_items - 1;
		} else {
			$end_item = $total_item; 
		}
		if($cur_page > 1) {
			$prev_page = $cur_page - 1;
		}
		if($cur_page < $total_page) {
			$next_page = $cur_page + 1;
		}
	}
} ?>
<html>
<head>
	<!-- use dbex object -->
	<title>user register page</title>
	<meta http-equiv="content-type" content="text/html; charset=utf8" />
	<link rel="stylesheet" type="text/css" href="skin/default/dafen/exam.css" />
</head>

<body >
<div id="registered">
	<h1>registered users</h1>
	<table border="1">
		<tr>
			<td>用户id</td>
			<td>用户名</td>
			<td>院校</td>
			<td>注册邮箱</td>
		</tr>
		<?php
		foreach($res as $row) {
			echo "	\n<tr>\n\t<td>{$row['user_id']}</td>\n\t<td>{$row['user_name']}</td>
				\n\t<td>{$row['school']}</td>\n\t<td>{$row['user_email']}</td>\n</tr>";
		}
		?>
	</table>
</div><!-- end of DIV registered -->

<?php
// show pagebar
if($set_pages) {
	echo '<div id="pagebar">';
	echo "\n<p>以上是第$start_item 到$end_item 条记录。当前是第$cur_page 页。</p>";
	echo "<p>";
	if($cur_page > 1) {
		echo "<a href=\"modules.php?app=$appId&cur_page=$prev_page&page_items=$page_items\">previous page</a>";
	}
	echo "&nbsp;</p>"; // space can hold a blank paragraph
	for($i = 1; $i <= $dbo->total_page(); $i ++) {
		echo "\n\t<a ";
		if($i == $cur_page) {
			echo 'class="current" ';
		} 
			echo " href=\"modules.php?app=$appId&cur_page=$i&page_items=$page_items\" >pg $i</a>";
	}
	echo "<p>";
	if($cur_page < $dbo->total_page()) {
		echo "<a href=\"modules.php?app=$appId&cur_page=$next_page&page_items=$page_items\">next page</a>";
	}
	echo "</p>";
	echo '</div>';
}
?>

<hr id="clear" />
<p><a href="modules.php?app=user_reg">注册新用户</a></p>
<p><a href="modules.php?app=user_log">用户登录</a></p>

</body>
</html>
