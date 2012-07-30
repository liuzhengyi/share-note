<?php
	$user_id = get_sess_userid();
	$formerly_pw = short_check(get_argp('formerly_pw'));
	$new_pw = short_check(get_argp('new_pw'));
	$new_pw_repeat = short_check(get_argp('new_pw_repeat'));
	if($new_pw==''||$new_pw_repeat==''){
  		action_return(0,"请输入密码!",-1);exit;
  	}
	
	if($new_pw != $new_pw_repeat){
  		action_return(0,"密码不匹配!","modules.php?app=modify");exit;
  	}
 
	if(!$user_id){
  		action_return(0,"请登录!",$indexFile);exit;
	}

	global $dbServs;
	$dbo = new dbex($dbServs);
	// $exist = $dbo->check_exist('user_id', $user_id, 'user_basic');
  	$sql="select user_pass from user_basic where user_id=$user_id";
	$user_row=$dbo->getRow($sql); 	
	$formerly_pw=sha1($formerly_pw);

	//echo "$user_row['user_pass']";
	if($user_row['user_pass']== $formerly_pw){
  		$sql="update user_basic set user_pass=sha1('$new_pw') where user_id = '$user_id'";
		//echo "<script language=\"javascript\">alert('$user_id$sql$formerly_pw'); </script>";
		if($dbo->exeUpdate($sql) ) {
  			action_return(1,"密码修改成功！","home.php?i=$user_id");
		}else{
  			action_return(0,"密码修改错误","modules.php?app=modify");
		}
	} else {
		action_return(0,"请输入正确的原密码！","modules.php?app=modify");
	}
?>                                                                                 
