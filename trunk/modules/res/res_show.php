<?php 
// this file is compiled by compile.sh 
// if you want to change this page 
// modify the corresponding model file and template file 
// gipsa 2012
?><?php
	if((!get_argg('res_id'))) {
		echo "<script language=\"javascript\">location.href='main.php';</script>";
	} else if(($id = get_argg('res_id')) && !is_numeric($id)) {
		echo "<script language=\"javascript\">alert('what do you want to see?$id');</script>";
		echo "<script language=\"javascript\">location.href='main.php';</script>";	
	} else {
		$res_id = get_argg('res_id');
		global $dbServs; // initial in $dbConfFile
		$dbo = new dbex($dbServs);
		$exist = $dbo->check_exist('res_id', $res_id, 'resource_basic');
		if(!$exist) {
			echo "<script language=\"javascript\">alert('您所访问的资源不存在。');</script>";	
			echo "<script language=\"javascript\">location.href='main.php';</script>";	
		}
		// query statement
		$sql_resb = "select res_id, res_name, upl_time, user_name, res_size, res_course, type, source, url, intro from resource_basic JOIN user_basic where res_id = '$res_id' and upl_user_id = user_id limit 1";
		$sql_resv = "select dow_times, path, level from resource_var where res_id = $res_id and !is_check limit 1";
		// execute the query
		$res_resb = $dbo->getRow($sql_resb);
		$res_resv = $dbo->getRow($sql_resv);
		// if query failed
		if(!$res_resb || !$res_resv) {
			if(DEBUG) {
				echo "<script language=\"javascript\">alert('读取数据库出错，相关语句：$sql_resb;$sql_resv;');</script>";	
			} else {
				echo "<script language=\"javascript\">alert('对不起，出错了。请稍后访问');</script>";	
			}
		}
		// fetch resource data
		$res_name = $res_resb['res_name'];
		$res_cour = $res_resb['res_course'];
		$res_type = $res_resb['type'];
		$res_size = $res_resb['res_size']/1024;
		$res_uptime = $res_resb['upl_time'];
		$res_user = $res_resb['user_name'];
		$res_sour = $res_resb['source'];
		$res_url = $res_resb['url'];
		$res_down = $res_resv['dow_times'];
		$res_level = $res_resv['level'];
		$res_intro = $res_resb['intro'];
		$res_path = $siteRoot.$res_resv['path'];

		// query from review
		$sql_rev = "select user_name as ver, rev_content as rcnt, rev_id as rid, pro_amount as pa, con_amount as ca, pub_time as pt from review JOIN user_basic using(user_id) where res_id = '$res_id' order by pub_time desc limit 3";
		$has_review = TRUE;
		if(!$recent_reviews = $dbo->getAll($sql_rev)) {
			$has_review = FALSE;
		}
	}

?>
<?php
/*	data instructions:
 * $has_review	--> 该资源是否有评论
 * 
 * $res_name 	--> 资源名称
 * $res_cour	--> 相关课程
 * $res_typ	--> 资源类型
 * $res_size	--> 资源大小 单位字节
 * $res_uptime 	--> 资源上传时间
 * $res_user 	--> 上传用户id
 * $res_sour 	--> 资源来源
 * $res_url 	--> 相关url
 * $res_down 	--> 下载次数
 * $res_level	--> 资源级别
 * $res_intro	--> 资源简介
 * $res_path	--> 资源下载路径
 *
 * $has_review	--> 是否有评论
 * $recent_reviews[n][]	(最近评论，n <=3 && n >= 0)
 *		ver	--> 评论者姓名
 *		rcnt	--> 评论内容
 *		rid	--> 评论id
 *		pa	--> 赞成数
 *		ca	--> 反对数
 *		pt	--> 评论发布时间
 *		
 **/
?>
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
