<?php
header("content-type:text/html;charset=utf-8");
require("foundation/asession.php");	// session start
require("config.php");			// contains important configs
require("includes.php");		// contains commen functions used by most pages
define("DEBUG", TRUE);
//define("DEBUG", FALSE);


//当前可访问的modules
$appArray=array(
     // example pages
//		   "user_reg" => 'modules/exam/user_reg.php',
		   "user_list" => 'modules/exam/user_list.php',
//		   "user_log" => 'modules/exam/user_log.php',

	// test pages
	"test" => 'test.php',

    // real pages
		   "user_reg" => 'modules/user/user_reg.php',
		   "res_upl" => 'modules/res/res_upl.php',
		   "user_forget" => 'modules/user/user_forget.php',
		   "modify" => 'modules/user/user_pw_change.php',
		   "res_show" => 'modules/res/res_show.php',
		   "res_dlist" => 'modules/res/res_download_list.php',
		   "res_ulist" => 'modules/res/res_upload_list.php',
		   "rev_list" => 'modules/rev/rev_list.php',
       );

// 获取欲访问的modules的id
$appId=getAppId();

if(array_key_exists($appId,$appArray)){
	$apptarget=$appArray[$appId];
	require($apptarget);
}else{
	echo '<script>top.location.href="'.$siteDomain.$indexFile.'";</script>';
}

?>
