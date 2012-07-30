<?php
header("content-type:text/html;charset=utf-8");
require("foundation/asession.php");	// session start
require("config.php");			// configurations
require("includes.php");		// include commen function files
define('DEBUG', TRUE);
//define("DEBUG", FALSE);


//当前可访问的action动作,先列出公共部分,然后按各个模块列出
$actArray=array(
	    "exam_reg"=> array('action/exam/reg_act.php','modules.php?app=user_list'),
	    "exam_log"=> array('action/exam/log_act.php','modules.php?app=user_list'),

	    "login"=> array('action/login_act.php','home.php'),
	    "logout"=> array('action/logout_act.php','main.php'),
	    "forget" => array('action/user_forget.action.php','modules.php?app=user_forget'),
	    "user_pw_change" => array('action/user_pw_change.action.php','modules.php?app=modify'),
	    "reg"=> array('action/reg_act.php','main.php'),
	    "res_upl"=> array('action/res/res_upl.php','home.php'),
	    "review"=> array('action/res/res_review.php',''),

	    "revup" => array('action/rev/revup_act.php', ''),
	    "revdown" => array('action/rev/revdown_act.php', ''),

	);

$actId=getActId();
/*
暂不使用
$free_act_array=array("login","reg","logout","pr_access_login","photo_upl_flash","user_forget","user_pw_change","user_activation");
//除必须登录才能访问文件
if(!in_array($actId,$free_act_array)){
	limit_time($limit_action_time);
	require("foundation/auser_mustlogin.php");
}
*/

//action动作成功控制函数
function action_return($state=1,$retrun_mess="",$activeUrl=""){
		if($state==2){echo $retrun_mess;exit;}
	Global $acttarget;
	echo "<script language='javascript'>";
	if(trim($retrun_mess)!=''){
		 echo "alert('".$retrun_mess."');";
	}
	$setUrl='';
	if($activeUrl!=''){
		  $setUrl=$activeUrl;
	}else{
		$setUrl=$acttarget[1];
	}
	if($setUrl=='-1'){
		echo "history.go(-1);";
	}else if($setUrl=='0'){
		echo "window.close();";
	}else{
		echo "location.href='".$setUrl."';";
	}
	echo "</script>";exit();
}

if(array_key_exists($actId,$actArray)){
	$acttarget=$actArray[$actId];
	require($acttarget[0]);
}else{
	  echo 'error';
}

?>
