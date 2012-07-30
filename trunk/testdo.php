<?php
header("content-type:text/html;charset=utf-8");
require("foundation/asession.php");	// session start
require("config.php");			// configurations
require("includes.php");		// include commen function files
define('DEBUG', TRUE);
//define("DEBUG", FALSE);


//当前可访问的action动作,先列出公共部分,然后按各个模块列出
require_once('action/rev/revup_act.php');

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

?>
