<?php header("location:main.php?content=about");?>

<html>
	<head>
		<meta charset="utf-8"/>
		<script language="javasript">location.href="main.php";</script>
	</head>
	<body>
		<h1>当前可用页面</h1>
		<ul>
			<li><a href="modules.php?app=user_reg">modules.php?app=user_reg 用户注册页面</a></li>
			<li><a href="modules.php?app=user_list">modules.php?app=user_list 用户列表</a></li>
			<li><a href="modules.php?app=test">modules.php?app=test 用户登录测试</a></li>
		</ul>
	</body>
</html>
