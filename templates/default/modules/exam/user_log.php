<html>

<head>
	<title><?php echo $title ?></title>
</head>

<body>
	<h1><?php echo $title ?></h1>

	<form action="do.php?act=<?php echo $action; ?>" method = "post">
	<p>email:<input type="text" name="email" value="<?php echo $user_email; ?>"></p>
	<p>password:<input type="password" name="pass" ></p>
	<p><input type="submit" name="submit" value="submit" ></p>
	<p><input type="hidden" name="submitted" value="true" ></p>
	</form>
	<hr />
	<form>
	<a href="modules.php?app=user_reg">注册页面</a>
	<a href="modules.php?app=user_list">用户列表</a>
	<a href="index.php">index.php</a>
	</form>
</body>
</html>
