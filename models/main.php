<?php
require_once("foundation/asession.php");
require_once("config.php");
require_once("includes.php");
define('DEBUG', TRUE);
//define('DEBUG', FALSE);

// check user privelege
$key = get_argg('sea_key');
$default_key = '运筹学';
$key = empty($key)?$default_key:$key;
$content = get_argg("content");

// connect the db server
global $dbSvers; // initial in $dbConfFile
$dbo = new dbex($dbServs);

// query statements
$sql_res_bas = "select res_id, res_name, upl_user_id from resource_basic where res_name like '%$key%' limit 10";

// query from review
$has_result = TRUE;
if(!$result = $dbo->getAll($sql_res_bas)) {
//	echo "<script language=\"javascript\">alert('debug". __FILE__ .": 检索用户结果为空，查询语句:$sql_rev');</script>";
	$has_result = FALSE;
} else {
	$resources = array();
	foreach($result as $row) {
		$res_id = $row['res_id'];
		$res_name = $row['res_name'];
		$res_name = (strlen($res_name) > 30)?substr($res_name, 0, 12).'...': $res_name;
		$res_user_id = $row['upl_user_id'];
		$res = array($res_id, $res_name, $res_user_id);
		$resources[] = $res;
	}
}

?>
