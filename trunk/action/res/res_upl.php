<?php
//if(empty(get_argp('submitted'))) {
if( (empty($_POST['submitted']))){
	action_return(1, "we are sorry, but you shoud not visit this page by this way", '-1');
} else {
	if(!get_sess_userid()) {
		action_return(1, '请先登录再上传资源，谢谢合作', '-1');
	}
	if(empty($_FILES['upfile'])) {
		action_return(1, "we are sorry, but you did not submit any file", '-1');
	} else {
		global $allow_up_types; // initial in config.php
		if(!in_array($_FILES['upfile']['type'], $allow_up_types)) {
			$type = $_FILES['upfile']['type'];
			action_return(1, "暂不支持此种类型的资源上传：$type. 目前支持类型：pdf, chm, ms doc, ms ppt, txt, image.", '-1');
		} else {
			if(!move_uploaded_file($_FILES['upfile']['tmp_name'], "./uploads/{$_FILES['upfile']['name']}")) {
				if($_FILES['upfile']['error']> 0) {
					action_return(1, "error occured: {$_FILES['upfile']['error']}.", '-1');
				}
				action_return(1, "we are sorry, but the file upload is failed.", '-1');
			} else {
				global $dbServs;
				$dbo = new dbex($dbServs);
				$name = get_argp('name');
				$cour = get_argp('subject');
				$type = get_argp('type');
				$sour = get_argp('source');
				$intr = get_argp('intro');
				$user_id  = get_sess_userid();
				$file_size = $_FILES['upfile']['size'];
				$path = 'uploads/'.$_FILES['upfile']['name'];
				$sql_bas = "insert into resource_basic values(NULL, '$name', now(), $user_id, $file_size, '$cour', '$type', '$sour', NULL, '$intr')";
				$sql_var = "insert into resource_var values(last_insert_id(), 0, '$path', '普通', 0)";

				$res_bas = $dbo->exeUpdate($sql_bas);
				$res_var = $dbo->exeUpdate($sql_var);
				if(1 != $res_bas || 1 != $res_var) {
					if(DEBUG) {
					/*
						echo "<script language=\"javascript\">alert('$sql_bas');</script>";
						echo "<script language=\"javascript\">alert('$sql_var');</script>";
						*/
						echo $sql_bas;
						echo $sql_var;
						action_return(1, "数据库插入信息出错", '-1');
					} else {
						action_return(1, "对不起，上传出现问题，请重试。", '-1');
					} 
				} else {
					action_return(1, "upload success", '');
				}
					action_return(1, "upload success", '');
			}
		}
	}
}
?>
