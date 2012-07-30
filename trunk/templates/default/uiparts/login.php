<div id="UserLogin">
<?php
	if ($is_login)
	{
		?>
			<table border='0'>
				<tr>
					<td>欢迎回来：</td><td><?php echo $user_name;?></td>
				</tr>
				<tr>
					<td>您的权威值：</td><td><?php echo $user_auth;?></td>
				</tr>
				<tr>
					<td>您的贡献值：</td><td><?php echo $user_cont;?></td>
				</tr>
				<tr>
					<td colspan='2'>
						<a href="modules.php?app=res_upl"><input type="button" value="上传资料"/></a>&nbsp;
						<a href="home.php?i=<?php echo $user_id;?>"><input type="button" value="用户主页"/></a>&nbsp;
						<a href="do.php?act=logout"><input type="button" value="退出登录"/></a>
					</td>
				</tr>
			</table>
		<?php
	}
	else
	{
		?>
			<script type="text/javascript">
				function check_input()
				{
					var input_email = document.getElementById("UsernameInput");
					var input_password = document.getElementById("PasswordInput");
					var text_email = input_email.value;
					var text_password = input_password.value;

					//Check email
					if (text_email.length <= 4 || text_email.indexOf("@") < 0
						|| text_email.indexOf("@") >= (text_email.length - 1)
						|| -1 != text_email.search("/[^a-zA-Z0-9_@.-]/g"))
					{
						document.getElementById("BtnLogin").disabled = true;
						return;
					}
					//Check password
					if (text_password.length < 6 || text_password.length > 30)
					{
						document.getElementById("BtnLogin").disabled = true;
						return;
					}
					document.getElementById("BtnLogin").disabled = false;
				}
			</script>
			<form action="do.php?act=login" method="post">
				<label for="UsernameInput">
					登录邮箱：<br/>
					<input type="textfield" name="useremail" id="UsernameInput" maxlength='50' value="" onchange="check_input();"/><br/>
				</label>
				<label for="PasswordInput">
					密码：<br/>
					<input type="password" name="password" id="PasswordInput" maxlength='30' value="" onkeyup="check_input();"/><br/>
				</label>
				<input type="submit" name="login" value="登录" id="BtnLogin" disabled="disabled"/>
				<a href="modules.php?app=user_reg"><input type="button" name="register" value="注册" id="BtnRegister" /></a>

				<input type="hidden" name="submitted" value="TRUE" />
			</form>
		<?php
	}
?>
</div>
