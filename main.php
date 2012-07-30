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
				<?php
				switch ($content)
				{
					case 'category':
						echo '<p>抱歉，此功能尚未完成，请持续关注。</p>'."\n";
					break;
					case 'help':
						require_once("uiparts/help.php");
					break;
					case 'about':
						require_once("uiparts/about.php");
					break;
					default:
						?>
							<?php
							if (!$has_result)
							{
							?>
								<h3>抱歉，没有您想要的结果。</h3>
							<?php
							}
							else
							{
								echo '<dl>' . "\n";
								foreach ($resources as $res)
								{
									echo '<dt><a href="modules.php?app=res_show&res_id=' . $res[0] . '">' . $res[1] . '</a></dt>' . "\n";
									echo '<dd>上传者：' . $res[2] . '</dd>' . "\n";
									echo '<hr/>' . "\n";
								}
								echo '</dl>' . "\n";
							}
							?>
						<?php
					break;
				}
				?>
				</div>
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
