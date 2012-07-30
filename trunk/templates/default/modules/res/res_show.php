<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="utf-8" xml:lang="utf-8">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>大学生学习资料分享中心</title>
		<link rel="stylesheet" type="text/css" href="./skin/default/dafen/main.css" />
		<script language="javascript" src="./ajax/rev_up_down.js" ></script>
<style>
div#reviewer {
	float: left;
}
 div#reviewer p {
 	margin-top: 0;
 }
div#vote {
	position: relative;
	float: right;
}
 div#vote form {
 	display: inline;
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
					<h2><?php echo $res_name;?></h2>
					<table border='0'>
						<tr>
							<td>所属科目：</td><td><?php echo $res_cour;?></td>
						</tr>
						<tr>
							<td>类型：</td><td><?php echo $res_type;?></td>
						</tr>
						<tr>
							<td>大小：</td><td><?php echo $res_size;?> K</td>
						</tr>
						<tr>
							<td>上传时间：</td><td><?php echo $res_uptime;?></td>
						</tr>
						<tr>
							<td>上传用户：</td><td><?php echo $res_user;?></td>
						</tr>
						<tr>
							<td>来源：</td><td><?php echo $res_sour;?></td>
						</tr>
						<tr>
							<td>URL：</td><td><?php echo $res_url;?></td>
						</tr>
						<tr>
							<td>下载次数：</td><td><?php echo $res_down;?></td>
						</tr>
						<tr>
							<td>等级：</td><td><?php echo $res_level;?></td>
						</tr>
					</table>

					<h3>简介：</h3>
					<p><?php echo $res_intro;?></p>

					<h3><a href="<?php echo $res_path; ?>" target="_blank">下载</a></h3>

					<hr/>
					<h3>最近评论</h3>

					<?php
						if ($has_review)
						{
							?>
							<?php foreach($recent_reviews as $rv) {?>
							<hr />
							<p><?php echo $rv['rcnt'];?></p>
							<div id="reviewer">
							<p>(by) <?php echo $rv['ver'];?> <br />(on) <?php echo $rv['pt'];?></p>
							</div> <!-- end of DIV reviewer-->
							<div id="vote">
							<form action="testdo.php?act=revup" method="post">
								<input type="hidden" name="submitted" value="true" />
								<input type="hidden" name="rid" value="<?php echo $rv['rid'];?>" />
								<span id="pa<?php echo $rv['rid'];?>"><?php echo $rv['pa'];?></span>人<input type="submit" name="up" value="赞成" class="vote_btn" onclick="rev_up(<?php echo $rv['rid'];?>); return false;" />
							</form>
							<form action="do.php?act=revdown" method="post">
								<input type="hidden" name="submitted" value="true" />
								<input type="hidden" name="rid" value="<?php echo $rv['rid'];?>" />
								<span id="ca<?php echo $rv['rid'];?>"><?php echo $rv['ca'];?></span>人<input type="submit" name="up" value="反对" class="vote_btn" onclick="rev_down(<?php echo $rv['rid'];?>); return false;" />
							</form>
							<p id="txthint<?php echo $rv['rid'];?>" class="txthint"></p>
							</div> <!-- end of DIV vote -->
			<div class="clearfix">
			</div>
							<?php } // end of foreach ?>
							<?php
						}
						else
						{
							echo '<p>咦，还没有人评论这个资源丫……</p>';
						}
					?>

			<div class="clearfix">
			</div>
					<hr/ id="">
					<h3>您的评论</h3>
					<form action="do.php?act=review&res_id=<?php echo $res_id;?>" method='post'>
						<textarea name="comment" cols="40" rows="7" value=""></textarea><br/>
						<input type='submit' name="submit" value="提交"/>
						<input type='hidden' name='submitted' value='TRUE'/>
					</form>
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
