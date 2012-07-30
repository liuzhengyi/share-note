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
