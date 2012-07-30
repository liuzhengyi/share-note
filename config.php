<?php

// 主配置信息
$webRoot = "/var/www/a/dbdu/";
$siteRoot = "http://lu0/a/dbdu/";
$dbConfFile = "/var/wwwi/dbconf/dafen.conf";
$siteDomain = "http://{$_SERVER['HTTP_HOST']}/a/dbdu/";

$libPath = "lib/";

$indexFile = "index.php";

// session  前缀
global $session_prefix;
$session_prefix = 'dafen_';

$max_len_user_email = 50;

// 允许上传的文件类型
$allow_up_types = array ('image/pjpeg', 'image/jpeg', 'image/JPG', 'image/X-PNG', 'image/PNG', 'image/png', 'image/x-png', 'application/pdf', 'application/x-chm', 'application/vnd.ms-powerpoint', 'application/msword', 'text/plain', );
?>
