<html>
<head>
	<!-- use dbex object -->
	<title>user register page</title>
	<meta http-equiv="content-type" content="text/html; charset=utf8" />
	<link rel="stylesheet" type="text/css" href="skin/default/dafen/exam.css" />
</head>

<body >
<div id="register">
	<h1 >user register</h1>
	<p>welcome register!</p>
	<form action="<?php echo $siteRoot; ?>do.php?act=exam_reg" method="post">
		<p><span>(*)邮箱：</span><input type="text" name="email" /></p>
		<p><span>(*)用户名：<span><input type="text" name="name" /></p>
		<p><span>(*)密码：</span><input type="password" name="pass" /></p>
		<p><span>(*)院校：</span><input type="text" name="school" /></p>
		<p><span>(*)专业：</span><input type="text" name="major" /></p>
		<p><span>(*)入学年份：</span><input type="text" name="entrance-year" /></p>
		<input type="hidden" name="submitted" value="true" />
		<p><input type="submit" name="submit" value="注册" /></p>
	</form>
</div> <!-- end of DIV register -->
<hr />
<p><a href="modules.php?app=user_list">查看用户列表</a></p>
<p><a href="modules.php?app=user_log">登录</a></p>

</body>
</html>
