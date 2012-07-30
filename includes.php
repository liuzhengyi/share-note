<?php
	/* 基本包含文件 */

	/* 公共语言包引入文件，暂无 */

// 数据库配置及表操作类
require_once($dbConfFile);
require_once($webRoot.$libPath."cdbex.class.php");

// 过滤函数
require_once($webRoot."foundation/check.php");
require_once($webRoot."foundation/freq_filter.php");

// main_iframe 呈现应用工具控制函数
require_once($webRoot."foundation/fmain_target.php");

// session coolie 封装
require_once($webRoot."foundation/fsession.php");
require_once($webRoot."foundation/fcookie.php");

// $_GET $_POST 封装
require_once($webRoot."foundation/fgetandpost.php");

?>
