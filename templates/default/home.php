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
