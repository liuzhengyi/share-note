<?php
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
