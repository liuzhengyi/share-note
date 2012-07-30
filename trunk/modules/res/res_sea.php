<?php 
// this file is compiled by compile.sh 
// if you want to change this page 
// modify the corresponding model file and template file 
// gipsa 2012
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
				<div id="FriendLinks">
					<h2>友情链接</h2>
					<!--在PHP中生成内容-->
				</div>
			</div>
			<div id="MainMiddle">
				<div id="Search">
					<form>
						<input type="textfield" maxlength="100"/>
						<a href="modules.php?app=res_sea"><input type="button" value="搜索" /></a>
					</form>
				</div>
				<div id="ResourceShow">
					<dl>
						<dt>resource1</dt>
						<dl>上传：黄飞鸿 评论：17 等级：精品</dl>
						<dt>resource2</dt>
						<dl>上传：test1 评论：23 等级：精品</dl>
						<dt>resource3</dt>
						<dl>上传：黄飞鸿 评论：33 等级：精品</dl>
						<dt>resource4</dt>
						<dl>上传：jjj 评论：71 等级：精品</dl>
						<dt>resource5</dt>
						<dl>上传：test2 评论：13 等级：精品</dl>
					</dl>
				</div>
			</div>
			<div id="MainRight">
				<?php require_once("uiparts/login.php");?>
				<div id="GoodResource">
					<h2>优秀资源</h2>
					<!--在PHP中生成内容-->
				</div>
			</div>

			<div class="clearfix">
			</div>
		</div>

		<?php require_once("uiparts/footer.php");?>
	</body>
</html>
