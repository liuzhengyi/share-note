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
